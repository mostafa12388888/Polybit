<!-- TopBar -->
<div class="md:bg-secondary-200/50 md:dark:bg-dark-900 px-4 md:px-6 mt-2 md:mt-0 md:text-[.75rem]">
    <nav class="container mx-auto flex flex-col md:flex-row flex-wrap md:items-center justify-between gap-4">
        <div class="max-md:hidden dark:border-dark-700 p-4 md:p-0 flex flex-wrap items-center justify-center gap-4">
            @foreach ($pages->where('is_visible_in_top_navbar') as $page)
                <x-link class="!py-1" :href="route('pages.show', $page)">{{ $page->title }}</x-link>
            @endforeach
            
            <x-link class="!py-1" :href="route('contact-us')">{{ __('Contact') }}</x-link>
        </div>
        
        <div class="flex flex-wrap md:items-center flex-col md:flex-row-reverse gap-4">
            <div class="max-md:order-1 max-md:-mx-4">
                <div class="flex max-md:flex-grow gap-2 mb-4 md:hidden">
                    <x-button styling="light" class="flex flex-grow items-center justify-center gap-1.5 py-3 opacity-80"
                        x-bind:class="{'!bg-secondary-500 !text-white !opacity-100': ! darkMode}"
                        @click="toggleDarkMode(false)">
                        <x-icons.sun class="!w-5 !h-5" />
                        <span>Light Mode</span>
                    </x-button>

                    <x-button styling="light" class="flex flex-grow items-center justify-center gap-1.5 py-3 opacity-80"
                        x-bind:class="{'dark:!bg-secondary-500 dark:!text-white !opacity-100': darkMode}"
                        @click="toggleDarkMode(true)">
                        <x-icons.moon class="!w-5 !h-5"/>
                        <span>Dark Mode</span>
                    </x-button>
                </div>
                    
                <div class="flex max-md:flex-grow gap-4">
                    @forelse ($alternate_locales as $alternate_locale)
                        @php($alternate_locale = collect(locales(false))->where('code', $alternate_locale)->first())

                        <x-link href="{{ localized_url($alternate_locale['code']) }}" styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 py-4 md:!bg-transparent md:p-0">
                            <div class="!p-0 flex-grow flex md:flex-row-reverse gap-1 items-center">
                                <x-icons.globe-africa stroke-width="1" class="!w-5 !h-5" />
                                <span>{{ $alternate_locale['name'] ?? '' }}</span>
                            </div>
                            
                            <x-icons.chevron-down class="md:hidden !w-4 !h-4" />
                        </x-link>
                    @empty
                        @if ($locale)
                            <x-link href="{{ localized_url($locale['code'], $fallback_alternate_url ?? url('/')) }}" styling="light-link" class="flex flex-grow items-center justify-between gap-1.5 py-4 md:!bg-transparent md:p-0">
                                <div class="!p-0 flex-grow flex md:flex-row-reverse gap-1 items-center">
                                    <x-icons.globe-africa stroke-width="1" class="!w-5 !h-5" />
                                    <span>{{ $locale['name'] ?? '' }}</span>
                                </div>
                                
                                <x-icons.chevron-down class="md:hidden !w-4 !h-4" />
                            </x-link>
                        @endif
                    @endforelse
                </div>
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
