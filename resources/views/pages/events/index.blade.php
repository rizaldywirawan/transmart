@extends('layouts.master')

@section('title', 'Event')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endpush

@push('topbar')
<div class="text-danger font-bold">Event</div>
<a href="{{route('event.create')}}" class="btn btn-danger flex items-center" id="create-event">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-current text-red-600 bg-white rounded-full" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
    <span>Create</span>
</a>

@endpush

@section('content')

    {{-- Table Event --}}
    <div class="bg-white p-6 rounded-lg mt-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h1 class="text-base font-bold">Event List</h1>
            </div>
            <div class="mt-6 md:mt-0">
                <form>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 stroke-red-400 absolute" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                        type="text"
                        class="py-3 pr-4 pl-10 border rounded-lg shadow-sm transition duration-300 w-full placeholder-neutral-300 text-sm font-normal"
                        placeholder="Search here..."
                        name="search"
                        autocomplete="off">
                    </div>
                </form>
            </div>
        </div>
        {{-- Body table Event --}}

        <div>

            <table id="event-table" class="w-full">
                <thead class="divide-y">
                    <tr>
                        <th>
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Name
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Description
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Online Url
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>




@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>
<script src="{{asset('js/pages/events/index.js')}}" defer></script>

@endpush

