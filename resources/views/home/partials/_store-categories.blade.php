<div class="bg-primary-100 dark:bg-dark-800 px-4 sm:px-6 py-12 md:py-20 xl:py-28 relative pattern dark:pattern-dark">
    <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
        <h2 class="text-xl md:text-2xl lg:text-3xl xl:text-[2.5rem] font-extrabold relative px-8 z-50">{{ __('Check Our Latest Products') }}</h2>

        <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden">{{ __('Pioneering Excellence in Construction Solutions') }}</p>

        <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:container min-[2561px]:mx-auto relative" x-init="$nextTick(() => new Glide($el, {
            type: 'carousel',
            direction: '{{ direction() }}',
            autoplay: 10000,
            gap: 0,
            perView: 4,
            breakpoints: {
                700: { perView: 1 },
                1023: { perView: 2 },
                1500: { perView: 3 },
            },
        }).mount());">
            <div data-glide-el="track" class="glide__track">
                <ul class="glide__slides">
                    @foreach (range(1,6) as $slide)
                        <li class="glide__slide h-full relative">
                            <x-link href="#" class="flex items-center text-start gap-4 !p-6 bg-white dark:bg-dark-700/70 shadow-lg shadow-primary-200 dark:shadow-none !rounded-3xl mx-4 my-10">
                                <img loading="lazy" src="{{ asset('storage/slide1.webp') }}" class="w-20 h-20 rounded-full object-cover" alt="">
                                <div class="flex flex-col gap-3">
                                    <h5 class="font-semibold line-clamp-2">{{ str()->title(fake()->sentence(3)) }}</h5>
                                    <p>{{ __(':products_count Products', ['products_count' => rand(5, 40)]) }}</p>
                                </div>
                            </x-link>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="-my-10"></div>
    </div>
</div>
