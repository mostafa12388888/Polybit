<div class="flex max-md:gap-2 items-center"
    x-data="{open: null}"
    x-trap.inert.noautofocus="open"
>
    <x-button styling="light-link" class="md:hidden !p-1" @click="open = !open">
        <x-icons.menu class="!w-9 !h-9" stroke-width="1.8" x-show="! open"/>
        <x-icons.close class="!w-9 !h-9" stroke-width="1" x-cloak x-show="open"/>
        <span class="sr-only">{{ __('Toggle Navbar') }}</span>
    </x-button>

    <x-link href="{{ route('home') }}" class="max-h-16 overflow-hidden">
        <x-application-logo class="h-11" :width="160" />
    </x-link>

    <nav class="px-4 sm:px-6 max-md:pb-6 max-md:bg-white max-md:dark:bg-dark-800 lg:ms-2 xl:ms-8 max-md:!absolute max-md:w-full top-full max-md:left-0 max-md:border-t dark:border-dark-700 max-md:pt-2 hidden md:!flex flex-col justify-between md:!h-auto overflow-auto gap-8"
        x-ref="nav"
        x-show.flex="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-50 ltr:-translate-x-full rtl:translate-x-full"
        x-transition:enter-end="transform opacity-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100"
        x-transition:leave-end="transform opacity-50 ltr:-translate-x-full rtl:translate-x-full"
        x-data="{
            setHeight () {
                offset = $refs.header.getBoundingClientRect().height + $refs.bottomNavbar.getBoundingClientRect().height - 1;
                $el.style.height = 'calc(100vh - ' + offset + 'px)';
            }
        }"
        @resize.window="setHeight"
        x-init="$el.classList.remove('hidden'); $el.classList.add('flex'); setHeight()">

        <div class="w-full md:container mx-auto md:flex md:items-center">
            @if ($store_categories->count())
                <x-dropdown dropdownClasses="max-md:max-h-max max-md:!relative w-full top-full left-0 max-md:shadow-none md:!rounded-none md:border-t border-secondary-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-md:bg-secondary-50 max-md:dark:bg-dark-700/50 md:!rounded-none" :openOnHover="true">
                    <x-slot:trigger>
                        <div class="max-sm:pb-1 flex flex-grow">
                            <x-link :navigate="false" styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 max-md:py-3" @click.prevent="" :href="route('products.index')">
                                <span>{{ __('Products') }}</span>
                                <x-icons.chevron-down class="!w-4 !h-4" />
                            </x-link>
                        </div>
                    </x-slot>

                    <x-slot:content>
                        <div class="md:overflow-auto">
                            <div class="z-50 flex flex-wrap max-md:flex-col gap-y-2 lg:gap-y-8 container mx-auto md:py-6">
                                @foreach ($store_categories as $store_category)
                                    <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12">
                                        <x-dropdown.link :href="route('store-categories.show', $store_category)" class="text-base font-semibold">{{ $store_category->name }}</x-dropdown.link>

                                        @foreach ($store_category->sub_categories as $sub_category)
                                            <x-dropdown.link :href="route('store-categories.show', $sub_category)" class="pl-8 rtl:pl-8">{{ $sub_category->name }}</x-dropdown.link>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            @else
                <x-link styling="light-link" class="w-full max-md:py-3 md:hidden lg:inline" :href="route('products.index')">{{ __('Products') }}</x-link>
            @endif

            <x-link styling="light-link" class="w-full max-md:py-3 md:hidden lg:inline" :href="route('projects.index')">{{ __('Projects') }}</x-link>

            @foreach ($pages->filter(fn ($page) => $page->is_visible_in_top_navbar || $page->is_visible_in_main_navbar) as $page)
                @if ($page->is_visible_in_main_navbar)
                    <x-link styling="light-link" class="w-full max-md:py-3 md:hidden lg:inline whitespace-nowrap" :href="route('pages.show', $page)">{{ $page->title }}</x-link>
                @else
                    <x-link styling="light-link" class="w-full max-md:py-3 md:hidden whitespace-nowrap" :href="route('pages.show', $page)">{{ $page->title }}</x-link>
                @endif
            @endforeach

            @if ($catalogs_count)
                <x-link styling="light-link" class="w-full max-md:py-3 md:hidden lg:inline" :href="route('catalogs.index')">{{ __('Catalogs') }}</x-link>
            @endif

            <x-link styling="light-link" class="md:hidden w-full max-md:py-3" :href="route('contact-us')">{{ __('Contact') }}</x-link>
            <x-link styling="light-link" class="md:hidden w-full max-md:py-3" :href="route('faq')">{{ __('FAQ') }}</x-link>

            @if ($blog_categories->count())
                <x-dropdown dropdownClasses="max-md:max-h-max max-md:!relative w-full top-full left-0 max-md:shadow-none md:!rounded-none md:border-t border-primary-200 dark:border-dark-600" wrapperClasses="" contentClasses="max-md:bg-secondary-50 max-md:dark:bg-dark-700/50 md:!rounded-none" :openOnHover="true">
                    <x-slot:trigger>
                        <div class="max-sm:pb-1 flex flex-grow">
                            <x-link :navigate="false" styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 max-md:py-3" @click.prevent="" :href="route('posts.index')">
                                <span>{{ __('Blog') }}</span>
                                <x-icons.chevron-down class="!w-4 !h-4" />
                            </x-link>
                        </div>
                    </x-slot>

                    <x-slot:content>
                        <div class="md:overflow-auto">
                            <div class="z-50 flex flex-wrap max-md:flex-col gap-y-2 lg:gap-y-8 container mx-auto md:py-6">
                                @foreach ($blog_categories as $blog_category)
                                    <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12">
                                        <x-dropdown.link :href="route('blog-categories.show', $blog_category)" class="text-base font-semibold">{{ $blog_category->name }}</x-dropdown.link>

                                        @foreach ($blog_category->sub_categories as $sub_category)
                                            <x-dropdown.link :href="route('blog-categories.show', $sub_category)" class="pl-8 rtl:pl-8">{{ $sub_category->name }}</x-dropdown.link>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            @else
                <x-link styling="light-link" class="w-full max-md:py-3 md:hidden lg:inline" :href="route('posts.index')">{{ __('Blog') }}</x-link>
            @endif
        </div>

        {{-- <div class="md:hidden" x-cloak>
            @include('layouts.partials._topbar')
        </div> --}}
    </nav>
</div>
