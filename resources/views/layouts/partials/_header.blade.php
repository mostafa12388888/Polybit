<header class="sticky top-0 bg-white dark:bg-dark-700" x-ref="header">
    <div class="max-md:hidden">
        @include('layouts.partials._topbar')
    </div>
    
    <div class="bg-white dark:bg-dark-800/70 shadow mx-auto px-2 py-3 relative">
        <div class="container mx-auto flex gap-3 md:gap-4 lg:gap-6 justify-between items-center flex-wrap">
            @include('layouts.partials._navbar')

            <div class="xl:hidden md:order-1">
                <x-button styling="light" class="!rounded-xl aspect-square w-11 h-11 !p-0 flex items-center justify-center" @click="toggleSearch">
                    <x-icons.search class="!w-5 !h-5" />
                    <span class="sr-only">{{ __('Show Search Bar') }}</span>
                </x-button>
            </div>
            
            {{-- Separator --}}
            <div class="flex-grow xl:hidden"></div>

            <div class="flex flex-row-reverse gap-2 md:gap-2.5 xl:flex-grow-0 order-2 items-center">
                @include('layouts.partials._user-menu')            
                
                <x-button styling="light" class="!rounded-xl aspect-square w-11 h-11 !p-0 hidden md:flex items-center justify-center" @click="toggleDarkMode">
                    <x-icons.moon class="!w-5 !h-5" x-cloak x-show="! darkMode"/>
                    <x-icons.sun class="!w-5 !h-5" x-cloak x-show="darkMode"/>
                    <span class="sr-only">{{ __('Toggle Dark Mode') }}</span>
                </x-button>

                <x-button styling="light" class="!rounded-xl aspect-square w-11 h-11 !p-0 flex items-center justify-center relative" @click="toggleSearch">
                    <x-icons.cart class="!w-5 !h-5" />
                    <span class="text-xs w-6 h-6 bg-primary-500 text-white rounded-full flex items-center justify-center absolute -top-2 ltr:-left-1 rtl:-right-1">10</span>
                    <span class="sr-only">{{ __('Shopping Cart') }}</span>
                </x-button>

                {{-- <div class="text-center " style="direction:ltr;">
                    <span class="md:hidden">xs</span>
                    <span class="hidden sm:inline md:hidden">sm</span>
                    <span class="hidden md:inline lg:hidden">md</span>
                    <span class="hidden lg:inline xl:hidden">lg</span>
                    <span class="hidden xl:inline 2xl:hidden">xl</span>
                    <span class="hidden 2xl:inline 3xl:hidden">2xl</span>
                </div> --}}
            </div>
            
            <div class="hidden xl:!flex flex-grow justify-center order-3 xl:order-1 w-full xl:w-auto" x-ref="search" x-bind:class="search === true ? '!flex' : ''">
                <livewire:search />
            </div>
        </div>
    </div>
</header>
<!-- End Header -->
