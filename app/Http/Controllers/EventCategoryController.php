<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\EventCategory;

class EventCategoryController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $name = $request->input('name');

            $eventCategory = new EventCategory;
            $eventCategory->id = Uuid::uuid4();
            $eventCategory->name = $name;
            $eventCategory->created_by = Auth::id();
            $eventCategory->created_at = Carbon::now();
            $eventCategory->save();

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
                'text' => "Event Category has been created",
                'icon' => "success",
            ],
            'data' => $eventCategory,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }
}
