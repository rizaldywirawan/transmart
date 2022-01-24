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
<div class="text-danger font-bold">Users</div>
<button class="btn btn-danger flex items-center" id="create-user">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-current text-red-600 bg-white rounded-full" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
    <span>Create</span>
</button>
@endpush

@section('content')
    {{-- Table Auction --}}
    <div class="bg-white p-6 rounded-lg">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h1 class="text-base font-bold">Users List</h1>
                <h5 class="text-sm font-normal text-neutral-500">Total Users {{$userCount}} </h5>
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
            <table id="user-table">
                <thead class="divide-y">
                    <tr>
                        <th>
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Name
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Contact
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Company
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                           Job Title
                        </th>
                        <th class="text-neutral-400 text-sm font-bold py-2">
                            Code
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

     {{-- MODAL CREATE User --}}
     <div class="bg-black/25 absolute inset-0 flex justify-items-end grid items-center hidden" id="modal-create_user">
        <div class="bg-white border rounded-lg p-6 shadow-xl max-w-xl h-full">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-md">Create user</h1>
                <button class="bg-red-200" id="close-modal-create_user">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-2.5">
            {{-- Body --}}
            <form id="user-form" >
                @csrf
                <div class="flex flex-col mt-4">
                    <label for="username" class="text-sm tracking-wider font-bold">Username<span class="text-red-600 text-sm">*</span></label>
                    <input type="text" class="input-text" placeholder="Masukan Nama" id="username" name="username" autocomplete="off">
                </div>
                <div class="flex flex-col mt-4">
                    <label for="password" class="text-sm tracking-wider font-bold">Password<span class="text-red-600 text-sm">*</span></label>
                    <input type="password" class="input-text" placeholder="Masukan password" id="password" name="password" autocomplete="off">
                </div>
                <div class="flex flex-col mt-4">
                    <label for="password_confirmation" class="text-sm tracking-wider font-bold">Confirm Password<span class="text-red-600 text-sm">*</span></label>
                    <input type="password" class="input-text" placeholder="Masukan password" id="password_confirmation" name="password_confirmation" autocomplete="off">
                </div>
                <hr class="mb-4 mt-4">
                <div class="flex flex-col mt-4">
                    <label for="" class="text-sm tracking-wider font-bold">Participant<span class="text-red-600 text-sm">*</span></label>
                    <select class="input-text" id="participant" name="participant">
                        <option selected="true" disabled="disabled">Choose Participant</option>
                    </select>
                </div>
                <div class="flex flex-col mt-4">
                    <label for="" class="text-sm tracking-wider font-bold">Committe<span class="text-red-600 text-sm">*</span></label>
                    <select class="input-text" id="committe" name="committe">
                        <option selected="true" disabled="disabled">Choose Committe</option>
                    </select>
                </div>

                <div class="flex flex-row justify-between items-center mt-5">
                    <button class="btn btn-secondary md:btn-secondary-submit" type="button" id="reset">Reset</button>
                    <button class="btn btn-danger md:btn-danger-submit" type="submit" id="save-user">Save</button>
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
<script src="{{asset('js/pages/users/index.js')}}" defer></script>

@endpush

