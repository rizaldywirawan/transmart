<header class="fixed w-full h-20 bg-white left-0 right-0 top-0 navbar-box-shadow z-50 px-0 md:px-6 lg:px-0">
    <nav class="flex justify-between items-center sm:max-w-screen-xl py-4 px-6 sm:px-0 m-auto">
        <a href="/">
            <img src="{{ asset('images/logos/transretail-logo-landscape.png') }}" alt="Trans Retail Logo" class="h-5 sm:h-6">
        </a>
        <div id="profile" class="flex cursor-pointer relative">
            <div class="mr-2 text-right hidden sm:block">
                <h6 class="font-bold text-lg">{{ Auth::user()->profile->name }}</h6>
                <h6 class="font-normal text-sm">{{ Auth::user()->profile->job_title ?? 'Job title belum di definisikan' }}</h6>
            </div>
            <img src="{{ asset('images/logos/transcorp-logo-icon.png') }}" alt="Trans Retail Logo" class="h-10 w-10 sm:h-12 sm:w-12 object-contain bg-background rounded-full">
            <div id="profile-menu" class="featured-auction-item-box-shadow rounded-xl w-40 bg-white z-60 absolute top-full right-0 hidden">
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button class="text-base text-left w-full font-normal text-grayscale-700 p-4">Keluar</button>
                </form>
            </div>
        </div>
    </nav>
</header>
