<!-- Search Form -->
<div class="relative flex-grow w-full">
    <div class="flex gap-2">
        <div class="flex flex-grow relative">
            <input id="search" type="search" name="search" placeholder="{{ __('Search...') }}" {!! $attributes->merge(['class' => 'flex-grow p-3 bg-secondary-100 dark:bg-dark-700 border-secondary-100 dark:border-dark-700 focus:bg-secondary-200/70 dark:focus:brightness-95 focus:border-transparent focus:ring-0 w-full rounded-lg pl-12 rtl:pl-3 rtl:pr-12']) !!} autocomplete="off">

            <button class="absolute top-[0.85rem] left-4 rtl:left-auto rtl:right-4 outline-none cursor-pointer text-primary-500 hover:text-primary-700 focus:text-primary-700 dark:text-dark-300">
                <x-icons.search class="!w-5 !h-5"/>
                <span class="sr-only">{{ __('Search') }}</span>
            </button>
        </div>
    </div>
</div>
<!-- End Seach Form -->