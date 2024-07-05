<div class="bg-white/90 dark:bg-dark-600/40 px-4 sm:px-6 py-16 md:py-20 xl:py-28 relative">
    <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
        <h2 class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-[2.5rem] font-extrabold relative px-8 z-50">{{ __('Featured Projects') }}</h2>

        <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden">{{ __('Discover the Projects that Define Our Commitment to Quality') }}</p>

        <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:container min-[2561px]:mx-auto relative mt-10 opacity-0 overflow-hidden transition-all" x-init="$nextTick(() => new Glide($el, {
            type: 'carousel',
            direction: '{{ direction() }}',
            autoplay: 3000,
            perView: 3,
            gap: 20,
            breakpoints: {
                639: { perView: 1 },
                1279: { perView: 2 },
            },
        }).on('mount.after', () => $el.classList.remove('opacity-0')).mount());">
            <div data-glide-el="track" class="glide__track">
                <ul class="glide__slides">
                    @foreach (range(1,6) as $slide)
                        <li class="glide__slide h-full relative">
                            <x-link href="#" class="post flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none border dark:border-none !rounded-xl overflow-hidden">
                                <div class="relative">
                                    <img loading="lazy" src="{{ asset('storage/slide'. rand(1,3) .'.webp') }}" class="w-full max-sm:aspect-video sm:h-44 md:h-56 lg:h-72 xl:h-56 2xl:h-72 object-cover" alt="">
    
                                    <div class="overlay opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60  flex items-center justify-center text-white">
                                        <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-3 px-6 py-8">
                                    <h5 class="font-semibold truncate lg:text-lg">{{ str()->title(fake()->sentence(3)) }}</h5>
                                    <p class="font-light truncate">{{ str()->title(fake()->sentence(3)) }}</p>
                                </div>
                            </x-link>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
