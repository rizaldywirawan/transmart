@extends('layouts.master')

@section('title', 'Auction')
@section('top-bar-title', 'Auctions')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('topbar')
<div class="text-danger font-bold">@yield('top-bar-title')</div>
<button class="btn btn-danger flex items-center create-auction">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-current text-red-600 bg-white rounded-full" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
    <span>Create</span>
</button>
@endpush

@section('content')

    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6">
        <div class="h-24 w-40 bg-primary-100 p-4 border rounded-lg">
            <h1 class="font-bold text-3xl">{{$totalAuction}}</h1>
            <span class="text-base font-normal">Total Auctions</span>
        </div>
        <div class="h-24 w-40 bg-secondary-100 p-4 border rounded-lg">
            <h1 class="font-bold text-3xl">{{$auctionDone}}</h1>
            <span class="text-base font-normal">Auctions Done</span>
        </div>
        <div class="h-24 w-48 bg-secondary-100 p-4 border rounded-lg">
            <h1 class="font-bold text-3xl">{{$auctionIncoming}}</h1>
            <span class="text-base font-normal">Auctions Incoming</span>
        </div>
    </div>

    {{-- Table Auction --}}
    <div class="bg-white p-6 rounded-lg mt-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h1 class="text-base font-bold">Auctions List</h1>
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
        {{-- Body table Auction --}}

        <div>

            <table id="auction-table">
                <thead class="divide-y">
                    <tr>
                        <th>
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Name
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Time
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Start Bid
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Last Bid
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Live on
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Status
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

    {{-- MODAL CREATE AUCTION --}}
    <div class="bg-black/25 absolute inset-0 flex justify-items-end grid hidden" id="modal-create_auction">
        <div class="bg-white border rounded-lg p-6 shadow-xl max-w-80-percent lg:max-w-40">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-md">Create Auction</h1>
                <button class="bg-red-200" id="close-modal-create_auction">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            {{-- Body --}}
            <form id="auction-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="flex flex-col mt-4">
                    <label for="" class="text-sm tracking-wider font-bold">Event<span class="text-red-600 text-sm">*</span></label>
                    <select class="input-text" id="event-id" name="event-id">
                        <option selected="true" disabled="disabled">Choose Event Category</option>
                        @foreach ($events as $key => $event)
                            <option value="{{ $event['id'] }}"> {{ $event['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col mt-4">
                    <label for="" class="text-sm tracking-wider font-bold">Nama<span class="text-red-600 text-sm">*</span></label>
                    <input type="text" class="input-text" placeholder="Masukan Nama" id="name" name="name" autocomplete="off">
                </div>

                <div class="flex flex-row space-x-4">
                    <div class="flex flex-col mt-5">
                        <label for="" class="text-sm tracking-wider font-bold">Start Date<span class="text-red-600 text-sm">*</span></label>
                        <input type="text" class="input-text" placeholder="01 January 2022" id="start-date" name="start-date" autocomplete="off">
                    </div>
                    <div class="flex flex-col mt-5">
                        <label for="" class="text-sm tracking-wider font-bold">End Date<span class="text-red-600 text-sm">*</span></label>
                        <input type="text" class="input-text" placeholder="10 January 2023" id="end-date" name="end-date" autocomplete="off">
                    </div>
                </div>

                <div class="flex flex-row space-x-4">
                    <div class="flex flex-col mt-5">
                        <label for="" class="text-sm tracking-wider font-bold">Starting Bid<span class="text-red-600 text-sm">*</span></label>
                        <input type="text" class="input-text" placeholder="Rp. 999.999.999" id="starting-bid" name="starting-bid" autocomplete="off" >
                    </div>
                    <div class="flex flex-col mt-5">
                        <label for="" class="text-sm tracking-wider font-bold">Bid Increment<span class="text-red-600 text-sm">*</span></label>
                        <input type="text" class="input-text" placeholder="Rp. 999.999.999" id="bid-increment" name="bid-increment" autocomplete="off">
                    </div>
                </div>

                <div class="flex flex-col mt-5">
                    <label for="" class="text-sm tracking-wider font-bold">Item Description<span class="text-red-600 text-sm">*</span></label>
                    <textarea type="text" class="textarea" rows="4" placeholder="Type somethin here" id="description" name="description" autocomplete="off"></textarea>
                </div>

                <div class="flex flex-col mt-5">
                    <label for="" class="text-sm tracking-wider font-bold">Item Photos<span class="text-red-600 text-sm">*</span></label>
                    <div class="mt-2.5">
                        <div class="w-full mx-auto">
                            <div class="flex flex-col items-center border-2 border-dashed border-gray-400 rounded 400 py-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 fill-current text-danger" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>

                                <p class="text-sm font-light text-neutral-400">Drag and drop</p>
                                <p class="text-sm font-light text-neutral-400">image here</p>
                                <label for="file-auction" class="btn-file btn-danger mt-1">Browse</label>
                                <input type="file" name="files[]" multiple class="sr-only hidden" id="file-auction">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex flex-row justify-between items-center mt-5">
                    <button class="btn btn-secondary md:btn-secondary-submit" type="button" id="reset">Reset</button>
                    <button class="btn btn-danger md:btn-danger-submit" type="submit" id="save-auction">Save</button>
                </div>
            </form>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('js/pages/auctions/index.js')}}" defer></script>

@endpush

