@extends('layouts.master')

@section('title', 'Dashboard')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@push('topbar')
<div class="text-danger font-bold">Dashboard</div>

@endpush

@php
    use Carbon\Carbon;

@endphp

@section('content')
    @foreach ($events as $event)
        @php
            $startDate = $event['started_at'];
            $startDate = Carbon::parse($startDate)->isoFormat('DD MMMM YYYY, HH:mm');
            $endDate = $event['ended_at'];
            $endDate = Carbon::parse($startDate)->isoFormat('DD MMMM YYYY, HH:mm');
        @endphp
        <div class="w-full p-6 bg-white rounded-lg">
            <h1 class="text-danger">TRANSMART</h1>
            <h1 class="text-neutral-600 text-4xl font-bold mt-6">{{$event['name']}}</h1>
            <div class="mt-3">
                <span class="text-base font-normal text-neutral-400 mr-6">Category: <span class="text-base font-normal text-neutral-500 ">{{$event['eventCategory']['name']}}</span></span>
                <span class="text-base font-normal text-neutral-400">Type: <span class="text-base font-normal text-neutral-500">{{$event['eventFormat']['name']}}</span></span>
            </div>
            <div class="items-center flex mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current text-danger inline-block mr-1 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-base font-normal text-neutral-600 ">{{$startDate}} - {{$endDate}}</span>
            </div>
            <hr class="mt-3">
            {{-- <p class="mt-3 text-sm font-normal">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed iusto magnam corporis cum. Labore nesciunt ratione porro. Quod dolore amet cumque obcaecati sequi eum adipisci ducimus? Itaque ipsam nihil enim!</p> --}}
        </div>
    @endforeach


    <div class="w-full py-3 px-3 justify-between items-center flex flex-col md:flex-row bg-white rounded-lg mt-5">
        <h5>You can join event this event</h5>
        <div class="space-x-2 mt-2.5 md:mt-0">
            <button class="btn-primary-400">Join us Online</button>
            <button class="btn-primary-600">Go to Website</button>
        </div>
    </div>

    <div class="flex flex-col md:flex-row mt-5 space-x-0 md:space-x-2 md:space-y-0 space-y-5">
        <div class="bg-white rounded-lg p-6 md:w-7/12">
            <div>
                <h1 class="text-base font-bold">Historical Attendance</h1>
                <span class="text-neutral-500 text-sm font-normal">Total Attend 12 Jan 2022, 105 Attend</span>
            </div>

            <div class="border-2 border-dashed border-gray-200 rounded-lg w-full mt-6 p-4 ">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block stroke-current text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-base font-normal">Nolan curtis has been <span class="text-danger font-bold">attend</span> by QR Code <span class="text-xs font-light text-neutral-400">01 Jan 2022, 09:45</span></span>
                </div>

            </div>
        </div>

        <div class="bg-white rounded-lg p-6 w-full md:w-5/12">
            <h1 class="text-base font-bold text-neutral-600">Auctions</h1>
            <hr class="mt-3 border-dashed">
            <div class="flex justify-between items-center mt-3">
                <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=464&q=80" alt="" class="rounded-md h-10 w-10 align-center">
                <label class="px-4 py-1 bg-primary-100 rounded-md text-danger">Live</label>
            </div>
            <div class="mt-3">
                <span class="text-sm font-normal text-neutral-400 mr-2 inline-block md:inline">Start Bid: <span class="text-sm font-normal text-neutral-500">Rp 100.000</span></span>
                <span class="text-sm font-normal text-neutral-400 inline-block md:inline">last Bid: <span class="text-sm font-normal text-neutral-500">Rp 350.000</span></span>
            </div>
            <h5 class="text-base font-normal text-neutral-500 mt-3">01 Jan 2022, 13:00 - 01 Jan 2022, 15:00</h5>
            <hr class="mt-3 border-dashed">
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js" defer></script>
<script src="{{asset('js/pages/dashboard/index.js')}}" defer></script>

@endpush

