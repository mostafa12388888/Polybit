<!-- TopBar -->
<div class="bg-gray-200 dark:bg-dark-900 px-2 text-[.7rem] tracking-wider max-sm:hidden">
    <nav class="container mx-auto flex flex-wrap items-center justify-between">
        <div class="flex flex-wrap gap-4">
            <x-link styling="link" class="!py-1" href="#">{{ __('About us') }}</x-link>
            <x-link styling="link" class="!py-1" href="#">{{ __('Contact') }}</x-link>
        </div>
        
        <div class="flex flex-wrap items-center flex-row-reverse gap-4">
            <x-dropdown align="end" dropdownClasses="w-full sm:w-40" wrapperClasses="sm:relative" :openOnHover="true">
                <x-slot:trigger>
                    <x-button styling="link" class="!p-0 flex flex-row-reverse gap-1 items-center justify-center">
                        <x-icons.globe stroke-width="1" class="!w-5 !h-5" />
                        <span>{{ request()->dir == 'rtl' ? 'العربية' : 'English' }}</span>
                    </x-button>
                </x-slot>

                <x-slot:content>
                    <x-dropdown.link styling="link" href="{{ request()->url() }}?dir=rtl">
                        <img class="w-6 h-4" src="https://flagpedia.net/data/flags/h24/eg.webp">
                        <span>العربية</span>
                    </x-link>
                    <x-dropdown.link styling="link" href="{{ request()->url() }}">
                        <img class="w-6 h-4" src="https://flagpedia.net/data/flags/h24/us.webp">
                        <span>English</span>
                    </x-link>
                </x-slot>
            </x-dropdown>

            <x-link styling="link" class="!py-1 flex items-center gap-1.5 flex-row-reverse" href="#">
                <x-icons.phone class="!w-4 !h-4" stroke-width="1" />
                <span dir="ltr">+201068977712</span>
            </x-link>
            <x-link styling="link" class="!py-1 flex items-center gap-1.5 flex-row-reverse" href="#">
                <x-icons.envelope class="!w-4 !h-4" stroke-width="1" />
                <span dir="ltr">info@ichemeg.com</span>
            </x-link>
        </div>
    </nav>
</div>
<!-- End TopBar -->
