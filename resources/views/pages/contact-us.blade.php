<x-app-layout>
    <x-slot name="heading">{{ __('Contact Us') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ __('Contact Us') }}</x-breadcrumb>
    </x-slot>

    <article class="flex-grow bg-primary-100 dark:bg-dark-800/70 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col lg:flex-row sm:gap-4 max-sm:divide-y">
            <div class="flex-grow h-96">
                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=22%20%D8%A7%D9%84%D8%B4%D9%87%D9%8A%D8%AF%20%D9%85%D8%AD%D9%85%D8%AF%20%D8%B9%D8%A8%D8%AF%20%D8%A7%D9%84%D9%87%D8%A7%D8%AF%D9%8A%D8%8C%20%D9%85%D8%B3%D8%A7%D9%83%D9%86%20%D8%A7%D9%84%D9%85%D9%87%D9%86%D8%AF%D8%B3%D9%8A%D9%86%D8%8C%20%D9%85%D8%AF%D9%8A%D9%86%D8%A9%20%D9%86%D8%B5%D8%B1%D8%8C%20%D9%85%D8%AD%D8%A7%D9%81%D8%B8%D8%A9%20%D8%A7%D9%84%D9%82%D8%A7%D9%87%D8%B1%D8%A9%E2%80%AC%204451722&t=m&z=10&output=embed" style="border:0; width:100%; height:400px; height: 100%;"></iframe>
            </div>

            <div class="lg:rounded-md flex-grow w-full lg:w-6/12 2xl:w-6/12 overflow-hidden">
                <div class="bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 flex flex-col gap-6">
                    <div class="flex flex-col gap-3">
                        <x-label required for="">{{ __('Your Name') }}</x-label>
        
                        <x-input placeholder="{{ __('Name') }}" />
                    </div>
                    <div class="flex flex-col gap-3">
                        <x-label required for="">{{ __('Your Email Address') }}</x-label>
        
                        <x-input placeholder="{{ __('Email') }}" />
                    </div>
                    <div class="flex flex-col gap-3">
                        <x-label for="">{{ __('Your Phone') }}</x-label>
        
                        <x-input placeholder="{{ __('Phone') }}" />
                    </div>
                    <div class="flex flex-col gap-3">
                        <x-label required for="">{{ __('Your Message') }}</x-label>
        
                        <x-textarea rows="6" placeholder="{{ __('Message') }}" />
                    </div>
                    <div class="flex flex-col"></div>
                    <div class="flex flex-col"></div>
                </div>
            </div>
        </div>
    </article>
</x-app-layout>
