@extends('layouts.user.master')

@section('title', 'Auction Item')

@section('content')
    <div id="auction-item-detail" class="featured-auction-item-box-shadow p-6 rounded-2xl bg-white flex sm:flex-row flex-col -mt-24 sm:-mt-20 mb-6 sm:max-w-screen-xl w-full z-10 relative">
        <div id="auction-item-detail__images" class="sm:mr-6 mb-6 sm:mb-0 mx-auto">
            <img src="{{ asset('images/demo/iphone.jpg') }}" alt="Auction Item Image" class="h-60 w-60 bg-background rounded-2xl mb-3 object-cover">
            <div id="auction-item-detail__images__slides" class="flex">
                <div class="h-16 w-16 bg-background rounded-2xl mr-3"></div>
                <div class="h-16 w-16 bg-background rounded-2xl mr-3"></div>
                <div class="h-16 w-16 bg-background rounded-2xl mr-3"></div>
            </div>
        </div>
        <div id="auction-item-detail__description" class="flex-grow">
            <div id="auctio-item-detail__description__title" class="sm:flex items-center mb-3">
                <h1 id="auctio-item-detail__description__title__name" class="text-2xl font-bold mr-0 sm:mr-3">Kursi Putih by IKEA</h1>
                <div id="auctio-item-detail__description__title__status" class="w-max py-2.5 px-4 bg-primary-100 rounded flex items-center justify-center">
                    <span id="auctio-item-detail__description__title__status__text" class="text-sm font-light text-primary-500 mr-3">Live Now</span>
                    <img  id="auctio-item-detail__description__title__status__icon" src="{{ asset('images/icons/icon-live.svg') }}" alt="Bid Live Now!">
                </div>
            </div>
            <div class="text-base font-light text-grayscale-400 mb-1">
                Deskripsi
            </div>
            <p id="auction-item-detail__description__narration" class="text-lg font-normal text-grayscale-500 mb-3">
                Koleksi rare item kursi dari IKEA pada tahun 2020
            </p>
            <div class="flex w-full items-center mb-4">
                <span class="h-5 w-5 flex items-center justify-center mr-3">
                    <img src="{{ asset('images/icons/icon-calendar.svg') }}" alt="Auction Item Bid Time" class="w-full h-full">
                </span>
                <div class="flex flex-col sm:flex-row">
                    <h6 class="text-sm font-light text-grayscale-500">Wed, 01 January 2022 08:00</h6>
                    <span class="hidden sm:block text-sm font-light text-grayscale-500 mx-2"> - </span>
                    <h6 class="text-sm font-light text-grayscale-500">Wed, 01 January 2022 09:00</h6>
                </div>
            </div>
            <div class="general-box-shadow p-3 rounded-xl w-max mb-4">
                <div class="flex items-center mb-1">
                    <span class="h-4 w-4 flex items-center justify-center mr-1.5">
                        <img src="{{ asset('images/icons/icon-timer.svg') }}" alt="Auction Remaining Time" class="w-full h-full">
                    </span>
                    <span class="text-sm font-bold text-grayscale-500">Waktu Tersisa</span>
                </div>
                <div class="flex justify-between">
                    <div class="flex flex-col items-center justify-center mr-5">
                        <span class="text-xl font-bold text-grayscale-600">1</span>
                        <span class="text-sm font-light text-grayscale-400">Day</span>
                    </div>
                    <div class="mr-5">
                        <span class="text-xl font-bold">:</span>
                    </div>
                    <div class="flex flex-col items-center justify-center mr-5">
                        <span class="text-xl font-bold text-grayscale-600">10</span>
                        <span class="text-sm font-light text-grayscale-400">Hours</span>
                    </div>
                    <div class="mr-5">
                        <span class="text-xl font-bold">:</span>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-xl font-bold text-grayscale-600">34</span>
                        <span class="text-sm font-light text-grayscale-400">Minute</span>
                    </div>
                </div>
            </div>
            <div>
                <h6 class="text-sm font-light text-grayscale-400">Harga terakhir</h6>
                <h3 class="text-lg font-bold text-primary-500">Rp 350.000</h3>
            </div>
        </div>

    </div>
    <div id="auction-item-bid-information" class="p-6 rounded-2xl bg-white flex sm:flex-row flex-col justify-between sm:max-w-screen-xl w-full z-10 relative">
        <div class="rounded-xl outline outline-primary-200 p-6 flex justify-center items-center flex-col flex-grow mr-6 outline-1">
            <h3 class="text-base font-light text-grayscale-500">Penawaran Awal</h3>
            <h2 class="text-xl font-bold text-primary-500">Rp. 100.000</h2>
        </div>
        <div class="rounded-xl outline outline-primary-200 p-6 flex justify-center items-center flex-col flex-grow mr-6 outline-1">
            <h3 class="text-base font-light text-grayscale-500 mb-2">Penawaran Terakhir</h3>
            <h2 class="text-xl font-bold text-primary-500">Rp. 350.000</h2>
            <h2 class="text-sm font-normal text-grayscale-400">oleh Rizaldy Wirawan</h2>
        </div>
        <div class="rounded-xl outline outline-primary-200 p-6 flex justify-center items-center flex-col flex-grow outline-1">
            <h3 class="text-base font-light text-grayscale-500">Kelipatan Penawaran</h3>
            <h2 class="text-xl font-bold text-primary-500">Rp. 100.000</h2>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/pages/auction-items/show.js') }}" defer></script>
@endpush
