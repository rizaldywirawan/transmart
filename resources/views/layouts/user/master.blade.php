<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    @stack('styles')
</head>
<body class="bg-background mobile-phone-screen m-auto sm:w-3/4 sm:max-w-screen-xl px-6 sm:px-0 pt-72 pb-6">
    @include('layouts.user.header')

    <div id="backdrop" style="background: linear-gradient(90deg, #FFECA7 0%, #E60013 50.52%, #80000B 100%);" class="h-52 w-screen absolute top-20 left-0 right-0 overflow-hidden">
        <div class="absolute w-64 h-64 bg-secondary-400 opacity-20 rounded-full backdrop__circle--top"></div>
        <div class="absolute w-64 h-64 bg-secondary-400 opacity-20 rounded-full top-1/2 backdrop__circle--bottom"></div>
    </div>

    @yield('content')

    @stack('scripts')
</body>
</html>
