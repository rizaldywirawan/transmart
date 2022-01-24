<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Event;

class EventTableController extends Controller
{
    public function index()
    {
        $events = Event::with(['eventUsers', 'tenants', 'auctions', 'eventCategory', 'eventFormat'])
                            ->orderBy('created_at')
                            ->get()
                            ->toArray();

        $event = DataTables::of($events)
                        ->addIndexColumn()
                        ->addColumn('action', 'pages.events.datatables.action')
                        ->rawColumns(
                            [
                                'action'
                            ]
                        )
                        ->make(true);

        return $event;
    }
}
