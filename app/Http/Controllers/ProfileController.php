<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $profiles = Profile::with(['user'])->get();

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
            'data' => $profiles,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }

    public function show($profileId)
    {
        try {
            $profile = Profile::where('id', $profileId)->with(['user'])->first();

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
            'data' => $profile,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {

        $userId = $request->input('user-id');
        $name = $request->input('name');
        $company = $request->input('company');
        $jobTitle = $request->input('job-title');
        $phone = $request->input('phone');
        $email = $request->input('email');

        try {

            DB::beginTransaction();

            $profile = new Profile;
            $profile->id = Uuid::uuid4();
            $profile->user_id = $userId;
            $profile->name = $name;
            $profile->company = $company;
            $profile->job_title = $jobTitle;
            $profile->phone = $phone;
            $profile->email = $email;
            $profile->save();

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
                'text' => "Profile has been created",
                'icon' => "success",
            ],
            'data' => $profile,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }
}
