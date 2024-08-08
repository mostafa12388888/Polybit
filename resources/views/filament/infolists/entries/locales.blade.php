@php
    $locales = collect(locales(false))->whereIn('code', $getRecord()->locales())
@endphp

<div class="grid gap-y-2">
    <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">{{ $getLabel() }}</span>
    </dt>
    
    <div class="flex flex-wrap gap-1.5">
        @foreach ($locales as $locale)
            <div class="text-xs leading-6 text-gray-950 dark:text-white fi-contained rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 px-2">{{ $locale['name'] }}</div>
        @endforeach
    </div>
</div>
