<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\BusinessUnit;
use App\Models\User;

class AttendanceController extends Controller
{

    public function index()
    {
        $totalUser = User::whereHas('roles', function($query) {
            $query->where('name', 'participant');
        })
        ->count();

        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'participant');
        })
        ->get()
        ->toArray();

        $userIDs = array_column($users, 'id');


        $attendances = Attendance::whereIn('user_id', $userIDs)->with(['user.profile', 'locationType'])->orderBy('created_at', 'DESC')->get();

        $attendanceToday = Attendance::whereIn('user_id', $userIDs)->whereBetween('created_at', [now()->isoFormat('YYYY-MM-DD 00:00:00.000'), now()->isoFormat('YYYY-MM-DD 23:59:00.000')])->count();
        $attendanceByWebsite = Attendance::whereIn('user_id', $userIDs)->where('location_type_id', 'dd00a679-f0f0-45ae-9ab3-60baabcbbd67')->count();
        $attendanceByQRCode = Attendance::whereIn('user_id', $userIDs)->where('location_type_id', '523c9f80-7a68-4f9a-85f1-f1597d65a513')->count();


        $businessUnits = BusinessUnit::with('company')
        ->withCount(['participants'])
        ->get();

        return view('pages.attendances.index', compact('attendances', 'attendanceToday', 'attendanceByWebsite', 'attendanceByQRCode', 'totalUser', 'businessUnits'));
    }
}
