@if (count($videos))
    <div class="px-4 sm:px-6 py-12 md:py-16 relative">
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
            <div class="glide min-[2561px]:rounded-2xl min-[2561px]:my-8 min-[2561px]:container min-[2561px]:mx-auto relative opacity-0 overflow-hidden transition-all" x-init="new Glide($el, {
                type: 'carousel',
                direction: '{{ direction() }}',
                perView: 3,
                gap: 20,
                breakpoints: {
                    639: { perView: 1 },
                    1279: { perView: 2 },
                },
            }).on('mount.after', () => $el.classList.remove('opacity-0')).mount()">
                <div data-glide-el="track" class="glide__track">
                    <ul class="glide__slides">
                        @foreach ($videos as $video)
                            <li class="glide__slide h-full relative">
                                <div class="w-full h-full rounded-lg overflow-hidden">
                                    <iframe class="w-full h-full aspect-video" src="{{ $video['url'] }}" title="YouTube video player" frameborder="0" allow="autoplay; picture-in-picture;" allowfullscreen></iframe>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="glide__arrows" dir="ltr" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left shadow-none border-0 text-dark-600 left-0 transition-opacity m-2 p-2 opacity-60 hover:opacity-100 rounded-full bg-white" data-glide-dir="<">
                        <x-icons.chevron-left class="!w-8 lg:!w-10 !h-8 lg:!h-10" />
                        <span class="sr-only">{{ __('Next') }}</span>
                    </button>
                    <button class="glide__arrow glide__arrow--right shadow-none border-0 text-dark-600 right-0 transition-opacity m-2 p-2 opacity-60 hover:opacity-100 rounded-full bg-white" data-glide-dir=">">
                        <x-icons.chevron-right class="!w-8 lg:!w-10 !h-8 lg:!h-10" />
                        <span class="sr-only">{{ __('Previous') }}</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
@else
    <div id="videos"></div>
@endif