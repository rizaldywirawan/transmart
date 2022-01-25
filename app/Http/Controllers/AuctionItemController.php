<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionBidValue;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class AuctionItemController extends Controller
{
    public function index()
    {
        $auctionItems = Auction::with(['auctionBidWinner', 'auctionBidders', 'featuredAuctionAttachment'])
        ->withCount(['auctionBidders'])
        ->whereHas('featuredAuctionAttachment')
        ->orderBy('started_at', 'ASC')
        ->get();

        $sortedAuctionItems = [];

        $sortedActiveAuctionItems = [];
        $sortedInactiveAuctionItems = [];
        $sortedUpcomingAuctionItems = [];


        foreach ($auctionItems as $auctionItem) {
            $biddingTime = Carbon::parse($auctionItem->started_at)->addSeconds($auctionItem->live_time);

            // live condition
            if (now()->greaterThan($auctionItem->started_at) && now()->lessThan($biddingTime)) {
                array_push($sortedActiveAuctionItems, $auctionItem);

            // over condition
            } else if(now()->greaterThan($auctionItem->started_at) && now()->greaterThan($biddingTime)) {
                array_push($sortedInactiveAuctionItems, $auctionItem);

                // upcoming condition
            } else {
                array_push($sortedUpcomingAuctionItems, $auctionItem);
            }
        }

        $sortedAuctionItems = array_merge($sortedActiveAuctionItems, $sortedUpcomingAuctionItems, $sortedInactiveAuctionItems);

        return view('pages.auction-items.index', compact('sortedAuctionItems'));
    }

    public function show($auctionItem)
    {
        $auctionItem->load('auctionBidders', 'auctionBidWinner.profile', 'featuredAuctionAttachment');
        $auctionItem->loadCount('auctionBidders');

        $auctionBidValues = AuctionBidValue::where('event_id', 'ad22aa5c-03cf-40ae-a589-ca1a0454532d')->orderBy('value', 'ASC')->get();

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

        return view('pages.auction-items.show', compact('auctionItem', 'biddingStatus', 'remainingTime', 'remainingTimeInSeconds', 'auctionBidValues'));
    }
}
