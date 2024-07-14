<x-link href="{{ route('products.show', str()->slug(fake()->sentence(4))) }}" class="group flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none shadow !rounded-md overflow-hidden">
    <div class="relative">
        <img loading="lazy" src="{{ asset('storage/slide'. rand(1,3) .'.webp') }}" class="w-full aspect-video object-cover" alt="">

        <div class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60  flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>
    
    <div class="flex flex-col gap-2 px-6 py-6">
        <div class="flex gap-3 items-baseline">
            <p class="font-semibold truncate text-2xl">{{ rand(13, 37) * 10 }} <span class="text-base">E£</span></p>

            @if (rand(0, 1))
                <p class="line-through">{{ rand(13, 37) * 10 }} E£</p>
            @endif
        </div>
        
        <h5 class=" truncate lg:text-lg">{{ str()->title(fake()->sentence(3)) }}</h5>
    </div>
        
    {{-- <x-button styling="light" class="flex gap-2 dark:bg-dark-700 justify-center rounded-none py-4">
        <x-icons.cart class="!w-5 !h-5" stroke-width="1.5" />
        <span>{{ __('Add to cart') }}</span>
    </x-button> --}}
</x-link>