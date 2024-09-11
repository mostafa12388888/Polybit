<div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 sm:rounded-md gap-4 dark:border-dark-800 max-lg:py-10 flex flex-col">
    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-1">{{ $title ?? __('Have any questions ?') }}</h3>
    
    <p>{{ $sub_title ?? __('We\'d love to hear from you') }}.</p>


    @foreach (setting('phones') ?: [] as $phone)
        <x-link href="tel:{{ $phone }}" class="flex gap-2">
            <x-icons.phone class="flex-shrink-0 !w-5 !h-5" width-stroke="1" />
            <span dir="ltr">{{ $phone }}</span>
        </x-link>
    @endforeach
                
    @foreach (setting('emails') ?: [] as $email)
        <x-link href="mail:{{ $email }}" class="flex gap-2">
            <x-icons.envelope class="flex-shrink-0 !w-5 !h-5" width-stroke="1" />
            <span>{{ $email }}</span>
        </x-link>
    @endforeach

    <x-link styling="{{ $button ?? 'secondary' }}" :href="route('contact-us')" class="text-center">{{ __('Contact Us') }}</x-link>
</div>