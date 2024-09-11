<div class="dark:bg-dark-800 min-[2561px]:py-8">
    <div class="glide overflow-hidden min-[2561px]:rounded-2xl min-[2561px]:container min-[2561px]:mx-auto relative" x-init="$nextTick(() => new Glide($el, {
        type: 'carousel',
        direction: '{{ direction() }}',
        autoplay: 3000,
    }).mount());">
        <div data-glide-el="track" class="glide__track">
            <ul class="glide__slides h-72 sm:h-80 md:h-96 lg:h-[30rem] xl:h-[34rem] 2xl:h-[42rem] min-[2561px]:h-[34rem]">
                @foreach (range(1,3) as $slide)
                    <li class="glide__slide h-full relative">
                        <div class="w-full h-full">
                            <div class="absolute w-full h-full top-0 left-0 bg-dark-900/70 dark:bg-dark-900/70"></div>
    
                            <div class="absolute w-full h-full p-8 md:p-24 flex flex-col gap-4 md:gap-6 xl:gap-8 items-center justify-center text-center">
                                <h2 class="text-secondary-50 dark:text-dark-50 text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold">{{ str()->title(fake()->sentence(3)) }}</h2>
    
                                <p class="text-secondary-50 dark:text-dark-50 text-base md:text-lg xl:text-xl w-full max-w-6xl line-clamp-3 xl:line-clamp-3">{{ fake()->paragraph(10) }}</p>

                                <div class="flex flex-wrap gap-2 md:gap-x-3 lg:gap-x-4 xl:gap-x-6 items-center justify-center text-secondary-50 dark:text-dark-50">
                                    <div class="flex gap-2">
                                        <x-icons.user class="flex-shrink-0 !w-4 !h-4" />
                                        <span class="text-sm line-clamp-1">{{ str()->limit(str()->title(fake()->sentence(2)), 240) }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <x-icons.tag class="flex-shrink-0 !w-4 !h-4" />
                                        <span class="text-sm line-clamp-1">{{ str()->limit(str()->title(fake()->sentence(3)), 240) }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <x-icons.clock class="flex-shrink-0 !w-4 !h-4" />
                                        <span class="text-sm line-clamp-1">{{ now()->subMinutes(rand(1, 1000))->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
    
                            <x-img loading="lazy" src="{{ asset('storage/slide' . $slide . '.webp') }}" class="w-full h-full object-cover" alt=""  />
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    
        <div class="glide__arrows" dir="ltr" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left h-full shadow-none border-0 text-secondary-50 dark:text-dark-100 left-0 transition-opacity p-1 lg:p-8 opacity-50 hover:opacity-100" data-glide-dir="<">
                <x-icons.chevron-left class="!w-8 lg:!w-12 !h-8 lg:!h-12" />
                <span class="sr-only">{{ __('Next') }}</span>
            </button>
            <button class="glide__arrow glide__arrow--right h-full shadow-none border-0 text-secondary-50 dark:text-dark-100 right-0 transition-opacity p-1 lg:p-8 opacity-50 hover:opacity-100" data-glide-dir=">">
                <x-icons.chevron-right class="!w-8 lg:!w-12 !h-8 lg:!h-12" />
                <span class="sr-only">{{ __('Previous') }}</span>
            </button>
        </div>
    
        <div class="glide__bullets max-md:hidden" data-glide-el="controls[nav]">
            <button class="glide__bullet dark:bg-dark-300" data-glide-dir="=0">
                <span class="sr-only">{{ __('Slide :slide_index', ['slide_index' => 1]) }}</span>
            </button>
            <button class="glide__bullet dark:bg-dark-300" data-glide-dir="=1">
                <span class="sr-only">{{ __('Slide :slide_index', ['slide_index' => 2]) }}</span>
            </button>
            <button class="glide__bullet dark:bg-dark-300" data-glide-dir="=2">
                <span class="sr-only">{{ __('Slide :slide_index', ['slide_index' => 3]) }}</span>
            </button>
        </div>
    </div>
</div>
