@props(['slides_count' => 0])

<div {{ $attributes->merge(['class' => 'glide overflow-hidden  relative']) }} 
    x-init="$nextTick(() => new Glide($el, {type: 'carousel', direction: '{{ direction() }}', autoplay: 50000,}).mount());">
    <div data-glide-el="track" class="glide__track">
        {{ $slot }}
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

    @if ($slides_count > 1)
        <div class="glide__bullets max-md:hidden" data-glide-el="controls[nav]">
            @foreach (range(0, $slides_count-1) as $slide_index)
                <button class="glide__bullet dark:bg-dark-300" data-glide-dir="={{ $slide_index }}">
                    <span class="sr-only">{{ __('Slide :slide_index', ['slide_index' => $slide_index]) }}</span>
                </button>
            @endforeach
        </div>
    @endif
</div>