<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Http\Requests\users\StoreUserRequest;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['profile'])->get()->toArray();
        $userCount = count($users);

        return view('pages.users.index', compact('users', 'userCount'));
    }

    public function show($userId)
    {
        $user = User::where('id', $userId)->with(['profile', 'eventUser', 'event', 'attendances'])->first();

        return view('pages.users.show', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $hashPassword   = Hash::make($password);
        try {

            DB::beginTransaction();

            $user = new User;
            $user->id = Uuid::uuid4();
            $user->username = $username;
            $user->password = $hashPassword;
            $user->save();

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
                'text' => "User has been created",
                'icon' => "success",
            ],
            'data' => $user,
            'code' => 200
        ];

        return response($response, $response['code']);
    }

    public function destroy($userId)
    {
        try {

            DB::beginTransaction();

            $user = User::where('id', $userId)->first();
            $user->deleted_at = now();
            $user->deleted_by = Auth::id();
            $user->save();

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
                'text' => "User has been deleted",
                'icon' => "success",
            ],
            'data' => $user,
            'code' => 200
        ];

        return response()->json($response, $response['code']);
    }


}
