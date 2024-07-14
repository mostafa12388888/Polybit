<div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 sm:rounded-md gap-4 dark:border-dark-800 max-lg:py-10 flex flex-col">
    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-1">{{ $title ?? __('Have any questions ?') }}</h3>
    
    <p>{{ $sub_title ?? __('We\'d love to hear from you') }}.</p>

    <x-link href="tel:+201022000050" class="flex gap-2">
        <x-icons.phone class="flex-shrink-0 !w-5 !h-5" width-stroke="1" />
        <span>+20 1022000050</span>
    </x-link>

    <x-link href="tel:+201080029701" class="flex gap-2">
        <x-icons.phone class="flex-shrink-0 !w-5 !h-5" width-stroke="1" />
        <span>+20 1080029701</span>
    </x-link>

    <x-link href="tel:+201068977712" class="flex gap-2">
        <x-icons.phone class="flex-shrink-0 !w-5 !h-5" width-stroke="1" />
        <span>+20 1068977712</span>
    </x-link>

    <x-link href="mail:info@ichemeg.com" class="flex gap-2">
        <x-icons.envelope class="flex-shrink-0 !w-5 !h-5" width-stroke="1" />
        <span>info@ichemeg.com</span>
    </x-link>

    <x-link styling="{{ $button ?? 'primary' }}" :href="route('contact-us')" class="text-center">{{ __('Contact Us') }}</x-link>
</div>