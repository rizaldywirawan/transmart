<?php

namespace App\Http\Controllers;

use App\Events\PriceSubmitted;
use Illuminate\Http\Request;

class AuctionItemBidController extends Controller
{
    public function store(Request $request)
    {
        PriceSubmitted::dispatch();
    }
}
