<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventAttachment;
use App\Models\EventCategory;
use App\Models\EventFormat;
use App\Http\Requests\events\StoreEventRequest;
use App\Models\Auction;

class EventController extends Controller
{
    public function index()
    {
        return view('pages.events.index');
    }

    public function create()
    {
        $eventCategories = EventCategory::get()->toArray();
        $eventTypes = EventFormat::get()->toArray();
        return view('pages.events.create', compact('eventCategories', 'eventTypes'));
    }

    public function show($eventId)
    {
        try {
            $events = Event::where('id', $eventId)
                            ->with(['eventUsers', 'tenants', 'auctions', 'eventCategory'])
                            ->get()
                            ->toArray();

        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage(), 500]);
        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage(), 500]);
        }

        $response = [
            'message' => [
                'title' => "Success",
                'text' => "Success get data",
                'icon' => "success",
            ],
            'data' => $events,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }

    public function store(StoreEventRequest $request)
    {
        try {
            DB::beginTransaction();

            $name = $request->input('name');
            $startDate = $request->input('start-date');
            $endDate = $request->input('end-date');
            $category = $request->input('event-category');
            $type = $request->input('event-type');
            $onlineLink = $request->input('event-link');
            $description = $request->input('description');
            $file = $request->file('file');

            /*
            * event Attachment
            */
            $fileName = time().'_'.$file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $year = Carbon::now()->year;
            $filePath = 'events/'.$year."/".$fileName;

            // 1. Sent File to storage
            Storage::disk('public')->put($filePath, file_get_contents($file));

            $event = new Event;
            $event->id = Uuid::uuid4();
            $event->event_category_id = $category;
            $event->event_format_id = $type;
            $event->name = $name;
            $event->description = $description;
            $event->online_url = $onlineLink;
            $event->started_at = Carbon::parse($startDate)->isoFormat("YYYY-MM-DD HH:mm:ss");
            $event->ended_at = Carbon::parse($endDate)->isoFormat("YYYY-MM-DD HH:mm:ss");
            $event->created_by = Auth::id();
            $event->created_at = Carbon::now();
            $event->save();

            $eventAttachment = new EventAttachment;
            $eventAttachment->id = Uuid::uuid4();
            $eventAttachment->event_id = $event->id;
            $eventAttachment->file_name = $fileName;
            $eventAttachment->file_path = $filePath;
            $eventAttachment->extension = $fileExtension;
            $eventAttachment->created_by = Auth::id();
            $eventAttachment->created_at = Carbon::now();
            $eventAttachment->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage(), 500]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response(['message' => $ex->getMessage(), 500]);
        }

        $response = [
            'message' => [
                'title' => "Create",
                'text' => "Event has been created",
                'icon' => "success",
            ],
            'data' => $event,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }

    public function destroy($eventId)
    {
        try {

            DB::beginTransaction();

            /*
            * Event Attachment Delete
            1. Delete File in storage
            */

            $auctionChecked = Auction::where('event_id', $eventId)->count();

            if($auctionChecked) {
                $response = [
                    'message' => [
                        'title' => 'Auction use this event',
                        'text' => 'Do not delete this event',
                        'icon' => 'error'
                    ],
                    'code' => 422
                ];
                return response($response, $response['code']);
            }


            $eventAttachment = EventAttachment::where('event_id', $eventId)->first();
            // 1. Delete File in storage
            Storage::disk('public')->delete($eventAttachment->file_path);

            $eventAttachment->deleted_by = Auth::id();
            $eventAttachment->deleted_at = Carbon::now();
            $eventAttachment->save();

            $event = Event::where('id', $eventId)->first();
            $event->deleted_by = Auth::id();
            $event->deleted_at = now();
            $event->save();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage(), 500]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response(['message' => $ex->getMessage(), 500]);
        }

        $response = [
            'message' => [
                'title' => "Delete",
                'text' => "Event has been deleted",
                'icon' => "success",
            ],
            'code' => 200
        ];

        return response($response, $response['code']);
    }
}
