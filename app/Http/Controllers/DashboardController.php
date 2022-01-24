<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Auction;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $events = Event::with(['eventUsers', 'tenants', 'auctions', 'eventCategory', 'eventFormat'])->take(1)->get();

        $auctions = Auction::with(['event'])->get()->toArray();
        $attendances = Attendance::get()->toArray();

        return view('pages.dashboard.index', compact('events','auctions', 'attendances'));

    }
}
