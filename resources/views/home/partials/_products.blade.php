<div class="bg-gradient-to-b from-secondary-50/50 to-secondary-100/50 dark:from-dark-700/40 dark:to-dark-700/40 px-2 sm:px-6 pt-12 pb-5 md:pt-16 xl:pt-24 relative">
    <div class="sm:container flex flex-col gap-3 md:gap-4 lg:gap-8 mx-auto relative z-10">
        <div class="flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center text-center px-4 sm:px-0">
            <h2 class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-4xl font-extrabold relative px-8 z-50">{{ __('Check Out Our Products') }}</h2>
    
            <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden">{{ __('Elevate your projects with our avant-garde construction chemical solutions') }}</p>
        </div>

        <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:mx-auto relative h-[287px] opacity-0 overflow-hidden" x-init="$nextTick(() => new Glide($el, {
            type: 'carousel',
            direction: '{{ direction() }}',
            autoplay: 10000,
            gap: 0,
            perView: 4,
            breakpoints: {
                639: { perView: 1 },
                1023: { perView: 2},
                1500: { perView: 3 },
            },
        }).on('mount.after', () => $el.classList.remove('h-[287px]', 'opacity-0')).mount());">
            <div data-glide-el="track" class="glide__track">
                <ul class="glide__slides">
                    @foreach ($products as $product)
                        <li class="glide__slide h-full">
                            <x-link href="#" class="group flex items-center text-start gap-3 !px-3 !py-10 aspect-video bg-white dark:bg-dark-900/40 shadow-md shadow-dark-200 dark:shadow-none !rounded-xl mx-2 my-10 overflow-hidden relative" :href="route('products.show', $product)">
                                <x-curator-glider fallback="logo" :media="$product->image" :alt="$product->name" format="webp" width="480" height="280" fit="crop" quality="70" class="absolute top-0 left-0 w-full h-full flex-grow transition-transform group-hover:scale-125 object-cover bg-white" />
                                <h2 class="sr-only">{{ $product->name }}</h2>
                            </x-link>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
