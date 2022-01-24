<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\EventFormat;

class EventFormatController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $name = $request->input('name');

            $eventFormat = new EventFormat;
            $eventFormat->id = Uuid::uuid4();
            $eventFormat->name = $name;
            $eventFormat->created_by = Auth::id();
            $eventFormat->created_at = Carbon::now();
            $eventFormat->save();

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
                'text' => "Event Format type has been created",
                'icon' => "success",
            ],
            'data' => $eventFormat,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }

}
