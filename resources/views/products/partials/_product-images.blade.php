@php
    $images = $product->images;
    $embeded_urls = $product->embeded_urls ?? [];
    $images_count = count($images) + count($embeded_urls);

    if(! $images_count) {
        return;
    }

    $first_image = $product->image ? [
        'url' => $product->image?->getSignedUrl(['w' => 720, 'q' => 70]),
        'type' => 'image',
    ] : [
        'url' => collect($embeded_urls)->first(),
        'type' => '3d',
    ];
@endphp

<div class="w-full flex flex-col gap-3" x-data="{
    activeImage: null,
    images: [
        @foreach([$images->shift()] as $image)
            {
                'thumb': '{{ $image->getSignedUrl(['w' => 80, 'h' => 80, 'fit' => 'crop', 'q' => 70]) }}',
                'full': '{{ $image->getSignedUrl(['w' => 720, 'q' => 70]) }}',
                'alt': '{{ $image->alt ?? $product->name }}',
            },
        @endforeach
        @foreach($embeded_urls as $i => $url)
            {
                'thumb': '3d',
                'full': '{{ $url }}#{{ ++$i }}',
            },
        @endforeach
        @foreach($images as $image)
            {
                'thumb': '{{ $image->getSignedUrl(['w' => 80, 'h' => 80, 'fit' => 'crop', 'q' => 70]) }}',
                'full': '{{ $image->getSignedUrl(['w' => 720, 'q' => 70]) }}',
                'alt': '{{ $image->alt ?? $product->name }}',
            },
        @endforeach
    ]
}" x-init="activeImage = images[0]">
    <div>
        <div class="overflow-hidden">
            <iframe {{ $first_image['type'] == '3d' ? '' : 'x-cloak' }} x-show="activeImage.thumb == '3d'" src="{!! $first_image['url'] !!}" x-bind:src="activeImage.full" frameborder="0" title="3d {{ $product->name }}" class="w-full aspect-[4/3]"></iframe>
            <img {{ $first_image['type'] == '3d' ? 'x-cloak' : '' }} x-show="activeImage.thumb != '3d'" src="{!! $first_image['url'] !!}" fetchpriority="high" x-bind:src="activeImage.full" x-bind:alt="activeImage.alt" width="720" height="480" class="w-full sm:rounded-md" />
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto mx-4 sm:mx-0">
        @for ($i = 0; $i < $images_count; $i++)
            <div x-init="$el.remove()" class="shrink-0 w-20 aspect-square rounded overflow-hidden border border-secondary-100 bg-secondary-50 dark:bg-dark-700 dark:border-dark-700 p-0.5"></div>
        @endfor

        <template x-for="image in images">
            <button class="shrink-0 w-20 !h-auto aspect-square rounded overflow-hidden border border-secondary-100 bg-secondary-50 dark:bg-dark-700 dark:border-dark-700 p-0.5"
            @click="activeImage = image"
            x-bind:class="{'!border-secondary-400 dark:!border-secondary-400 dark:border-2': activeImage.full == image.full}">
                <template x-if="image.thumb == '3d'">
                    <div>
                        <x-icons.cube class="!w-9 !h-9 text-secondary-600 dark:text-secondary-200" stroke-width="1" />
                        <span class="sr-only">3d object</span>
                    </div>
                </template>
                <template x-if="image.thumb != '3d'">
                    <x-img loading="lazy" x-bind:src="image.thumb" class="w-full h-full object-cover rounded" width="80" height="80" x-bind:alt="image.alt" />
                </template>
            </button>
        </template>
    </div>
</div>