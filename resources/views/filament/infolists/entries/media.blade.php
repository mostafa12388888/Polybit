@php
    $files = $getRecord()->media();
    
    if($type ?? null) {
        $files = $files->where('media_items.type', $type);
    }

    $files = $files->get();
@endphp

<div class="grid gap-y-4">
    @if ($files->count())
        <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">{{ $getLabel() }}</span>
        </dt>
        
        <div class="flex flex-wrap gap-1.5">
            @foreach ($files as $media)
                <x-filament-lightbox::lightbox-wrapper
                    parentEntryWrapper="filament-infolists::entry-wrapper"
                    :href="$media->getSignedUrl()"
                    :zoomable="true"
                    :draggable="true"
                >
                    <x-curator-glider :media="$media" {{ $attributes->merge(['class' => 'rounded']) }} 
                        format="webp" width="128" height="128" crop="cover" fit="crop" border="1"
                    />
                </x-filament-lightbox::lightbox-wrapper>
            @endforeach
        </div>
    @endif
</div>
