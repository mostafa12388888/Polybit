<div class="bg-secondary-200/10 dark:bg-dark-600/40 px-4 sm:px-6 py-12 md:py-16 xl:py-24 relative">
    <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
        <h2 class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-4xl font-extrabold relative px-8 z-50">{{ __('Latest Blog Posts') }}</h2>

        <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden">{{ __('Discover the Projects that Define Our Commitment to Quality') }}</p>

        <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:container min-[2561px]:mx-auto relative mt-10 opacity-0 overflow-hidden transition-all" x-init="$nextTick(() => new Glide($el, {
            type: 'carousel',
            direction: '{{ direction() }}',
            autoplay: 5000,
            perView: 3,
            gap: 20,
            breakpoints: {
                639: { perView: 1 },
                1279: { perView: 2 },
            },
        }).on('mount.after', () => $el.classList.remove('opacity-0')).mount());">
            <div data-glide-el="track" class="glide__track">
                <ul class="glide__slides">
                    @foreach ($posts as $post)
                        <li class="glide__slide h-full relative">
                            @include('posts.partials._post-card-vertical', compact('post'))
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
