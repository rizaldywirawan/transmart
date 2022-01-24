@extends('layouts.master')

@section('title', 'Auction')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@push('topbar')
<div class="text-danger font-bold">Attendance</div>

@endpush

@section('content')
    <div class="flex justify-between items-center">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6">
            <div class="h-24 w-48 bg-primary-100 p-4 border rounded-lg">

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block -mt-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    <span id="attendance-total" class="font-bold text-3xl inline-block">{{ $attendanceToday }}/{{ $totalUser }}</span>
            </div>

                <span class="text-base font-normal">Total Kehadiran</span>
            </div>
            <div class="h-24 w-48 bg-secondary-100 p-4 border rounded-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block -mt-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                    </svg>
                    <span id="attendance-online" class="font-bold text-3xl">{{ $attendanceByWebsite }}</span>
                </div>
                <span class="text-base font-normal">Secara Online</span>
            </div>
            <div class="h-24 w-48 bg-secondary-100 p-4 border rounded-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block -mt-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd" />
                        <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                    </svg>
                    <span id="attendance-offline" class="font-bold text-3xl">{{ $attendanceByQRCode }}</span>
                </div>
                <span class="text-base font-normal">Datang Langsung</span>
            </div>
            {{-- <div class="h-24 w-56 bg-success-100 p-4 border rounded-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block -mt-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-3xl">6</span>
                </div>

                <span class="text-base font-normal">Total money collected</span>
            </div> --}}
        </div>

        <button id="toggle_fullscreen" class="p-4 bg-primary-600 text-white rounded-xl">Full Screen</button>
    </div>

    {{-- Table Historical --}}
    <div class="flex flex-col sm:flex-row">
        <div class="bg-white p-6 rounded-lg mt-6 w-full sm:w-4/4 sm:mr-6 mr-0 shrink-0">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div>
                    <h1 class="text-base font-bold">Daftar Kehadiran</h1>
                    <span class="text-neutral-500 text-sm font-normal">{{ now()->isoFormat('ddd, DD MMMM YYYY') }}</span>
                </div>
                {{-- <div class="mt-6 md:mt-0">
                    <form>
                        <div class="relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute right-1 mr-3 stroke-current text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <input
                            type="text"
                            class="py-3 pr-4 pl-4 border rounded-lg shadow-sm transition duration-300 w-full placeholder-neutral-300 text-sm font-normal"
                            placeholder="12 Jan 2022"
                            name="search"
                            autocomplete="off">
                        </div>
                    </form>
                </div> --}}
            </div>
            {{-- Body table Auction --}}

            <div id="attendance-container" class="border-2 border-dashed border-gray-200 rounded-lg w-full mt-6 p-4">

                @if (count($attendances))
                    @foreach ($attendances as $key => $attendance)

                        @php
                            $margin = $key != count($attendances) - 1 ? "mb-3" : "mb-0"
                        @endphp


                        <div class="attendance-entry {{ $margin }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block stroke-current text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="text-base font-normal">{{ $attendance->user->profile->name }} <span class="text-danger font-bold">attend</span> by {{ $attendance->locationType->name }} <span class="text-xs font-light text-neutral-400">{{ $attendance->formatted_created_at }}</span></span>
                        </div>
                    @endforeach
                @else
                    <div id="attendance-empty-state" class="attendance-entry">
                        <span class="text-base font-normal">Belum ada partisipan yang hadir.</span></span>
                    </div>
                @endif


            </div>
        </div>
        {{-- <div class="bg-white p-6 rounded-lg mt-6 w-full sm:w-1/4">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div>
                    <h1 class="text-base font-bold">Unit Bisnis</h1>
                </div>
            </div>
            <div id="business-unit-container">
                @foreach ($businessUnits as $businessUnit)
                    <div class="border-2 border-dashed border-gray-200 rounded-lg w-full mt-6 p-4">
                        <span id="business-unit-company-name" class="text-base font-normal">{{ $businessUnit->company->name }}</span>
                        <span id="business-unit-name" class="text-base font-normal">{{ $attendance->user->profile->name }} <span class="text-danger font-bold">attend</span> by {{ $attendance->locationType->name }} <span class="text-xs font-light text-neutral-400">{{ $attendance->formatted_created_at }}</span></span>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script> --}}
{{-- <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js" defer></script> --}}
<script src="{{asset('js/pages/attendances/index.js')}}" defer></script>

@endpush

