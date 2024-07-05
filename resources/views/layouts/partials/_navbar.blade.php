<div class="flex gap-2 items-center"
    x-data="{open: null}"
    x-trap.inert.noautofocus="open"
>
    <x-button styling="light-link" class="md:hidden !p-1.5" @click="open = !open">
        <x-icons.menu class="!w-7 !h-7" x-show="! open"/>
        <x-icons.close class="!w-7 !h-7" x-cloak x-show="open"/>
        <span class="sr-only">{{ __('Toggle Navbar') }}</span>
    </x-button>

    <!-- Logo -->
    <x-link href="{{ route('home') }}">
        <x-application-logo class="h-10" />
    </x-link>
    <!-- End Logo -->

    <nav class="px-4 sm:px-6 max-md:pb-6 max-md:bg-white max-md:dark:bg-dark-800 lg:ms-2 xl:ms-8 max-md:!absolute max-md:w-full top-full max-md:left-0 max-md:border-t dark:border-dark-700 max-md:pt-2 hidden md:!flex flex-col justify-between md:!h-auto overflow-auto gap-8"
        x-ref="nav"
        x-show.flex="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-50 -translate-x-full"
        x-transition:enter-end="transform opacity-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100"
        x-transition:leave-end="transform opacity-50 -translate-x-full"
        x-data="{
            setHeight () {
                $el.style.height = 'calc(100vh - ' + ($refs.header.getBoundingClientRect().height) + 'px - 4.5rem + 1px)';
            }
        }" 
        @resize.window="setHeight" 
        x-init="$el.classList.remove('hidden'); $el.classList.add('flex'); setHeight()">
        <div class="w-full md:container mx-auto md:flex">
            <x-dropdown dropdownClasses="max-md:max-h-max max-md:!relative w-full top-full left-0 max-md:shadow-none md:!rounded-none md:border-t border-primary-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-md:bg-primary-50 max-md:dark:bg-dark-700/50 md:!rounded-none" :openOnHover="true">
                <x-slot:trigger>
                    <div class="pb-1 flex flex-grow">
                        <x-link styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 max-md:py-4" href="#">
                            <span>{{ __('Blog') }}</span>
                            <x-icons.chevron-down class="!w-4 !h-4" />
                        </x-link>
                    </div>
                </x-slot>
    
                <x-slot:content>
                    <div class="md:overflow-auto">
                        <div class="z-50 flex flex-wrap max-md:flex-col gap-y-8 container mx-auto md:py-6">
                            @foreach (range(1, rand(4, 8)) as $item)
                                <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12">
                                    <x-dropdown.link href="#" class="text-base font-semibold">{{ fake()->sentence(4) }}</x-dropdown.link>
                                    @foreach (range(1, rand(2, 5)) as $item)
                                        <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ fake()->sentence(4) }}</x-dropdown.link>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
    
            <x-dropdown dropdownClasses="max-md:max-h-max max-md:!relative w-full top-full left-0 max-md:shadow-none md:!rounded-none md:border-t border-gray-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-md:bg-gray-50 max-md:dark:bg-dark-700/50 md:!rounded-none" :openOnHover="true">
                <x-slot:trigger>
                    <div class="pb-1 flex flex-grow">
                        <x-link styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 max-md:py-4" href="#">
                            <span>{{ __('Products') }}</span>
                            <x-icons.chevron-down class="!w-4 !h-4" />
                        </x-link>
                    </div>
                </x-slot>
    
                <x-slot:content>
                    <div class="md:overflow-auto">
                        <div class="z-50 flex flex-wrap max-md:flex-col gap-y-8 container mx-auto md:py-6">
                            @foreach (range(1, rand(4, 8)) as $item)
                                <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12">
                                    <x-dropdown.link href="#" class="text-base font-semibold">{{ fake()->sentence(4) }}</x-dropdown.link>
                                    @foreach (range(1, rand(2, 5)) as $item)
                                        <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ fake()->sentence(4) }}</x-dropdown.link>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
    
            <x-link styling="light-link" class="w-full max-md:py-4" href="#">{{ __('Projects') }}</x-link>

            <x-link styling="light-link" class="md:hidden w-full max-md:py-4" href="#">{{ __('About Us') }}</x-link>
            <x-link styling="light-link" class="md:hidden w-full max-md:py-4" href="#">{{ __('Contact') }}</x-link>
            <x-link styling="light-link" class="md:hidden w-full max-md:py-4" href="#">{{ __('FAQs') }}</x-link>
        </div>

        <div class="md:hidden">
        </div>
        
        
        <div class="md:hidden" x-cloak>
            @include('layouts.partials._topbar')
        </div>
    </nav>
</div>
