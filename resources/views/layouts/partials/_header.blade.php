<div class="max-md:hidden">
    @include('layouts.partials._topbar')
</div>

<header class="sticky top-0 bg-white dark:bg-dark-700 z-30 border-b border-dark-200 dark:border-dark-800/20" x-ref="header">
    <div class="bg-white dark:bg-dark-800/70 shadow shadow-dark-100 dark:shadow-none mx-auto ps-2 pe-4 sm:ps-3 sm:pe-6 py-3 relative">
        <div class="container mx-auto flex gap-2 md:gap-4 lg:gap-6 justify-between items-center flex-wrap">
            @include('layouts.partials._navbar')

            <div class="xl:hidden order-3 md:order-1">
                <x-button styling="light" class="!rounded-md aspect-square w-11 h-11 !p-0 flex items-center justify-center" @click="toggleSearch">
                    <x-icons.search class="!w-5 !h-5" stroke-width="2" />
                    <span class="sr-only">{{ __('Show Search Bar') }}</span>
                </x-button>
            </div>
            
            {{-- Separator --}}
            <div class="flex-grow xl:hidden"></div>

            <div class="flex flex-row-reverse gap-2 md:gap-2.5 xl:flex-grow-0 order-2 items-center">
                <div class="hidden sm:block">
                    @include('layouts.partials._user-menu')
                </div>
                
                <x-button styling="light" class="!rounded-md aspect-square w-11 h-11 !p-0 flex items-center justify-center" @click="toggleDarkMode">
                    <x-icons.moon class="!w-5 !h-5" x-show="! darkMode"/>
                    <x-icons.sun class="!w-5 !h-5" x-cloak x-show="darkMode"/>
                    <span class="sr-only">{{ __('Toggle Dark Mode') }}</span>
                </x-button>

                <x-link :href="route('cart')" styling="light" class="hidden sm:flex !rounded-md aspect-square w-11 h-11 !p-0 items-center justify-center relative">
                    <x-icons.cart class="!w-5 !h-5" />
                    <livewire:cart-items-count />
                    <span class="sr-only">{{ __('Shopping Cart') }}</span>
                </x-link>
                
                @php($locale = collect(locales(false))?->where('code', '!=', app()->getLocale())?->first())

                @if ($locale)
                    <x-link href="{{ localized_url($locale['code']) }}" styling="light" class="flex sm:hidden !rounded-md !px-3 h-11 items-center justify-center relative">
                        <div class="!p-0 flex-grow flex flex-row-reverse gap-1 items-center">
                            <x-img loading="lazy" class="w-6 h-5 rounded object-cover" width="24" height="20" src="https://flagpedia.net/data/flags/h24/{{ $locale['flag'] }}.webp" alt="Switch to {{ $locale['name'] }}" />
                            <span class="ltr:pt-0.5 ltr:text-lg max-[385px]:hidden">{{ $locale['symbol'] ?? '' }}</span>
                        </div>
                    </x-link>
                @endif
                
                {{-- <x-dropdown dropdownClasses="w-full max-md:rounded-t-none md:w-40 pt-2" contentClasses="max-md:rounded-t-none" wrapperClasses="static" :openOnHover="true">
                    <x-slot:trigger>                        
                        <x-button styling="light" class="flex sm:hidden !rounded-md !px-3 h-11 items-center justify-center relative">
                            <div class="!p-0 flex-grow flex flex-row-reverse gap-1 items-center">
                                <x-icons.globe-africa stroke-width="1" class="!w-5 !h-5" />
                                <span class="rtl:pb-2 ltr:pt-0.5 max-[385px]:hidden">{{ optional(collect(locales(false))?->where('code', app()->getLocale())?->first())['symbol'] ?? '' }}</span>
                            </div>
                        </x-button>
                    </x-slot>
    
                    <x-slot:content>
                        @foreach (locales(false) as $locale)
                            <x-dropdown.link :navigate="false" class="py-4" href="{{ localized_url($locale['code']) }}">
                                <x-img loading="lazy" class="w-6 h-4" width="24" height="16" src="https://flagpedia.net/data/flags/h24/{{ $locale['flag'] }}.webp" />
                                <span>{{ $locale['name'] }}</span>
                            </x-link>
                        @endforeach
                    </x-slot>
                </x-dropdown> --}}

                @if (config('app.env') == 'local')
                    <div class="text-center " style="direction:ltr;">
                        <span class="sm:hidden">xs</span>
                        <span class="hidden sm:inline md:hidden">sm</span>
                        <span class="hidden md:inline lg:hidden">md</span>
                        <span class="hidden lg:inline xl:hidden">lg</span>
                        <span class="hidden xl:inline 2xl:hidden">xl</span>
                        <span class="hidden 2xl:inline 3xl:hidden">2xl</span>
                    </div>
                @endif
            </div>
            
            <div class="hidden xl:!flex flex-grow justify-center order-3 xl:order-1 w-full xl:w-auto" x-ref="search" x-bind:class="search === true ? '!flex' : ''">
                <livewire:search />
            </div>
        </div>
    </div>
</header>
<!-- End Header -->
