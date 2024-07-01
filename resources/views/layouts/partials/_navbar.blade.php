<div class="flex gap-2 items-center">
    <!-- Logo -->
    <x-link href="{{ route('home') }}">
        <x-application-logo class="h-10" />
    </x-link>
    <!-- End Logo -->

    <nav class="px-2 max-md:bg-white max-md:dark:bg-dark-800 lg:ms-2 xl:ms-8 max-md:!absolute max-md:w-full top-full max-md:left-0 max-sm:border-t dark:border-dark-700 max-sm:pt-2" x-ref="nav">
        <div class="container mx-auto flex max-sm:flex-col">
            <x-dropdown align="top" dropdownClasses="max-sm:!relative w-full top-full left-0 max-sm:shadow-none sm:!rounded-none sm:border-t border-gray-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-sm:bg-gray-50 max-sm:dark:bg-dark-700/50 sm:!rounded-none" :openOnHover="true">
                <x-slot:trigger>
                    <div class="pb-1 flex flex-grow">
                        <x-link styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 max-sm:py-4" href="#">
                            <span>{{ __('Blog') }}</span>
                            <x-icons.chevron-down class="!w-4 !h-4" />
                        </x-link>
                    </div>
                </x-slot>
    
                <x-slot:content>
                    <div class="overflow-auto" x-data="{
                        setHeight () {
                            $el.style.maxHeight = 'calc(100vh - ' + ($refs.nav.getBoundingClientRect().top + $refs.nav.offsetHeight + 10) + 'px)';
                        }
                    }" @resize.window="setHeight" x-init="setHeight">
                        <div class="z-50 flex flex-wrap max-sm:flex-col gap-y-4 container mx-auto md:py-6">
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="#" class="font-semibold">{{ __('Blog Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="#" class="pl-8 rtl:pl-8">{{ __('Blog Sub Category') }}</x-dropdown.link>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
    
            <x-dropdown align="top" dropdownClasses="max-sm:!relative w-full top-full left-0 max-sm:shadow-none sm:!rounded-none sm:border-t border-gray-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-sm:bg-gray-50 max-sm:dark:bg-dark-700/50 sm:!rounded-none" :openOnHover="true">
                <x-slot:trigger>
                    <div class="pb-1 flex flex-grow">
                        <x-link styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 max-sm:py-4" href="#">
                            <span>{{ __('Products') }}</span>
                            <x-icons.chevron-down class="!w-4 !h-4" />
                        </x-link>
                    </div>
                </x-slot>
    
                <x-slot:content>
                    <div class="overflow-auto" x-data="{
                        setHeight () {
                            $el.style.maxHeight = 'calc(100vh - ' + ($refs.nav.getBoundingClientRect().top + $refs.nav.offsetHeight + 10) + 'px)';
                        }
                    }" @resize.window="setHeight" x-init="setHeight">
                        <div class="z-50 flex flex-wrap max-sm:flex-col gap-y-4 container mx-auto md:py-6">
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
                            </div>
        
                            <div class="flex flex-col w-full md:w-6/12 lg:w-4/12 xl:w-3/12 2xl:w-2/12">
                                <x-dropdown.link href="" class="font-semibold">{{ __('Product Category') }}</x-dropdown.link>
                                <x-dropdown.link href="" class="pl-8 rtl:pl-8">{{ __('Product Sub Category') }}</x-dropdown.link>
        
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
    
            <x-link styling="light-link" class="md:hidden xl:inline max-sm:py-4" class="mb-1" href="#">{{ __('Projects') }}</x-link>


            {{-- @include('layouts.partials._topbar') --}}
        </div>
    </nav>
</div>
