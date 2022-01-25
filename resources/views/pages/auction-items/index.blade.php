@extends('layouts.user.master')

@section('title', 'Beranda')

@section('content')

@if (count($sortedAuctionItems))
    <div id="auction-item-detail" data-id={{ $sortedAuctionItems[0]->id }}
        class="featured-auction-item-box-shadow p-6 rounded-2xl bg-white flex sm:flex-row flex-col -mt-24 sm:-mt-20 mb-6 sm:max-w-screen-xl w-full z-10 relative mb-12">
        <div class="flex justify-between sm:flex-row flex-col">
            <div class="flex sm:mr-6 sm:flex-row flex-col mb-6 sm:mb-0 sm:w-4/5">

                @if ($sortedAuctionItems[0]->featuredAuctionAttachment)
                    <img src="{{ $sortedAuctionItems[0]->featuredAuctionAttachment->file_path }}" alt="Auction Item Image"
                        class="h-60 w-60 bg-background rounded-2xl mb-3 object-cover sm:mr-6 mr-0">

                @else

                    <img src="{{ asset('images/demo/iphone.jpg') }}" alt="Auction Item Image"
                    class="h-60 w-60 bg-background rounded-2xl mb-3 object-cover sm:mr-6 mr-0">


                @endif

                <div id="auction-item-detail__description" class="flex-grow">
                    <div id="auctio-item-detail__description__title" class="sm:flex items-center mb-3">
                        <h1 id="auction-item-detail__description__title__name" class="text-lg sm:text-2xl font-bold mr-0 sm:mr-3 mb-3 sm:mb-0">
                            {{ $sortedAuctionItems[0]->name }}</h1>

                        @php
                            if ($sortedAuctionItems[0]['bidding_status']['status'] === "live") {
                                $bidStatusText = 'Berlangsung';
                                $bidStatusBackgroundColor = 'bg-primary-100';
                                $bidStatusColor = "text-primary-500";
                            } elseif ($sortedAuctionItems[0]['bidding_status']['status'] === "upcoming") {

                                $bidStatusText = 'Mendatang';
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
                                class="text-sm font-light {{ $bidStatusColor }} text-center">
                                {{ $bidStatusText }}
                            </span>

                            @if ($sortedAuctionItems[0]['bidding_status']['status'] === "live")
                            <img id="auctio-item-detail__description__title__status__icon"
                                src="{{ asset('images/icons/icon-fire.svg') }}" alt="Bid Live Now!" class="ml-3">
                            @endif
                        </div>
                    </div>
                    <div class="text-md sm:text-base font-light text-grayscale-400 mb-1">
                        Deskripsi
                    </div>
                    <p id="auction-item-detail__description__narration" class="text-sm sm:text-md font-normal text-grayscale-500 mb-3">
                        {!! nl2br(e($sortedAuctionItems[0]->description)) !!}
                    </p>
                    <div class="flex max-w-max items-center mb-4 bg-primary-100 rounded-lg p-2 outline outline-1 outline-primary-700 outline-dashed">
                        <span class="h-5 w-5 flex items-center justify-center mr-3">
                            <img src="{{ asset('images/icons/icon-calendar.svg') }}" alt="Auction Item Bid Time"
                                class="w-full h-full">
                        </span>
                        <h6 class="text-sm font-light text-grayscale-500">{{ $sortedAuctionItems[0]->formatted_started_at }}</h6>
                    </div>
                    <div>
                        <h6 class="text-sm font-light text-grayscale-400">Harga terakhir</h6>
                        <h3 id="auction-item-latest-price" class="text-lg font-bold text-primary-500">Rp
                            {{ $sortedAuctionItems[0]->auction_bidders_count === 0 ? $sortedAuctionItems[0]->formatted_start_price : $sortedAuctionItems[0]->latestAuctionBidder->formatted_bid_price }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:w-1/5">
                <div id="auction-item__remaining-time" data-remaining-seconds="{{ $sortedAuctionItems[0]['bidding_status']['remaining-time-in-seconds'] }}"
                    class="general-box-shadow p-3 rounded-xl w-full mb-4 h-min">

                    @if ($sortedAuctionItems[0]['bidding_status']['status'] !== "over")

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
                                    class="text-xl font-bold text-grayscale-600">{{ $sortedAuctionItems[0]['bidding_status']['remaining-time']->h }}</span>
                                <span class="text-sm font-light text-grayscale-400">Jam</span>
                            </div>
                            <div class="mr-5">
                                <span class="text-xl font-bold">:</span>
                            </div>
                            <div class="flex flex-col items-center justify-center mr-5">
                                <span id="auction-item__remaining-time__minutes"
                                    class="text-xl font-bold text-grayscale-600">{{ $sortedAuctionItems[0]['bidding_status']['remaining-time']->i }}</span>
                                <span class="text-sm font-light text-grayscale-400">Menit</span>
                            </div>
                            <div class="mr-5">
                                <span class="text-xl font-bold">:</span>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <span id="auction-item__remaining-time__seconds"
                                    class="text-xl font-bold text-grayscale-600">{{ $sortedAuctionItems[0]['bidding_status']['remaining-time']->s }}</span>
                                <span class="text-sm font-light text-grayscale-400">Detik</span>
                            </div>
                        </div>

                    @else

                        <h3 class="text-sm font-normal text-grayscale-400">Pemenang</h3>

                        @if ($sortedAuctionItems[0]->won_by !== null)
                        <div class="flex items-center">
                            <h1 class="text-base font-bold text-grayscale-600 mr-3">
                                {{ $sortedAuctionItems[0]->auctionBidWinner->profile->name }}</h1>
                            <img src="{{ asset('images/icons/icon-crown.svg') }}" alt="Auction Winner" class="h-6 w-6">
                        </div>
                        @elseif ($sortedAuctionItems[0]->latestAuctionBidder !== null)
                        <div class="flex items-center">
                            <h1 class="text-base font-bold text-grayscale-600 mr-3">
                                {{ $sortedAuctionItems[0]->latestAuctionBidder->user->profile->name }}</h1>
                            <img src="{{ asset('images/icons/icon-crown.svg') }}" alt="Auction Winner" class="h-6 w-6">
                        </div>
                        @else
                        <div class="flex items-center">
                            <h1 class="text-base font-bold text-grayscale-400 mr-3">Belum ditentukan</h1>
                            <img src="{{ asset('images/icons/icon-sad.svg') }}" alt="No Winner Yet" class="h-6 w-6">
                        </div>
                        @endif
                    @endif
                </div>
                <a href="/auction-items/{{ $sortedAuctionItems[0]->id }}" class="text-center bg-primary-600 text-lg font-bold text-white py-4 rounded-xl">Lihat Barang</a>
            </div>
        </div>
    </div>
@else
    <div class="p-6 rounded-2xl bg-white -mt-24 sm:-mt-20 mb-6 sm:max-w-screen-xl w-full z-10 relative flex flex-col items-center">
        <img src="{{ asset('images/icons/icon-auction.svg') }}" alt="Auction Gavel" class="w-full w-40 mb-10">
        <p class="text-center text-md sm:text-lg font-normal text-grayscale-500 mb-6">
            Belum ada barang yang akan dilelang.
            <br>
            <br>
            Mohon tunggu ya.
        </p>
        <h1 class="text-xl sm:text-2xl font-bold text-primary-800 mb-6 text-center">Selamat Mengikuti Rangkaian Acara</h1>
        <a href="/" class="text-md sm:text-lg font-bold bg-primary-600 text-white rounded-xl px-10 sm:px-16 py-4">Kembali</a>
    </div>
@endif

@if (count($sortedAuctionItems))
    <div id="auction-item-list">
        <h3 class="text-2xl font-bold text-grayscale-700 mb-3">Daftar Barang</h3>
        <div class="auction-item-container sm:gap-6 sm:grid-cols-4 grid gap-y-6 grid-cols-1 ">

            @foreach ($sortedAuctionItems as $auctionItem)

                @php
                    if ($auctionItem['bidding_status']['status'] === "live") {
                        $bidStatusText = 'Berlangsung';
                        $bidStatusBackgroundColor = 'bg-primary-100';
                        $bidStatusColor = "text-primary-500";
                    } elseif ($auctionItem['bidding_status']['status'] === "upcoming") {

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

                <div class="bg-white rounded-xl auction-item">

                    @if ($auctionItem->featuredAuctionAttachment)
                        <img src="{{ $auctionItem->featuredAuctionAttachment->file_path }}" alt="Barang Lelang" class="w-full rounded-t-xl">

                    @else

                        <img src="{{ asset('images/demo/iphone.jpg') }}" alt="Barang Lelang" class="w-full rounded-t-xl">

                    @endif

                    <div class="p-3 flex flex-col">
                        <h1 class="text-base font-bold text-grayscale-600 mb-4">{{ $auctionItem->name }}</h1>
                        <div id="auction-item-detail__description__title__status"
                            class="w-max py-2.5 px-4 {{ $bidStatusBackgroundColor }} rounded flex items-center justify-center mb-4">
                            <span id="auctio-item-detail__description__title__status__text"
                                class="text-sm font-light {{ $bidStatusColor }}">
                                {{ $bidStatusText }}
                            </span>

                            @if ($auctionItem['bidding_status']['status'] === "live")
                            <img id="auctio-item-detail__description__title__status__icon"
                                src="{{ asset('images/icons/icon-fire.svg') }}" alt="Bid Live Now!" class="ml-3">
                            @endif
                        </div>
                        <div class="flex justify-center items-center mb-4 bg-primary-100 rounded-lg p-2 outline outline-1 outline-primary-700 outline-dashed w-full">
                            <span class="h-5 w-5 flex items-center justify-center mr-3">
                                <img src="{{ asset('images/icons/icon-calendar.svg') }}" alt="Auction Item Bid Time"
                                    class="w-full h-full">
                            </span>
                            <h6 class="text-sm font-light text-grayscale-500">{{ $auctionItem->formatted_started_at }}</h6>
                        </div>

                        <h6 class="text-sm font-light text-grayscale-400">{{ $auctionItem->auction_bidders_count === 0 ? "Harga Awal" : "Penawaran Terakhir" }}</h6>
                        <h3 id="auction-item-latest-price" class="text-lg font-bold text-primary-500 mb-3">Rp
                            {{ $auctionItem->auction_bidders_count === 0 ? $auctionItem->formatted_start_price : $auctionItem->latestAuctionBidder->formatted_bid_price }}
                        </h3>
                        <a href="/auction-items/{{ $auctionItem->id }}" class="text-center bg-primary-600 text-lg font-bold text-white py-4 rounded-xl w-full block">Lihat Barang</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif


@endsection

@push('scripts')
<script src="{{ asset('js/pages/auction-items/index.js') }}" defer></script>
@endpush
