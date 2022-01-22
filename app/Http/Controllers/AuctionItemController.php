<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class AuctionItemController extends Controller
{
    public function index()
    {
        $auction = Auction::first();
        return redirect("/auction-items/{$auction->id}");
    }

    public function show($auctionItem)
    {
        $auctionItem->load('auctionBidders', 'auctionBidWinner.profile');
        $auctionItem->loadCount('auctionBidders');

        $biddingTime = Carbon::parse($auctionItem->started_at)->addSeconds($auctionItem->live_time);

        $biddingStatus = "live";

        if (now()->greaterThan($auctionItem->started_at) && now()->lessThan($biddingTime)) {
            $biddingStatus = "live";
            $remainingTime = now()->diff(Carbon::parse($auctionItem->started_at)->addSeconds($auctionItem->live_time));
            $remainingTimeInSeconds = now()->diffInSeconds(Carbon::parse($auctionItem->started_at)->addSeconds($auctionItem->live_time));

        } else if(now()->greaterThan($auctionItem->started_at) && now()->greaterThan($biddingTime)) {
            $biddingStatus = "over";
            $remainingTimeInSeconds = 0;
            $remainingTime = 0;
        } else {
            $biddingStatus = "upcoming";
            $remainingTime = now()->diff($auctionItem->started_at);
            $remainingTimeInSeconds = now()->diffInSeconds($auctionItem->started_at);
        }

        return view('pages.auction-items.show', compact('auctionItem', 'biddingStatus', 'remainingTime', 'remainingTimeInSeconds'));
    }
}
