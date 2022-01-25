<?php

namespace App\Http\Controllers;

use App\Events\AuctionBidderPriceSubmitted;
use App\Events\PriceSubmitted;
use App\Models\AuctionBidder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionItemBidController extends Controller
{
    public function store(Request $request, $auctionItem)
    {
        $bidPriceInput = $request->input('bid-price');

        $auctionItem->load('latestAuctionBidder');

        $code = 200;
        $response = [
            'message' => [
                'title' => 'Bid berhasil dilakukan.',
                'text' => 'Penawaran Anda berhasil dilakukan.'
            ]
        ];

        if ($auctionItem->latestAuctionBidder === null) {

            if ($auctionItem->start_price >= $bidPriceInput) {
                $code = 422;

                $response = [
                    'message' => [
                        'title' => 'Penawaran gagal dilakukan.',
                        'text' => 'Harga yang Anda ajukan dibawah penawaran awal.'
                    ]
                ];

                return response($response, $code);
            }

        } else {
            if($auctionItem->latestAuctionBidder->bid_price >= $bidPriceInput) {

                $code = 422;

                $response = [
                    'message' => [
                        'title' => 'Penawaran gagal dilakukan.',
                        'text' => 'Harga yang Anda ajukan dibawah penawaran tertinggi.'
                    ]
                ];

                return response($response, $code);
            }
        }

        try {

            DB::beginTransaction();

            $auctionBidder = new AuctionBidder;
            $auctionBidder->auction_id = $auctionItem->id;
            $auctionBidder->user_id = Auth::id();
            $auctionBidder->bid_price = $bidPriceInput;
            $auctionBidder->created_by = Auth::id();
            $auctionBidder->created_at = now();
            $auctionBidder->save();

            $auctionBidder->load('user.profile');

            DB::commit();

            broadcast(new AuctionBidderPriceSubmitted($auctionItem, $auctionBidder));

        } catch (\Throwable $th) {
            DB::rollBack();

            $code = 500;
            $response = [
                'message' => [
                    'title' => 'Error.',
                    'text' => $th->getMessage()
                ]
            ];
        }

        return response($response, $code);
    }
}
