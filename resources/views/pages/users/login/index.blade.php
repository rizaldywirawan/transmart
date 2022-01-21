@extends('layouts.guest.master')

@section('title', 'VIP User Login')

@section('content')

    {{-- card --}}
    <div id="authentication-form" class="p-8 max-w-xs sm:max-w-screen-sm rounded-2xl bg-white flex flex-col justify-center items-center">
        <img id="authentication-form__icon" src="{{ asset('images/icons/icon-loading.png') }}" alt="Autentikasi berhasil dilakukan!" class="w-24 mb-3 animate-spin">
        <div id="authentication-form__status" class="text-xl font-normal text-neutral-400 text-center">Menunggu inisiasi autentikasi ...</div>
        <button id="authentication-form__button" class="bg-primary-500 rounded-lg py-3 font-bold text-white w-full text-base hidden mt-6">Masuk Sistem (5)</button>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('js/pages/users/login/index.js') }}" defer></script>
@endpush
