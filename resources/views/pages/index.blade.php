@extends('layouts.guest.master')

@section('title', 'Masuk Sistem')

@section('content')
<div class="">
    <img src="{{ asset('images/logos/transmart-logo-landscape.jpeg') }}" alt="Transmart Logo" class="h-7 mb-8">
    <h1 class="text-lg font-normal text-grayscale-500"><span class="text-xl font-bold text-primary-500">Hello,</span> Selamat Datang</h1>
    <h3 class="text-sm font-light text-grayscale-500 mb-8">Masuk ke sistem untuk mengikuti lelang bersama kami.</h3>
    <label for="code" class="text-sm font-bold text-grayscale-600 mb-1 block">Code</label>
    <input type="text" name="code" id="code"
    class="px-4 py-3 text-sm font-normal rounded-lg w-full border border-grayscale-300 mb-7"
    placeholder="Masukkan kode Anda.">
    <button id="login-button" style="background: linear-gradient(90deg, #FF737E 0%, #E60013 50.52%, #80000B 100%);" class="rounded-lg py-3 text-base font-bold text-white w-full">Masuk Sistem</button>
</div>
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/pages/index.js') }}" defer></script>
@endpush