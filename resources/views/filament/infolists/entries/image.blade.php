<div class="grid gap-y-4">
    <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">{{ $getLabel() }}</span>
    </dt>
    
    <div class="flex flex-wrap gap-1.5">
        <x-filament-lightbox::lightbox-wrapper
            parentEntryWrapper="filament-infolists::entry-wrapper"
            :href="$getState()['image']"
        >
            <img src="{{ $getState()['thumbnail'] }}" class="{{ $getState()['classes'] }}">
        </x-filament-lightbox::lightbox-wrapper>
    </div>
</div>
