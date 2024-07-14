<div class="bg-gray-100/50 dark:bg-dark-700/50 px-4 sm:px-6 py-8 md:py-10 xl:py-12 relative">
    <div class="container mx-auto flex flex-col gap-6 lg:gap-8 flex-wrap relative z-10">
        <h2 class="uppercase font-semibold text-xl lg:text-2xl text-gray-800 dark:text-dark-100 leading-tight">{{ __('Related Products') }}</h2>

        <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:container min-[2561px]:mx-auto relative opacity-0 overflow-hidden transition-all" x-init="$nextTick(() => new Glide($el, {
            type: 'carousel',
            direction: '{{ direction() }}',
            autoplay: 5000,
            perView: 5,
            gap: 20,
            breakpoints: {
                639: { perView: 1 },
                1023: { perView: 2 },
                1279: { perView: 3 },
                1535: { perView: 4 },
            },
        }).on('mount.after', () => $el.classList.remove('opacity-0')).mount());">
            <div data-glide-el="track" class="glide__track">
                <ul class="glide__slides">
                    @foreach (range(1,6) as $slide)
                        <li class="glide__slide h-full relative mb-1">
                            <div class="border rounded-md border-dark-100 dark:border-none">
                                @include('products.partials._product')
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
