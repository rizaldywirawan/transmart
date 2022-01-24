<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

class AuctionBasedOnAttachmentController extends Controller
{
    public function index($auctionId)
    {
        $auction = Auction::with(['event', 'auctionAttachments', 'auctionBidders'])
                                ->where('id', $auctionId)
                                ->first();

        return view('pages.auctions.based-on.attachment', compact('auction'));
    }
}
