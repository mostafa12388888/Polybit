<div class="bg-white dark:bg-dark-700/40 px-4 sm:px-6 py-12 md:pt-16 xl:pt-24 relative">
    <div class="sm:container flex flex-col gap-3 md:gap-4 lg:gap-8 mx-auto relative z-10">
        <div class="flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center text-center px-4 sm:px-0">
            <h2 class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-4xl font-extrabold relative px-8 z-50">{{ __('What People Are Saying') }}</h2>
    
            <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden">{{ __('Genuine reviews from our valued customers') }}</p>
        </div>

        <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:mx-auto relative h-[308px] opacity-0 overflow-hidden" x-init="$nextTick(() => new Glide($el, {
            type: 'carousel',
            direction: '{{ direction() }}',
            autoplay: 3000,
            gap: 20,
            perView: 4,
            breakpoints: {
                700: { perView: 1 },
                1023: { perView: 2},
                1500: { perView: 3 },
            },
        }).on('mount.after', () => $el.classList.remove('h-[308px]', 'opacity-0')).mount());">
            <div data-glide-el="track" class="glide__track py-6">
                <ul class="glide__slides flex !overflow-visible">
                    @foreach ($testimonials as $testimonial)
                        <li class="glide__slide h-full">
                            @include('home.partials._testemonial')
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
