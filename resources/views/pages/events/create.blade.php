@extends('layouts.master')

@section('title', 'Event')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


@endpush

@push('topbar')
<div class="text-danger font-bold">Event</div>

@endpush

@section('content')
    <div class="bg-white p-6 rounded-md">
        <form id="form-event" class="space-y-5">
            <div class="flex flex-col">
                <label for="name" class="text-sm tracking-wider font-bold">Event Name<span class="text-red-600 text-sm">*</span></label>
                <input type="text" class="input-text" id="name" placeholder="Masukan Nama" name="name" autocomplete="off">
            </div>
            <div class="flex flex-col md:flex-row space-x-0 space-y-5 md:space-y-0 md:space-x-4">
                <div class="flex flex-col w-full">
                    <label for="" class="text-sm tracking-wider font-bold">Start Date<span class="text-red-600 text-sm">*</span></label>
                    <input type="text" class="input-text focus:ouline-none focus:border-sky-500" placeholder="01 Jan 2022" name="start-date" id="start-date" autocomplete="off">
                </div>
                <div class="flex flex-col w-full">
                    <label for="" class="text-sm tracking-wider font-bold">End Date<span class="text-red-600 text-sm">*</span></label>
                    <input type="text" class="input-text focus:ouline-none focus:border-sky-500" placeholder="30 Jan 2022" name="end-date" id="end-date" autocomplete="off">
                </div>
            </div>
            <div class="flex flex-col md:flex-row space-x-0 space-y-5 md:space-y-0 md:space-x-4">
                <div class="flex flex-col w-full md:w-1/2">
                    <label for="event-category" class="text-sm tracking-wider font-bold">Event Category<span class="text-red-600 text-sm">*</span></label>
                    <select type="text" class="input-text" placeholder="Select Event Format" id="event-category" name="event-category">
                        <option selected="true" disabled="disabled">Choose Event Category</option>
                        @foreach ($eventCategories as $key => $eventCategory)
                            <option value="{{ $eventCategory['id'] }}"> {{ $eventCategory['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col w-full md:w-1/2">
                    <label for="" class="text-sm tracking-wider font-bold">Event Type<span class="text-red-600 text-sm">*</span></label>
                    <select type="text" class="input-text focus:ouline-none focus:border-sky-500" placeholder="Select Event Type" name="event-type" id="event-type">
                        <option selected="true" disabled="disabled">Choose Event Type</option>
                        @foreach ($eventTypes as $key => $eventType)
                            <option value="{{ $eventType['id'] }}"> {{ $eventType['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex flex-col">
                <label for="event-link" class="text-sm tracking-wider font-bold">Online Event Link<span class="text-red-600 text-sm">*</span></label>
                <input type="text" class="appeareance-none block w-full border border-neutral-300 leading-tight rounded-lg h-12 p-4 mt-2 text-sm" id="event-link" placeholder="https://www.zoom.com" name="event-link" autocomplete="off">
            </div>
            <div class="flex flex-col">
                <label for="description" class="text-sm tracking-wider font-bold">Event Description<span class="text-red-600 text-sm">*</span></label>
                <textarea type="text" rows="4" class="textarea" id="description" placeholder="Type something here" name="description" autocomplete="off"></textarea>
            </div>

            <div class="flex flex-col">
                <label for="" class="text-sm tracking-wider font-bold">Photos<span class="text-red-600 text-sm">*</span></label>
                <div class="mt-2.5">
                    <div class="w-full mx-auto">
                        <div class="flex flex-col items-center border-2 border-dashed border-gray-400 rounded 400 py-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 fill-current text-danger" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>

                            <p class="text-sm font-light text-neutral-400">Drag and drop</p>
                            <p class="text-sm font-light text-neutral-400">image here</p>
                            <label for="file-auction" class="btn-file btn-danger mt-1">Browse</label>
                            <input type="file" name="file" multiple class="sr-only hidden" id="file-auction">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center mt-5">
                <button class="btn-secondary-submit" type="button" id="reset">Reset</button>
                <button class="btn-danger-submit" type="submit" id="save-event">Save</button>
            </div>
        </form>

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
<script src="{{asset('js/pages/events/create.js')}}" defer></script>

@endpush

