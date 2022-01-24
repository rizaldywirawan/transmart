@extends('layouts.user.master')

@section('title', 'Auction Item')

@section('content')
<div id="auction-item-detail" data-id={{ $auctionItem->id }}
    class="featured-auction-item-box-shadow p-6 rounded-2xl bg-white flex sm:flex-row flex-col -mt-24 sm:-mt-20 mb-6 sm:max-w-screen-xl w-full z-10 relative">
    <div id="auction-item-detail__images" class="sm:mr-6 mb-6 sm:mb-0 mx-auto">
        <img src="{{ asset('images/demo/iphone.jpg') }}" alt="Auction Item Image"
            class="h-60 w-60 bg-background rounded-2xl mb-3 object-cover">
        <div id="auction-item-detail__images__slides" class="flex">
            <div class="h-16 w-16 bg-background rounded-2xl mr-3"></div>
            <div class="h-16 w-16 bg-background rounded-2xl mr-3"></div>
            <div class="h-16 w-16 bg-background rounded-2xl mr-3"></div>
        </div>
    </div>
    <div id="auction-item-detail__description" class="flex-grow">
        <div id="auctio-item-detail__description__title" class="sm:flex items-center mb-3">
            <h1 id="auction-item-detail__description__title__name" class="text-lg sm:text-2xl font-bold mr-0 sm:mr-3 mb-3 sm:mb-0">
                {{ $auctionItem->name }}</h1>

            @php

            if ($biddingStatus === "live") {
                $bidStatusText = 'Berlangsung';
                $bidStatusBackgroundColor = 'bg-primary-100';
                $bidStatusColor = "text-primary-500";
            } elseif ($biddingStatus === "upcoming") {
                $bidStatusText = 'Akan Datang';
                $bidStatusBackgroundColor = 'bg-peach-100';
                $bidStatusIcon = "";
                $bidStatusColor = "text-peach-200";
            } else {
                $bidStatusText = 'Selesai';
                $bidStatusBackgroundColor = 'bg-green-100';
                $bidStatusIcon = "";
                $bidStatusColor = "text-green-600";
            }
            @endphp

            <div id="auction-item-detail__description__title__status"
                class="w-max py-2.5 px-4 {{ $bidStatusBackgroundColor }} rounded flex items-center justify-center">
                <span id="auctio-item-detail__description__title__status__text"
                    class="text-sm font-light {{ $bidStatusColor }}">
                    {{ $bidStatusText }}
                </span>

                @if ($biddingStatus === "live")
                <img id="auctio-item-detail__description__title__status__icon"
                    src="{{ asset('images/icons/icon-fire.svg') }}" alt="Bid Live Now!" class="ml-3">
                @endif
            </div>
        </div>
        <div class="text-md sm:text-base font-light text-grayscale-400 mb-1">
            Deskripsi
        </div>
        <p id="auction-item-detail__description__narration" class="text-sm sm:text-md font-normal text-grayscale-500 mb-3">
            {{ $auctionItem->description }}
        </p>
        <div class="flex max-w-max items-center mb-4 bg-primary-100 rounded-lg p-2 outline outline-1 outline-primary-700 outline-dashed">
            <span class="h-5 w-5 flex items-center justify-center mr-3">
                <img src="{{ asset('images/icons/icon-calendar.svg') }}" alt="Auction Item Bid Time"
                    class="w-full h-full">
            </span>
            <h6 class="text-sm font-light text-grayscale-500">{{ $auctionItem->formatted_started_at }}</h6>
        </div>
        <div id="auction-item__remaining-time" data-remaining-seconds="{{ $remainingTimeInSeconds }}"
            class="general-box-shadow p-3 rounded-xl w-max mb-4">

            @if ($biddingStatus !== "over")

                <div class="flex items-center mb-1">
                    <span class="h-4 w-4 flex items-center justify-center mr-1.5">
                        <img src="{{ asset('images/icons/icon-clock.svg') }}" alt="Auction Remaining Time"
                            class="w-full h-full">
                    </span>
                    <span class="text-sm font-bold text-grayscale-500">Waktu Tersisa</span>
                </div>

                <div class="flex justify-between">
                    <div class="flex flex-col items-center justify-center mr-5">
                        <span id="auction-item__remaining-time__hours"
                            class="text-xl font-bold text-grayscale-600">{{ $remainingTime->h }}</span>
                        <span class="text-sm font-light text-grayscale-400">Jam</span>
                    </div>
                    <div class="mr-5">
                        <span class="text-xl font-bold">:</span>
                    </div>
                    <div class="flex flex-col items-center justify-center mr-5">
                        <span id="auction-item__remaining-time__minutes"
                            class="text-xl font-bold text-grayscale-600">{{ $remainingTime->i }}</span>
                        <span class="text-sm font-light text-grayscale-400">Menit</span>
                    </div>
                    <div class="mr-5">
                        <span class="text-xl font-bold">:</span>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <span id="auction-item__remaining-time__seconds"
                            class="text-xl font-bold text-grayscale-600">{{ $remainingTime->s }}</span>
                        <span class="text-sm font-light text-grayscale-400">Detik</span>
                    </div>
                </div>

            @else

                <h3 class="text-sm font-normal text-grayscale-400">Pemenang</h3>

                @if ($auctionItem->won_by !== null)
                <div class="flex items-center justify-center">
                    <h1 class="text-base font-bold text-grayscale-600 mr-3">
                        {{ $auctionItem->auctionBidWinner->profile->name }}</h1>
                    <img src="{{ asset('images/icons/icon-crown.svg') }}" alt="Auction Winner" class="h-6 w-6">
                </div>
                @elseif ($auctionItem->latestAuctionBidder !== null)
                <div class="flex items-center justify-center">
                    <h1 class="text-base font-bold text-grayscale-600 mr-3">
                        {{ $auctionItem->latestAuctionBidder->user->profile->name }}</h1>
                    <img src="{{ asset('images/icons/icon-crown.svg') }}" alt="Auction Winner" class="h-6 w-6">
                </div>
                @else
                <div class="flex items-center justify-center">
                    <h1 class="text-base font-bold text-grayscale-400 mr-3">Belum ditentukan</h1>
                    <img src="{{ asset('images/icons/icon-sad.svg') }}" alt="No Winner Yet" class="h-6 w-6">
                </div>
                @endif
            @endif
        </div>
        <div>
            <h6 class="text-sm font-light text-grayscale-400">Harga terakhir</h6>
            <h3 id="auction-item-latest-price" class="text-lg font-bold text-primary-500">Rp
                {{ $auctionItem->auction_bidders_count === 0 ? $auctionItem->formatted_start_price : $auctionItem->latestAuctionBidder->formatted_bid_price }}
            </h3>
        </div>
    </div>
</div>

{{-- Auction Item Bid Information --}}
<div id="auction-item-bid-information" class="p-6 rounded-2xl bg-white sm:max-w-screen-xl w-full z-10 relative">
    <div class="flex sm:flex-row flex-col justify-between">
        <div
            class="rounded-xl outline outline-primary-200 p-6 flex justify-center items-center flex-col flex-grow mr-6 mb-3 sm:mb-0 outline-1 w-full text-center">
            <h3 class="text-base font-light text-grayscale-500">Penawaran Awal</h3>
            <h2 class="text-xl font-bold text-primary-500">Rp {{ $auctionItem->formatted_start_price }}</h2>
        </div>
        <div
            class="rounded-xl outline outline-primary-200 p-6 flex justify-center items-center flex-col flex-grow mr-6 mb-3 sm:mb-0 outline-1 w-full text-center">
            <h3 class="text-base font-light text-grayscale-500 mb-2">Penawaran Terakhir</h3>

            @if ($auctionItem->auction_bidders_count)
                <h2 id="auction-bidder-latest-bid-price" class="text-xl font-bold text-primary-500">Rp {{ $auctionItem->latestAuctionBidder->formatted_bid_price }}</h2>
                <h2 id="auction-bidder-latest-bid-name" class="text-sm font-normal text-grayscale-400">oleh {{ $auctionItem->latestAuctionBidder->user->profile->name }}</h2>
            @else
                <h2 id="auction-bidder-latest-bid-price" class="text-xl font-bold text-primary-500 hidden"></h2>
                <h2 id="auction-bidder-latest-bid-name" class="text-sm font-normal text-grayscale-400">Belum Ada Penawaran</h2>
            @endif
        </div>
        <div
            class="rounded-xl outline outline-primary-200 p-6 flex justify-center items-center flex-col flex-grow sm:mb-0 outline-1 w-full text-center">
            <h3 class="text-base font-light text-grayscale-500">Kelipatan Penawaran</h3>
            <h2 class="text-xl font-bold text-primary-500">Rp {{ $auctionItem->formatted_bid_increment }}</h2>
        </div>
    </div>

    @php
        $displayStatus = "hidden";
        $length = "lg:w-1/2";

        if ($auctionItem->auction_bidders_count) {
            $displayStatus = "block";
        }

        if ($biddingStatus !== "live") {
            $length = "lg:w-full";
        }

    @endphp

    {{-- Auction Item Bid Historical and Submission --}}
    <div id="auction-item-bid-historical-and-submission" class="flex flex-col sm:flex-row">
        <div id="auction-item-bid-historical" class="w-sceen {{ $length }} mr-0 sm:mr-6 mt-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-base font-bold">Riwayat Penawaran</h3>
                {{-- <span class="text-sm font-light text-primary-500 text-right">Lihat Penawaran</span> --}}
            </div>
            <div id="auction-item-bid-historical__entries">

                @if ($auctionItem->auction_bidders_count)
                    @foreach ($auctionItem->auctionBidders as $bidder)
                        <div class="general-box-shadow p-3 flex items-center rounded-xl mb-3">
                            <span class="h-8 w-8 sm:h-5 sm:w-5 mr-3">
                                <img src="{{ asset('images/icons/icon-money.svg') }}" alt="Auction Item Bid Record"
                                    class="h-full">
                            </span>
                            <h6 class="text-sm font-normal">{{ $bidder->user->profile->name }} melakukan penawaran sebesar <span
                                    class="text-primary-500 text-base font-bold">Rp {{ $bidder->formatted_bid_price }}</span>
                            </h6>
                        </div>
                    @endforeach
                @else
                    <div id="auction-item-no-bid-yet" class="bg-white general-box-shadow w-full justify-center items-center flex flex-col py-6 rounded-xl">
                        <img src="{{ asset('images/icons/icon-empty.svg') }}" alt="There's No Bid for This Item" class="max-w-xs mb-6">
                        <h6 class="text-md font-light text-grayscale-400">Belum ada penawaran harga.</h6>
                    </div>
                @endif
            </div>
        </div>

        @if ($biddingStatus === "live")
        <div id="auction-item-bid-submission"
            class="h-64 w-full lg:w-1/2 fixed sm:static left-0 bottom-0 sm:left-auto sm:bottom-auto bg-white p-6 sm:p-0 mt-0 sm:mt-6 bid-column-box-shadow">
            <h3 class="text-base font-bold mb-3">Nominal Penawaran</h3>
            <input type="hidden" name="bid-price" id="auction-item-bid-submission__bid-price" placeholder="0" value="0" disabled>
            <div id="auction-item-bid-submission__bid-price-placeholder" class="px-4 py-3 text-sm font-normal rounded-lg w-full border border-grayscale-300 mb-3">Rp 0</div>
            <div class="flex overflow-x-scroll mb-3">
                @foreach ($auctionBidValues as $bidValue)
                    <button class="bid-value p-2 rounded bg-primary-400 text-white text-sm font-bold shrink-0 mr-3" data-value={{ $bidValue->value }}>Rp {{ $bidValue->formatted_bid_value }}</button>
                @endforeach
            </div>
            <button id="auction-item-bid-submission__button" class="py-4 px-12 rounded-xl bg-primary-500 text-lg font-bold text-white w-full sm:w-auto">Ajukan
                Penawaran</button>
        </div>
        @endif
    </div>
</div>


@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/pages/auction-items/show.js') }}" defer></script>
@endpush
