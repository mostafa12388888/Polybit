@php($locale = collect(locales(false))?->where('code', '!=', app()->getLocale())?->first())

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

                @forelse (collect($alternate_locales)->filter(fn($locale) => $locale != app()->getLocale())->toArray() as $alternate_locale)
                    @php($alternate_locale = collect(locales(false))->where('code', $alternate_locale)->first())

                    <x-link href="{{ localized_url($alternate_locale['code']) }}" styling="light" class="flex md:hidden !rounded-md !px-3 h-11 items-center justify-center relative">
                        <div class="!p-0 flex-grow flex flex-row-reverse gap-1 items-center">
                            <x-icons.globe-africa stroke-width="1.3" class="!w-5 !h-5" />
                            <span class="ltr:pt-0.5 ltr:text-lg max-[385px]:hidden">{{ $alternate_locale['symbol'] ?? '' }}</span>
                        </div>
                    </x-link>
                @empty
                    @if ($locale)
                        <x-link href="{{ localized_url($locale['code'], $fallback_alternate_url ?? url('/')) }}" styling="light" class="flex md:hidden !rounded-md !px-3 h-11 items-center justify-center relative">
                            <div class="!p-0 flex-grow flex flex-row-reverse gap-1 items-center">
                                <x-icons.globe-africa stroke-width="1.3" class="!w-5 !h-5" />
                                <span class="ltr:pt-0.5 ltr:text-lg max-[385px]:hidden">{{ $locale['symbol'] ?? '' }}</span>
                            </div>
                        </x-link>
                    @endif
                @endforelse

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
