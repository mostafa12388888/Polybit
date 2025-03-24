@if ($media)
    @if (str($media->type)->contains('image'))
        <img
            src="{{ $source }}"
            @if ($media->alt)
                alt="{{ $media->alt }}"
            @endif
            @if ($media->title ?? null)
                title="{{ $media->title }}"
            @endif
            @if ($width && $height)
                width="{{ $width }}"
                height="{{ $height }}"
            @else
                width="{{ $media->width }}"
                height="{{ $media->height }}"
            @endif
            @if ($sourceSet)
                srcset="{{ $sourceSet }}"
                sizes="{{ $sizes }}"
            @endif
            {{ $attributes->merge(['loading' => 'lazy'])->filter(fn ($attr) => $attr !== '') }}
        />
    @else
        <x-curator::document-image
            label="{{ $media->name }}"
            icon-size="xl"
            {{ $attributes->merge(['class' => 'p-4']) }}
        />
    @endif
@endif
