<header class="fixed w-full h-20 bg-white left-0 right-0 top-0 navbar-box-shadow z-50 px-0 md:px-6 lg:px-0">
    <nav class="flex justify-between items-center sm:max-w-screen-xl py-4 px-6 sm:px-0 m-auto">
        <img src="{{ asset('images/logos/transretail-logo-landscape.png') }}" alt="Trans Retail Logo" class="h-5 sm:h-6">
        <div class="flex">
            <div class="mr-2 text-right hidden sm:block">
                <h6 class="font-bold text-lg">{{ Auth::user()->profile->name }}</h6>
                <h6 class="font-normal text-sm">{{ Auth::user()->profile->job_title ?? 'Job title belum di definisikan' }}</h6>
            </div>
            <img src="{{ asset('images/logos/transcorp-logo-icon.png') }}" alt="Trans Retail Logo" class="h-10 w-10 sm:h-12 sm:w-12 object-contain bg-background rounded-full">
        </div>
    </nav>
</header>
