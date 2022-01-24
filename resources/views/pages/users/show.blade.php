@extends('layouts.master')

@section('title', 'Users')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@push('topbar')
<div class="">
    <div class="text-danger font-bold inline-block">Users</div>
    <span class="text-sm font-normal text-neutral-500 ml-4">Users / <span class="text-sm font-normal text-neutral-500 underline">Detail Users</span>
</div>
<button class="btn btn-danger flex items-center" id="create-auction">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
    </svg>
    <span>Export</span>
</button>

@endpush

@section('content')
    <div class="flex flex-col space-y-5 md:space-y-0 md:flex-row md:space-x-5">
        <div class="flex flex-col space-y-5 md:space-y-5 md:w-2/5">
            <div class="bg-white rounded-md flex flex-col justify-center items-center w-full py-6">
                <div class="">
                    <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1143&q=80" alt="" class="align-middle rounded-full border h-32 w-32">
                </div>
                <h1 class="text-2xl font-bold mt-3">{{$user->profile->name}}</h1>
                <span class="text-base font-normal text-neutral-500">{{$user->profile->job_title}}</span>
            </div>
            <div class="bg-white rounded-md w-full p-6">
                <div>
                    <h5 class="text-sm font-light text-neutral-400">Email</h5>
                    <h5 class="text-base font-bold text-neutral-500">{{$user->profile->email}}</h5>
                </div>
                <div class="mt-3">
                    <h5 class="text-sm font-light text-neutral-400">Phone Number</h5>
                    <h5 class="text-base font-bold text-neutral-500">{{$user->profile->phone}}</h5>
                </div>

                <div class="mt-3">
                    <h5 class="text-sm font-light text-neutral-400">Institute</h5>
                    <h5 class="text-base font-bold text-neutral-500">{{$user->profile->company}}</h5>
                </div>
            </div>
        </div>

        <div class="flex flex-col space-y-5 md:w-3/5">
            <div class="bg-white rounded-md w-full p-6">
                <h5 class="text-sm font-bold text-neutral-600">Historical Attendance</h5>
                <hr class="mt-3">
                <div class="mt-2.5 flex flex-row">
                    @if ($user->attendances)
                        <div class="flex justify-center items-center md:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block stroke-current text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="ml-2.5">
                            <span class="text-base font-normal inline-block md:inline">Nolan curtis has been <span class="text-danger font-bold">attend</span> by QR Code </span>
                            <span class="text-xs font-light text-neutral-400">01 Jan 2022, 09:45</span>
                        </div>
                    @endif


                </div>
            </div>

            <div class="bg-white rounded-md w-full p-6">
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

        </div>

    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js" defer></script>
<script src="{{asset('js/pages/users/index.js')}}" defer></script>

@endpush

