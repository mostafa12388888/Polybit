<div class="glide" {{ $attributes->merge(['class' => 'overflow-hidden  relative']) }} 
    x-init="$nextTick(() => new Glide($el, {type: 'carousel', direction: '{{ direction() }}', autoplay: 50000,}).mount());">
    <div data-glide-el="track" class="glide__track">
        {{ $slot }}
    </div>

    <div class="glide__arrows" dir="ltr" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left h-full shadow-none border-0 text-gray-50 dark:text-dark-100 left-0 transition-opacity p-1 lg:p-8 opacity-50 hover:opacity-100" data-glide-dir="<">
            <x-icons.chevron-left class="!w-8 lg:!w-12 !h-8 lg:!h-12" />
            <span class="sr-only">{{ __('Next') }}</span>
        </button>
        <button class="glide__arrow glide__arrow--right h-full shadow-none border-0 text-gray-50 dark:text-dark-100 right-0 transition-opacity p-1 lg:p-8 opacity-50 hover:opacity-100" data-glide-dir=">">
            <x-icons.chevron-right class="!w-8 lg:!w-12 !h-8 lg:!h-12" />
            <span class="sr-only">{{ __('Previous') }}</span>
        </button>
    </div>

    <div class="glide__bullets max-md:hidden" data-glide-el="controls[nav]">
        <button class="glide__bullet dark:bg-dark-300" data-glide-dir="=0">
            <span class="sr-only">{{ __('Slide 1') }}</span>
        </button>
        <button class="glide__bullet dark:bg-dark-300" data-glide-dir="=1">
            <span class="sr-only">{{ __('Slide 2') }}</span>
        </button>
        <button class="glide__bullet dark:bg-dark-300" data-glide-dir="=2">
            <span class="sr-only">{{ __('Slide 3') }}</span>
        </button>
    </div>
</div>