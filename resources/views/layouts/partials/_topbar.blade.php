<!-- TopBar -->
<div class="md:bg-primary-200/50 md:dark:bg-dark-900 px-4 md:px-6 mt-2 md:mt-0 md:text-[.75rem]">
    <nav class="container mx-auto flex flex-col md:flex-row flex-wrap md:items-center justify-between gap-4">
        <div class="max-md:hidden dark:border-dark-700 p-4 md:p-0 flex flex-wrap items-center justify-center gap-4">
            @if ($pages->count())
                <x-link class="!py-1" :href="route('pages.show', $pages->first())">{{ $pages->first()->title }}</x-link>
            @endif
            <x-link class="!py-1" :href="route('contact-us')">{{ __('Contact') }}</x-link>
        </div>
        
        <div class="flex flex-wrap md:items-center flex-col md:flex-row-reverse gap-4">
            <div class="max-md:order-1 max-md:-mx-4">
                <div class="flex max-md:flex-grow gap-2 mb-4 md:hidden">
                    <x-button styling="light" class="flex flex-grow items-center justify-center gap-1.5 py-3 opacity-80"
                        x-bind:class="{'!bg-primary-500 !text-white !opacity-100': ! darkMode}"
                        @click="toggleDarkMode(false)">
                        <x-icons.sun class="!w-5 !h-5" />
                        <span>Light Mode</span>
                    </x-button>

                    <x-button styling="light" class="flex flex-grow items-center justify-center gap-1.5 py-3 opacity-80"
                        x-bind:class="{'dark:!bg-primary-500 dark:!text-white !opacity-100': darkMode}"
                        @click="toggleDarkMode(true)">
                        <x-icons.moon class="!w-5 !h-5"/>
                        <span>Dark Mode</span>
                    </x-button>
                </div>

                <x-dropdown dropdownClasses="w-full md:w-40 max-md:!relative pt-2" wrapperClasses="md:relative" :openOnHover="true">
                    <x-slot:trigger>                        
                        <div class="flex max-md:flex-grow">
                            <x-button styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 py-4 md:!bg-transparent md:p-0">
                                <div class="!p-0 flex-grow flex md:flex-row-reverse gap-1 items-center">
                                    <x-icons.globe-africa stroke-width="1" class="!w-5 !h-5" />
                                    <span>{{ locales()[app()->getLocale()] ?? '' }}</span>
                                </div>
                                
                                <x-icons.chevron-down class="md:hidden !w-4 !h-4" />
                            </x-button>
                        </div>
                    </x-slot>
    
                    <x-slot:content>
                        @foreach (locales(false) as $locale)
                            <x-dropdown.link :navigate="false" class="py-4" href="{{ localized_url($locale['code']) }}">
                                <x-img loading="lazy" class="w-6 h-4" width="24" height="16" src="https://flagpedia.net/data/flags/h24/{{ $locale['flag'] }}.webp" />
                                <span>{{ $locale['name'] }}</span>
                            </x-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
            </div>

            @if ($phone = collect(setting('phones') ?: [])->first())
                <x-link class="!py-1 hidden md:flex items-center gap-1.5 md:flex-row-reverse max-md:order-2" href="tel:{{ $phone }}">
                    <x-icons.phone class="!w-4 !h-4" stroke-width="1" />
                    <span dir="ltr">{{ $phone }}</span>
                </x-link>
            @endif
            
            @if ($email = collect(setting('emails') ?: [])->first())
                <x-link class="!py-1 hidden md:flex items-center gap-1.5 md:flex-row-reverse max-md:order-3" href="mail:{{ $email }}">
                    <x-icons.envelope class="!w-4 !h-4" stroke-width="1" />
                    <span dir="ltr">{{ $email }}</span>
                </x-link>
            @endif
        </div>
    </nav>
</div>
<!-- End TopBar -->
