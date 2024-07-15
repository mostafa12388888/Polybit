<footer class="{{ optional(request()->route())->getName() == 'home' ? 'bg-white' : 'bg-dark-50' }} dark:bg-dark-800 dark:border-dark-500">
    <div class="py-8 sm:py-14 px-4 sm:px-6 relative">
        <div class="absolute w-full h-full top-0 left-0 opacity-25 dark:opacity-10 z-0 bg-cover bg-no-repeat bg-center dark:hidden pointer-events-none" style="background-image: url('/images/footer-background.webp');"></div>

        <div class="container mx-auto flex flex-grow max-md:flex-wrap max-sm:items-center max-sm:justify-center max-sm:text-center gap-12 mb-8 sm:mb-12">
            <div class="flex flex-col gap-4 min-w-64 max-sm:items-center max-sm:justify-center max-sm:text-center">
                <!-- Logo -->
                <x-link href="{{ route('home') }}" class="mb-4 sm:mb-8">
                    <x-application-logo class="h-10 sm:h-14" />
                </x-link>
                <!-- End Logo -->
    
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

                <div class="flex gap-2 text-gray-700 dark:text-dark-100">
                    <x-icons.map-pin class="flex-shrink-0 !w-5 !h-5 leading-loose hidden sm:inline" width-stroke="1" />
                    <p class="sm:max-w-64 text-balance">22 El-Shaheed Mohammed Abd El-Hady, Nasr City, Cairo</p>
                </div>

                <div class="w-full flex-grow flex-wrap flex gap-2 mt-4 max-sm:items-center max-sm:justify-center max-sm:text-center max-w-96">
                    @include('layouts.partials._social-links')
                </div>
            </div>
        
            <div class="flex gap-x-4 gap-y-8 flex-wrap flex-grow self-center max-sm:hidden">
                <div class="flex flex-col gap-3 flex-grow min-w-64">
                    <h4 class="text-lg font-semibold mb-2">{{ __('Store Categories') }}</h4>

                    @foreach (range(1,5) as $item)
                        <x-link :href="route('products.index')">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    @endforeach
                </div>
                
                <div class="flex flex-col gap-3 flex-grow min-w-64">
                    <h4 class="text-lg font-semibold mb-2">{{ __('Blog Categories') }}</h4>
                    
                    @foreach (range(1,5) as $item)
                        <x-link :href="route('posts.index')">{{ str()->limit(fake()->sentence(rand(3, 6)), 35) }}</x-link>
                    @endforeach
                </div>

                <div class="lg:flex flex-col gap-3 flex-grow min-w-64 hidden">
                    <h4 class="text-lg font-semibold mb-2">{{ __('Support') }}</h4>

                    <x-link :href="route('contact-us')">{{ __('Contact Us') }}</x-link>
                    <x-link :href="route('faq')">{{ __('FAQ') }}</x-link>
                </div>
            </div>
        </div>

        <div class="container mx-auto flex flex-col flex-grow">
            <div class="w-full flex-grow flex flex-wrap gap-x-6 gap-y-3 items-center justify-center">
                <x-link :href="route('products.index')">{{ __('Store') }}</x-link>
                <x-link :href="route('posts.index')">{{ __('Blog') }}</x-link>
                <x-link :href="route('pages.show', str()->slug('About Us'))">{{ __('About Us') }}</x-link>
                <x-link :href="route('pages.show', str()->slug('Privacy Policy'))">{{ __('Privacy Policy') }}</x-link>
                <x-link :href="route('pages.show', str()->slug('Terms Of Service'))">{{ __('Terms Of Service') }}</x-link>
                <x-link :href="route('contact-us')" class="lg:hidden">{{ __('Contact Us') }}</x-link>
                <x-link :href="route('faq')" class="lg:hidden">{{ __('FAQ') }}</x-link>
            </div>
        </div>
    </div>

    <div class="p-4 bg-primary-100/10 dark:bg-dark-900/40">
        <div class="container mx-auto flex items-center justify-center sm:justify-between flex-col sm:flex-row gap-4">
            <p>{{ __("© :year :app, All rights reserved", ['year' => date('Y'), 'app' => config('app.name')]) }}.</p>
            <a href="#">{{ __("Developed by brmjyat") }}.</a>
        </div>
    </div>
</footer>
