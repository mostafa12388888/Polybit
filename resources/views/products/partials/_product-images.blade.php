
<div class="w-full flex flex-col gap-3" x-data="{
    activeImage: null,
    images: [
        @foreach($product->images as $image)
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
            <x-img class="w-full sm:rounded-md min-h-72" src="{!! $product->image?->getSignedUrl(['w' => 720, 'q' => 70]) !!}" fetchpriority="high" x-bind:src="activeImage.full" x-bind:alt="activeImage.alt" width="720" height="480" />
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto mx-4 sm:mx-0">
        <template x-for="image in images">
            <button class="shrink-0 w-20 !h-auto aspect-4/3 rounded overflow-hidden border dark:border-2 border-dark-100 dark:border-dark-800 p-0.5"
                @click="activeImage = image"
                x-bind:class="{'!border-dark-200 dark:!border-dark-600': activeImage.full == image.full}">
                <x-img loading="lazy" x-bind:src="image.thumb" class="w-full h-full object-cover rounded" width="80" height="80" x-bind:alt="image.alt" />
            </button>
        </template>
    </div>
</div>