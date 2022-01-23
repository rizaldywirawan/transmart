@extends('layouts.guest.master')

@section('title', 'Login dengan QR Code')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <img src="{{ asset('images/logos/transretail-logo-landscape.png') }}" alt="Trans Retail Logo" class="h-8 mb-10">
        <div class="flex flex-col justify-center items-center">
            <div class="bg-white p-4 rounded-2xl">
                {!! QrCode::size(200)->generate($url); !!}
            </div>
            <span class="text-center mt-10 p-4 rounded-2xl bg-white">Retail Cluster Annual Business Meeting 2022</span>
            <span class="block mt-6 text-center">Scan QR Code untuk masuk ke sistem secara otomatis</span>
        </div>
    </div>
{{-- <div class="flex flex-col justify-center items-center">
        <img src="{{ asset('images/logos/transretail-logo-landscape.png') }}" alt="Trans Retail Logo" class="h-8 mb-10">
        <div class="flex flex-col justify-center items-center">
            <div class="bg-white p-4 rounded-2xl">
                {!! QrCode::size(200)->generate($url); !!}
            </div>
            <div class="flex items-center mt-10 bg-white rounded-2xl p-4">
                <img src="{{ asset('images/logos/transcorp-logo-icon.png') }}" alt="Trans Retail Logo" class="h-10 w-10 object-contain mr-4 rounded-full">
                <span>{{ $user->profile->name }}</span>
            </div>
            <span class="block mt-6 text-center">Scan QR Code untuk masuk ke sistem secara otomatis</span>
        </div>
    </div> --}}
@endsection
