<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Auction;

class AuctionTableController extends Controller
{
    public function index()
    {
        $auctions = Auction::with(['event', 'auctionAttachments', 'auctionBidders', 'auctionBidderLatest'])
                            ->get()
                            ->toArray();

        $auction = DataTables::of($auctions)
                        ->addIndexColumn()
                        ->addColumn('action', 'pages.auctions.datatables.action')
                        ->rawColumns(
                            [
                                'action'
                            ]
                        )
                        ->make(true);

        return $auction;
    }
}
