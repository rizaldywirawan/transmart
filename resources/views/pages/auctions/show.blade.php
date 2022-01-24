@extends('layouts.master')

@section('title', 'Detail Auction')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@push('topbar')
<div class="flex flex-col md:flex-row md:justify-between md:items-center w-full">
    <div class="mb-2 md:mb-0">
        <div class="text-danger font-bold inline-block">Auctions</div>
        <a href="{{route('auction.index')}}" class="text-sm font-normal text-neutral-500 ml-4">Auctions</a>
        <span class="text-sm font-normal text-neutral-500">/</span>
        <span class="text-sm font-normal text-neutral-500 underline">Detail Auctions</span>
    </div>
    <div class="flex justify-items-center items-center space-x-2">
        <button class="bg-danger rounded-md py-2 px-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg></button>
        <button class="bg-danger rounded-md py-2 px-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg></button>
        <button class="btn-primary-600 flex items-center" id="live-now">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current text-white mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
            </svg>
            <span>Live Now</span>
        </button>
    </div>
</div>



@endpush

@section('content')
<div class="bg-white rounded flex flex-col md:flex-row p-6 space-x-0 md:space-x-5">
    <div class="space-y-3 p-4 md:p-0">
        <div class="">
            <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1087&q=80" alt="" class="w-60 h-60 rounded-md">
        </div>
        <div class="flex space-x-2">
            <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1087&q=80" alt="" class="w-16 h-16 rounded-md">
            <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1087&q=80" alt="" class="w-16 h-16 rounded-md">
            <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1087&q=80" alt="" class="w-16 h-16 rounded-md">
        </div>
    </div>
    <div class="mt-4 md:mt-0">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-neutral-600 inline-block">Kursi putih by IKEA</h1>
            <span class="p-2 rounded-md bg-primary-700 text-primary-700 ml-3">Incoming</span>
        </div>
        <div>
            <h5 class="text-base font-light text-neutral-400">Desc :</h5>
            <h5 class="text-lg font-normal text-neutral-500 mt-1">Koleksi rare item kursi dari IKEA pada tahun 2020</h5>
        </div>
        <div class="mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 stroke-current text-danger inline-block -mt-1 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="test-xs md:text-base font-light text-neutral-500">01 Jan 2022, 13:00 - 01 Jan 2022, 15:00</span>
        </div>
        <div class="rounded-md border shadow-sm p-3 max-w-57 mt-3">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current text-danger inline-block -mt-1 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h4 class="text-sm font-bold text-neutral-500 inline-block">Time Remaining</h4>
                <div class="flex justify-around text-xl font-bold text-neutral-600 mt-1">
                    <span>1</span>
                    <span>:</span>
                    <span>10</span>
                    <span>:</span>
                    <span>34</span>
                </div>
                <div class="flex justify-between text-sm font-light text-neutral-400 mt-1">
                    <span>Day</span>
                    <span>Hours</span>
                    <span>Minute</span>
                </div>
            </div>
            <div></div>

        </div>
    </div>
</div>

<div class="bg-white rounded-md w-full p-6 md:flex md:justify-between space-y-6 md:space-y-0 md:space-x-6 md:mt-6">
    <div class="border-1 border-solid border-dashed border-primary-500  rounded-md flex flex-col justify-center items-center w-full md:w-1/3 border py-6">
        <h5 class="text-base font-light text-neutral-500">Starting Bid</h5>
        <h5 class="text-xl font-bold text-danger">Rp 100.0000</h5>
    </div>
    <div class="border-1 border-solid border-dashed border-primary-500  rounded-md flex flex-col justify-center items-center w-full md:w-1/3 border py-6">
        <h5 class="text-base font-light text-neutral-500">Bid Increment</h5>
        <h5 class="text-xl font-bold text-danger">Rp 100.0000</h5>
    </div>
    <div class="border-1 border-solid border-dashed border-primary-500  rounded-md flex flex-col justify-center items-center w-full md:w-1/3 border py-6">
        <h5 class="text-base font-light text-neutral-500">last Bid</h5>
        <h5 class="text-xl font-bold text-danger">Rp 100.0000</h5>
        <h5 class="text-base font-light text-neutral-400">by anazola Siregar</h5>
    </div>
</div>

<div class="bg-white rounded-md w-full p-6 mt-6">
    <h5 class="text-sm font-bold text-neutral-600">Historical Bid</h5>
    <hr class="mt-3">
    <div class="mt-2.5 flex flex-row border rounded-lg shadow-sm p-3">
        <div class="flex justify-center items-center md:block ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block stroke-current text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div class="ml-2.5">
            <span class="text-base font-normal inline-block md:inline">Ahri Laisa has been <span class="text-danger font-bold">Rp. 350.000</span> on Kursi putih by IKEA </span>
        </div>

    </div>
</div>

{{-- modal live this auction--}}
<div class="bg-black/25 absolute inset-0 flex justify-items-center items-center grid hidden" id="modal-live_auction">
    <div class="bg-white border rounded-lg p-6 shadow-xl max-w-md lg:max-w-40">
        {{-- Body --}}
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 stroke-current text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-lg font-normal text-neutral-500">Are You want to Live this auction?</h1>
        <div class="flex justify-between items-center mt-3">
            <button class="text-base font-bold text-primary-500" id="later-live">Maybe Later</button>
            <button class="btn-primary-600">Go Live Now</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js" defer></script>
<script src="{{asset('js/pages/auctions/show.js')}}" defer></script>

@endpush

