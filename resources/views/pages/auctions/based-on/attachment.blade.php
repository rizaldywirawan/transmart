@if ($auction['auctionAttachments'])
    @foreach ($auction['auctionAttachments'] as $attachment)

    <div class="relative w-24 h-auto">
        <a href="javascript:void(0)" data-target="{{$attachment['id']}}" class="remove-image_after">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current text-danger absolute right-0 -mr-3 -mt-3 cursor-pointer " fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>

        <img src="{{asset('storage/'.$attachment['file_path'])}}" alt="" class="h-24 w-24 rounded-md">
    </div>
    @endforeach
@endif

