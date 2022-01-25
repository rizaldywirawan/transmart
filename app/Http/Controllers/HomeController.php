<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $auctionItems = Auction::with(['auctionBidWinner', 'auctionBidders'])
        ->withCount(['auctionBidders'])
        ->orderBy('started_at', 'ASC')->get();

        $disabledButton = false;

        return view('pages.home.index', compact('disabledButton'));
    }
}
