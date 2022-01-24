<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

use App\Models\Event;
use App\Models\Auction;
use App\Models\AuctionAttachment;
use App\Http\Requests\auctions\StoreAuctionRequest;
use App\Http\Requests\auctions\UpdateAuctionRequest;

class AuctionController extends Controller
{
    public function index()
    {
        try {
            $auctions = Auction::get()->toArray();
            $totalAuction = count($auctions);
            $auctionDone = Auction::whereNotNull('won_by')->count();
            $auctionIncoming = $totalAuction - $auctionDone;
            $events = Event::get()->toArray();
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage(), 500]);
        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage(), 500]);
        }

        return view('pages.auctions.index', compact('auctions', 'totalAuction', 'auctionDone', 'auctionIncoming', 'events'));
    }


    public function show($auctionId)
    {
        $auctions = Auction::where('id', $auctionId)
                            ->with(['event', 'auctionAttachments', 'auctionBidderLatest', 'auctionBidders'])
                            ->first();

        return view('pages.auctions.show', compact('auctions'));

    }

    public function edit($auctionId)
    {
        try {
            $auction = Auction::with(['event', 'auctionAttachments', 'auctionBidders'])
                                ->where('id', $auctionId)
                                ->first();
            $events = Event::get()->toArray();


        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage(), 500]);
        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage(), 500]);
        }

        return view('pages.auctions.edit', compact('auction', 'events'));
    }

    public function store(StoreAuctionRequest $request)
    {
        $name = $request->input('name');
        $startDate = $request->input('start-date');
        $endDate   = $request->input('end-date');
        $startingBid   = $request->input('starting-bid');
        $bidIncrement   = $request->input('bid-increment');
        $itemDescription   = $request->input('description');
        $eventId = $request->input('event-id');
        $itemPhotos   = $request->file('files');

        try {

            DB::beginTransaction();

            $auction = new Auction;
            $auction->id = Uuid::uuid4();
            $auction->event_id = $eventId;
            $auction->name = $name;
            $auction->description = $itemDescription;
            $auction->started_at = Carbon::parse($startDate)->isoFormat('YYYY-MM-DD HH:mm:ss');
            $auction->ended_at = Carbon::parse($endDate)->isoFormat('YYYY-MM-DD HH:mm:ss');
            $auction->start_price = $startingBid;
            $auction->bid_increment = $bidIncrement;
            $auction->created_at = now();
            $auction->created_by = Auth::id();
            $auction->save();

            /*
            * Auction Attachment
            */
            foreach($itemPhotos as $itemPhoto) {
                $fileName = time().'_'.$itemPhoto->getClientOriginalName();
                $fileExtension = $itemPhoto->getClientOriginalExtension();
                $year = Carbon::now()->year;
                $filePath = 'auctions/'.$year."/".$fileName;

                // 1. Sent File to storage
                Storage::disk('public')->put($filePath, file_get_contents($itemPhoto));

                $auctionAttachment = new AuctionAttachment;
                $auctionAttachment->id = Uuid::uuid4();
                $auctionAttachment->auction_id = $auction->id;
                $auctionAttachment->file_name = $fileName;
                $auctionAttachment->file_path = $filePath;
                $auctionAttachment->extension = $fileExtension;
                $auctionAttachment->created_by = Auth::id();
                $auctionAttachment->created_at = Carbon::now();
                $auctionAttachment->save();
            }

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
                'title' => "Created",
                'text' => "Auction has been created",
                'icon' => "success",
            ],
            'data' => $auction,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }

    public function update(UpdateAuctionRequest $request, $auctionId)
    {
        $name = $request->input('name');
        $startDate = $request->input('start-date');
        $endDate   = $request->input('end-date');
        $startingBid   = $request->input('starting-bid');
        $bidIncrement   = $request->input('bid-increment');
        $itemDescription   = $request->input('description');
        $eventId = $request->input('event-id');
        $itemPhotos   = $request->file('files');
        try {

            DB::beginTransaction();

            $auction = Auction::where('id', $auctionId)->first();
            $auction->event_id = $eventId;
            $auction->name = $name;
            $auction->description = $itemDescription;
            $auction->started_at = Carbon::parse($startDate)->isoFormat('YYYY-MM-DD HH:mm:ss');
            $auction->ended_at = Carbon::parse($endDate)->isoFormat('YYYY-MM-DD HH:mm:ss');
            $auction->start_price = $startingBid;
            $auction->bid_increment = $bidIncrement;
            $auction->updated_at = now();
            $auction->updated_by = Auth::id();
            $auction->save();

            /*
            * Auction Attachment
            */
            if($itemPhotos) {
                foreach($itemPhotos as $itemPhoto) {
                    $fileName = time().'_'.$itemPhoto->getClientOriginalName();
                    $fileExtension = $itemPhoto->getClientOriginalExtension();
                    $year = Carbon::now()->year;
                    $filePath = 'auctions/'.$year."/".$fileName;

                    // 1. Sent File to storage
                    Storage::disk('public')->put($filePath, file_get_contents($itemPhoto));

                    $auctionAttachment = new AuctionAttachment;
                    $auctionAttachment->id = Uuid::uuid4();
                    $auctionAttachment->auction_id = $auction->id;
                    $auctionAttachment->file_name = $fileName;
                    $auctionAttachment->file_path = $filePath;
                    $auctionAttachment->extension = $fileExtension;
                    $auctionAttachment->created_by = Auth::id();
                    $auctionAttachment->created_at = Carbon::now();
                    $auctionAttachment->save();
                }
            }



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
                'title' => "Update",
                'text' => "Auction has been Updated",
                'icon' => "success",
            ],
            'code' => 200
        ];

        return response($response, $response['code']);
    }

    public function destroy($auctionId)
    {
        try {

            DB::beginTransaction();

            /*
            * Auction Attachment Delete
            1. Delete File in storage
            */

            $auctionAttachment = AuctionAttachmen::where('auction_id', $auctionId)->first();
            // 1. Delete File in storage
            Storage::disk('local')->delete($auctionAttachment->file_path);

            $auctionAttachment->deleted_by = Auth::id();
            $auctionAttachment->deleted_at = Carbon::now();
            $auctionAttachment->save();

            $auction = Auction::where('id', $auctionId)->first();
            $auction->deleted_by = Auth::id();
            $auction->deleted_at = now();
            $auction->save();

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
                'text' => "Auction has been deleted",
                'icon' => "success",
            ],
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }
}
