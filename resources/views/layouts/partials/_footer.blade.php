<footer class="bg-white dark:bg-dark-800 dark:border-dark-500">
    <div class="py-8 sm:py-14 px-4 sm:px-6 relative">
        <div class="absolute w-full h-full top-0 left-0 opacity-25 dark:opacity-10 z-0 bg-cover bg-no-repeat bg-center pointer-events-none" style="background-image: url('/storage/texture.png');"></div>

        <div class="container mx-auto flex flex-grow max-md:flex-wrap max-sm:items-center max-sm:justify-center max-sm:text-center gap-12 mb-8 sm:mb-12">
            <div class="flex flex-col gap-4 min-w-64 max-sm:items-center max-sm:justify-center max-sm:text-center">
                <!-- Logo -->
                <x-link href="{{ route('home') }}" class="mb-4 sm:mb-8">
                    <x-application-logo class="h-10 sm:h-14" />
                </x-link>
                <!-- End Logo -->
    
                <x-link styling="link" href="tel:+201022000050" class="flex gap-2">
                    <x-icons.phone class="!w-5 !h-5" width-stroke="1" />
                    <span>+20 1022000050</span>
                </x-link>
    
                <x-link styling="link" href="tel:+201080029701" class="flex gap-2">
                    <x-icons.phone class="!w-5 !h-5" width-stroke="1" />
                    <span>+20 1080029701</span>
                </x-link>
    
                <x-link styling="link" href="tel:+201068977712" class="flex gap-2">
                    <x-icons.phone class="!w-5 !h-5" width-stroke="1" />
                    <span>+20 1068977712</span>
                </x-link>
    
                <x-link styling="link" href="mail:info@ichemeg.com" class="flex gap-2">
                    <x-icons.envelope class="!w-5 !h-5" width-stroke="1" />
                    <span>info@ichemeg.com</span>
                </x-link>

                <div class="w-full flex-grow flex-wrap flex gap-2 mt-4 max-sm:items-center max-sm:justify-center max-sm:text-center max-w-96">
                    <x-link styling="light" href="#" class="!p-0 flex items-center justify-center w-10 h-10">
                        <x-icons.facebook class="!w-5 !h-5 text-primary-500 dark:text-dark-300" />
                    </x-link>
                    
                    <x-link styling="light" href="#" class="!p-0 flex items-center justify-center w-10 h-10">
                        <x-icons.twitter class="!w-5 !h-5 text-primary-500 dark:text-dark-300" />
                    </x-link>
                    
                    <x-link styling="light" href="#" class="!p-0 flex items-center justify-center w-10 h-10">
                        <x-icons.youtube class="!w-7 !h-5 text-primary-500 dark:text-dark-300" />
                    </x-link>
                    
                    <x-link styling="light" href="#" class="!p-0 flex items-center justify-center w-10 h-10">
                        <x-icons.linkedin class="!w-5 !h-5 text-primary-500 dark:text-dark-300" />
                    </x-link>

                    <x-link styling="light" href="#" class="!p-0 flex items-center justify-center w-10 h-10">
                        <x-icons.link class="!w-5 !h-5 text-primary-500 dark:text-dark-300" />
                    </x-link>
                </div>
            </div>
        
            <div class="flex gap-x-4 gap-y-8 flex-wrap flex-grow self-center max-sm:hidden">
                <div class="flex flex-col gap-3 flex-grow min-w-64">
                    <h4 class="text-lg font-semibold mb-2">{{ __('Store Categories') }}</h4>

                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                </div>

                <div class="flex flex-col gap-3 flex-grow min-w-64">
                    <h4 class="text-lg font-semibold mb-2">{{ __('Blog Categories') }}</h4>

                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    <x-link styling="link" href="#">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                </div>

                <div class="lg:flex flex-col gap-3 flex-grow min-w-64 hidden">
                    <h4 class="text-lg font-semibold mb-2">{{ __('Support') }}</h4>

                    <x-link styling="link" href="#">{{ __('Contact Us') }}</x-link>
                    <x-link styling="link" href="#">{{ __('FAQs') }}</x-link>
                </div>
            </div>
        </div>

        <div class="container mx-auto flex flex-col flex-grow">
            <div class="w-full flex-grow flex flex-wrap gap-x-6 gap-y-3 items-center justify-center">
                <x-link styling="link" href="#">{{ __('Store') }}</x-link>
                <x-link styling="link" href="#">{{ __('Blog') }}</x-link>
                <x-link styling="link" href="#">{{ __('About Us') }}</x-link>
                <x-link styling="link" href="#">{{ __('Privacy Policy') }}</x-link>
                <x-link styling="link" href="#">{{ __('Terms Of Service') }}</x-link>
                <x-link styling="link" href="#" class="lg:hidden">{{ __('Contact Us') }}</x-link>
                <x-link styling="link" href="#" class="lg:hidden">{{ __('FAQs') }}</x-link>
            </div>
        </div>
    </div>

    <div class="p-4 bg-gray-200 dark:bg-dark-900/40">
        <div class="container mx-auto text-center">
            <p>{{ __("© :year :app. All rights reserved.", ['year' => date('Y'), 'app' => config('app.name')]) }}</p>
        </div>
    </div>
</footer>
