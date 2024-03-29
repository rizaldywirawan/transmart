@extends('layouts.user.master')

@section('title', 'Beranda')

@section('content')

    <div class="p-6 rounded-2xl bg-white -mt-24 sm:-mt-20 mb-6 sm:max-w-screen-xl w-full z-10 relative flex flex-col items-center">
        <img src="{{ asset('images/icons/prokes.svg') }}" alt="Prokes" class="w-full w-48 mb-10">
        <p class="text-center text-md sm:text-lg font-normal text-grayscale-500 mb-6">
            Kami ingin mengingatkan untuk selalu mengikut protokol kesehatan.
            <br>
            <br>
            Anda sudah terdaftar untuk berpartisipasi di dalam kegiatan lelang yang akan dipandu oleh panitia.
        </p>
        <h1 class="text-xl sm:text-2xl font-bold text-primary-800 mb-6 text-center">Selamat Mengikuti Rangkaian Acara</h1>

        <a href="https://us06web.zoom.us/j/89115860786?pwd=ZFJZa0xlNUMyVXowTzJOQVVkQlEwZz09" class="p-4 flex items-center mb-4">
            <img src="https://explore.zoom.us/media/desktop-logo-zoombrand.png" alt="Gabung dari Zoom" class="h-10 mr-3">
            <span>Gabung dari Zoom</span>
        </a>

        @if (!$disabledButton)
            <a href="/auction-items" class="text-md sm:text-lg font-bold bg-primary-600 text-white rounded-xl px-10 sm:px-16 py-4">Halaman Lelang</a>
        @endif

    </div>

@endsection
