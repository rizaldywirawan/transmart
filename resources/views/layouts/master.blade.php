<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body class="bg-secondary">

    <div class="relative min-h-screen flex">

        {{-- Sidebar Web --}}
        <div class="bg-white text-gray-300 w-52 hidden md:block relative">
            {{-- Logo --}}
            <div class="flex items-center justify-center mt-6">
                <img src="{{ asset('images/logos/transretail-logo-landscape.png') }}" alt="Trans Retail Logo" class="w-full px-6">
            </div>

            {{-- nav --}}
            <nav class="px-6 font-bold text-sm mt-16 space-y-6">
                <a href="{{route('dashboard.index')}}" class="block py-2 5 px-4 text-neutral-400" id="menu-dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-1 fill-current " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                    </svg>
                    <span class="text-sm font-bold " >DASHBOARD</span>
                </a>
                <a href="{{route('attendance.index')}}" class="block py-2 5 px-4 text-neutral-400" id="menu-attendance">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-1 fill-current" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-bold">ATTENDANCE</span>
                </a>
                <a href="{{route('auction.index')}}" class="block py-2 5 px-4 text-neutral-400" id="menu-auctions">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-1 fill-current viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-bold ">AUCTIONS</span>
                </a>
                <a href="{{route('user.index')}}" class="block py-2 5 px-4 text-neutral-400" id="menu-users">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-1 fill-current " viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <span class="text-sm font-bold">USERS</span>
                </a>
                <a href="{{route('event.index')}}" class="block py-2 5 px-4 text-neutral-400"" id="menu-event">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-1 fill-current  viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h.01a1 1 0 010 2H7a1 1 0 01-1-1zm2 3a1 1 0 00-2 0v1a2 2 0 00-2 2v1a2 2 0 00-2 2v.683a3.7 3.7 0 011.055.485 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0A3.7 3.7 0 0118 12.683V12a2 2 0 00-2-2V9a2 2 0 00-2-2V6a1 1 0 10-2 0v1h-1V6a1 1 0 10-2 0v1H8V6zm10 8.868a3.704 3.704 0 01-4.055-.036 1.704 1.704 0 00-1.89 0 3.704 3.704 0 01-4.11 0 1.704 1.704 0 00-1.89 0A3.704 3.704 0 012 14.868V17a1 1 0 001 1h14a1 1 0 001-1v-2.132zM9 3a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm3 0a1 1 0 011-1h.01a1 1 0 110 2H13a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-bold">EVENT</span>
                </a>
            </nav>

            <div class="px-6 absolute bottom-2">
                <div>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1143&q=80" alt="" class="align-middle rounded-full border h-8 w-8 inline-block">
                        <span class="text-sm font-bold text-neutral-600 ml-2">Admin</span>
                    </div>
                </div>
                <div class="mt-2.5">
                    <form >
                        <button class="btn btn-danger flex items-center" id="create-auction" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 stock-current text-white " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Sign Out</span>
                        </button>
                    </form>

                </div>
            </div>

        </div>

        {{-- Right Side --}}
        <div class="flex-1">

            {{-- Topbar --}}
            <div class="w-full flex flex-row justify-between items-center px-6 py-4 bg-white">
                @stack('topbar')
            </div>

            {{-- content --}}
            <div id="container" class="p-6 bg-secondary">
                @yield('content')
            </div>

        </div>


    </div>

    @stack('scripts')

</body>
</html>
