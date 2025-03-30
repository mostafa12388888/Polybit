<div class="flex-grow group flex max-sm:flex-col gap-6 text-start items-center !p-0 shadow-none overflow-hidden" >
    <div class="relative max-sm:w-full flex-shrink-0 overflow-hidden">
        <x-curator-glider fallback="logo" :media="$catalog->image" format="webp" width="320" fit="contain" quality="70" class="rounded-md max-w-56 w-full sm:w-40 object-cover bg-white" :alt="$catalog->title" loading="{{ ($lazy ?? null) ? 'lazy' : 'eager' }}" />
    </div>

    <div class="w-full flex-grow flex flex-col gap-5">
        <div class="flex flex-col gap-3">
            <h2 class="font-semibold line-clamp-2 text-xl xl:text-xl">{{ $catalog->title }}</h2>
            <p class="font-light line-clamp-4">{{ str()->limit(text($catalog->description), 350) }}</p>
        </div>
        
        <x-link :href="route('catalogs.show', $catalog)" styling="link" class="sm:max-w-sm text-center !px-4 !py-2 border dark:border-dark-700">{{ __('View catalog') }}</x-link>
    </div>
</div>
