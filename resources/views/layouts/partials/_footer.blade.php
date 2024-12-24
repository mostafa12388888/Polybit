@if(! in_array(request()->route()?->getName(), ['home', 'faq', 'contact-us']))
    @include('layouts.partials._whatsapp-contact-card')
@endif

<footer class="{{ optional(request()->route())->getName() == 'home' ? 'bg-white' : 'bg-dark-50' }} dark:bg-dark-800 dark:border-dark-500">
    <div class="py-8 sm:py-14 px-4 sm:px-6 relative flex flex-col gap-10">
        <div class="absolute w-full h-full top-0 left-0 opacity-15 dark:opacity-10 z-0 bg-cover bg-no-repeat bg-center dark:hidden pointer-events-none bg-footer"></div>

        <div class="container mx-auto hidden xl:flex flex-grow max-md:flex-wrap">
            <x-link href="{{ route('home') }}" class="self-center sm:self-start">
                <x-application-logo class="h-16 rounded-md" :width="240" />
            </x-link>
        </div>
        
        <div class="container mx-auto flex flex-grow max-md:flex-wrap gap-10">
            <div class="flex flex-col gap-6 min-w-72 lg:min-w-80 xl:min-w-96 max-w-full">
                <x-link href="{{ route('home') }}" class="self-center sm:self-start block xl:hidden mb-4">
                    <x-application-logo class="h-20 rounded-md" :width="240" />
                </x-link>

                <div class="flex md:flex-col flex-wrap items-stretch justify-stretch gap-2 sm:gap-4 order-3 md:order-2">
                    @foreach (setting('phones') ?: [] as $phone)
                        <x-link href="tel:{{ $phone }}" class="w-full flex items-center md:gap-2 md:border-none md:!bg-transparent border bg-white/50 dark:bg-dark-700 overflow-hidden border-primary-300/80 rounded-lg dark:border-none flex-grow {{ $loop->index ? 'max-md:hidden' : '' }}">
                            <div class="px-4 py-3 bg-secondary-200/30 dark:bg-dark-700/60 rounded md:h-8 md:w-8 md:flex md:items-center md:justify-center">
                                <x-icons.phone class="flex-shrink-0 sm:!w-5 sm:!h-5 text-dark-500 dark:text-primary-200" />
                            </div>
                            <span class="flex-grow px-4 py-2 ltr:text-start rtl:text-end md:p-0" dir="ltr">{{ $phone }}</span>
                        </x-link>
                        @break
                    @endforeach
                    
                    @foreach (setting('emails') ?: [] as $email)
                        <x-link href="mail:{{ $email }}" class="w-full flex items-center md:gap-2 md:border-none md:!bg-transparent border bg-white/50 dark:bg-dark-700 overflow-hidden border-primary-300/80 rounded-lg dark:border-none flex-grow {{ $loop->index ? 'max-md:hidden' : '' }}">
                            <div class="px-4 py-3 bg-secondary-200/30 dark:bg-dark-700/60 rounded md:h-8 md:w-8 md:flex md:items-center md:justify-center">
                                <x-icons.envelope class="flex-shrink-0 sm:!w-5 sm:!h-5 text-dark-500 dark:text-primary-200 rounded-full" />
                            </div>
                            <span class="flex-grow px-4 py-2 text-start md:p-0">{{ $email }}</span>
                        </x-link>
                        @break
                    @endforeach
                        
                    @if ($address = setting('address'))
                        <div class="w-full flex text-gray-700 dark:text-dark-100 items-stretch md:gap-2 md:border-none md:!bg-transparent border bg-white/50 dark:bg-dark-700 overflow-hidden border-primary-300/80 rounded-lg dark:border-none flex-grow">
                            <div class="px-4 py-3 bg-secondary-200/30 dark:bg-dark-700/60 rounded md:h-8 md:w-8 md:flex md:items-center md:justify-center flex items-center">
                                <x-icons.map-pin class="flex-shrink-0 sm:!w-5 sm:!h-5 text-dark-500 dark:text-primary-200" />
                            </div>
                            <p class="flex-grow px-4 py-2 text-start md:p-0 md:max-w-80 text-balance">{{ $address }}</p>
                        </div>
                    @endif
                </div>

                <div class="w-full flex-grow flex flex-wrap gap-2 sm:max-w-96 order-3 justify-center sm:justify-start">
                    @include('layouts.partials._social-links')
                </div>
                
            </div>
        
            <div class="flex gap-x-4 md:gap-y-8 flex-wrap flex-grow text-start divide-y md:divide-y-0 border-y md:border-none border-primary-200 dark:border-dark-700">
                @if ($store_categories->count())
                    <div class="flex flex-col flex-grow w-full md:w-auto border-primary-200 dark:border-dark-700 md:gap-4 min-w-40" x-data="{open: false}">
                        <div class="max-md:cursor-pointer flex justify-between gap-2 py-5 md:py-0" x-on:click="open = !open">
                            <p class="md:text-lg font-semibold">{{ __('Store Categories') }}</p>
                            <x-icons.chevron-down class="md:hidden" x-show="! open" />
                            <x-icons.chevron-up class="md:hidden" x-cloak x-show="open" />
                        </div>

                        <div class="md:!block md:!h-auto" x-show="open" x-collapse x-cloak>
                            <div class="pb-4 flex flex-col gap-4">
                                @foreach ($store_categories->take(5) as $store_category)
                                    <x-link :href="route('store-categories.show', $store_category)">{{ $store_category->name }}</x-link>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                @if ($blog_categories->count())
                    <div class="flex flex-col flex-grow w-full md:w-auto border-primary-200 dark:border-dark-700 md:gap-4 min-w-40" x-data="{open: false}">
                        <div class="max-md:cursor-pointer flex justify-between gap-2 py-5 md:py-0" x-on:click="open = !open">
                            <p class="md:text-lg font-semibold">{{ __('Blog Categories') }}</p>
                            <x-icons.chevron-down class="md:hidden" x-show="! open" />
                            <x-icons.chevron-up class="md:hidden" x-cloak x-show="open" />
                        </div>
                        
                        <div class="md:!block md:!h-auto" x-show="open" x-collapse x-cloak>
                            <div class="pb-4 flex flex-col gap-4">
                                @foreach ($blog_categories->take(5) as $blog_category)
                                    <x-link :href="route('blog-categories.show', $blog_category)">{{ $blog_category->name }}</x-link>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col flex-grow w-full md:w-auto border-primary-200 dark:border-dark-700 md:gap-4 min-w-40" x-data="{open: false}">
                    <div class="max-md:cursor-pointer flex justify-between gap-2 py-5 md:py-0" x-on:click="open = !open">
                        <p class="md:text-lg font-semibold">{{ __('Support') }}</p>
                        <x-icons.chevron-down class="md:hidden" x-show="! open" />
                        <x-icons.chevron-up class="md:hidden" x-cloak x-show="open" />
                    </div>

                    <div class="md:!block md:!h-auto" x-show="open" x-collapse x-cloak>
                        <div class="pb-4 flex flex-col gap-4">
                            <x-link :href="route('contact-us')">{{ __('Contact Us') }}</x-link>
                            <x-link :href="route('faq')">{{ __('FAQ') }}</x-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto flex flex-col flex-grow lg:-mt-6 lg:-mb-4">
            <div class="w-full flex-grow flex flex-wrap gap-x-6 gap-y-3 items-center justify-center">
                <x-link :href="route('products.index')">{{ __('Store') }}</x-link>
                <x-link :href="route('posts.index')">{{ __('Blog') }}</x-link>
                @foreach ($pages->where('is_visible_in_footer_navbar') as $page)
                    <x-link :href="route('pages.show', $page)">{{ $page->title }}</x-link>
                @endforeach
            </div>
        </div>
    </div>

    <div class="p-4 bg-secondary-100/10 dark:bg-dark-900/40">
        <div class="container mx-auto flex items-center justify-center gap-4">
            <p>
                <span>{{ __("© :year :app", ['year' => date('Y'), 'app' => config('app.name')]) }},</span>
                <a href="https://brmjyat.com" target="_blank">{{ __('developed by brmjyat') }}.</a>
            </p>
        </div>
    </div>
</footer>
