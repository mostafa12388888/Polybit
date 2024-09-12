@php($images = $product->images)

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
        @foreach($product->embeded_urls ?? [] as $url)
            {
                'thumb': '3d',
                'full': '{{ $url }}',
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
            <template x-if="activeImage.thumb == '3d'">
                <iframe x-bind:src="activeImage.full" frameborder="0" title="3d {{ $product->name }}" class="w-full aspect-[4/3]"></iframe>
            </template>
            <template x-if="activeImage.thumb != '3d'">
                <x-img class="w-full sm:rounded-md min-h-72" src="{!! $product->image?->getSignedUrl(['w' => 720, 'q' => 70]) !!}" fetchpriority="high" x-bind:src="activeImage.full" x-bind:alt="activeImage.alt" width="720" height="480" />
            </template>
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto mx-4 sm:mx-0">
        <template x-for="image in images">
            <button class="shrink-0 w-20 !h-auto aspect-4/3 rounded overflow-hidden border border-secondary-100 bg-secondary-50 dark:border-dark-700 p-0.5"
            @click="activeImage = image"
            x-bind:class="{'!border-secondary-400 dark:!border-secondary-400 dark:border-2': activeImage.full == image.full}">
                <template x-if="image.thumb == '3d'">
                    <x-icons.cube class="!w-9 !h-9 text-secondary-600 dark:text-secondary-200" stroke-width="1" />
                </template>
                <template x-if="image.thumb != '3d'">
                    <x-img loading="lazy" x-bind:src="image.thumb" class="w-full h-full object-cover rounded" width="80" height="80" x-bind:alt="image.alt" />
                </template>
            </button>
        </template>
    </div>
</div>