<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\LocationType;

class LocationTypeController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $name = $request->input('name');

            $locationType = new LocationType;
            $locationType->id = Uuid::uuid4();
            $locationType->name = $name;
            $locationType->created_by = Auth::id();
            $locationType->created_at = Carbon::now();
            $locationType->save();

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
                'text' => "Location type has been created",
                'icon' => "success",
            ],
            'data' => $locationType,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }
}
