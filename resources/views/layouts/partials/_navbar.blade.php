<div class="flex gap-2 items-center"
    x-data="{open: null}"
    x-trap.inert.noautofocus.noscroll="open"
>
    <x-button styling="light-link" class="md:hidden !p-1.5" @click="open = !open">
        <x-icons.menu class="!w-7 !h-7" x-cloak x-show="! open"/>
        <x-icons.close class="!w-7 !h-7" x-cloak x-show="open"/>
    </x-button>

    <!-- Logo -->
    <x-link href="{{ route('home') }}">
        <x-application-logo class="h-10" />
    </x-link>
    <!-- End Logo -->

    <nav class="px-2 max-md:bg-white max-md:dark:bg-dark-800 lg:ms-2 xl:ms-8 max-md:!absolute max-md:w-full top-full max-md:left-0 max-md:border-t dark:border-dark-700 max-md:pt-2 flex md:!flex flex-col justify-between md:!h-auto overflow-auto gap-8" x-cloak
        x-ref="nav"
        x-show.flex="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100"
            x-transition:leave-end="transform opacity-0"
        x-data="{
            setHeight () {
                $el.style.height = 'calc(100vh - ' + ($refs.header.getBoundingClientRect().height) + 'px)';
            }
        }" @resize.window="setHeight" x-init="setHeight">
        <div class="w-full md:container mx-auto md:flex">
            <x-dropdown dropdownClasses="max-md:max-h-max max-md:!relative w-full top-full left-0 max-md:shadow-none md:!rounded-none md:border-t border-gray-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-md:bg-gray-50 max-md:dark:bg-dark-700/50 md:!rounded-none" :openOnHover="true">
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
                        <div class="z-50 flex flex-wrap max-md:flex-col gap-y-4 container mx-auto md:py-6">
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
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
                        <div class="z-50 flex flex-wrap max-md:flex-col gap-y-4 container mx-auto md:py-6">
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
        
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
    
            <x-link styling="light-link" class="w-full max-md:py-4" href="#">{{ __('Projects') }}</x-link>
        </div>

        <div class="md:hidden" x-cloak>
            @include('layouts.partials._topbar')
        </div>
    </nav>
</div>
