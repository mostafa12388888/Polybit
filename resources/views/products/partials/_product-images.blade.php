
<div class="w-full flex flex-col gap-3" x-data="{
    imageSource: '{{ asset('storage/product1.webp') }}',
    images: [
        {
            'thumb': '{{ asset('storage/product1.webp') }}',
            'full': '{{ asset('storage/product1.webp') }}',
        },
        {
            'thumb': '{{ asset('storage/product2.webp') }}',
            'full': '{{ asset('storage/product2.webp') }}',
        },
        {
            'thumb': '{{ asset('storage/product3.webp') }}',
            'full': '{{ asset('storage/product3.webp') }}',
        },
        {
            'thumb': '{{ asset('storage/product4.webp') }}',
            'full': '{{ asset('storage/product4.webp') }}',
        },
    ],
    initImageZoom () {
        if(typeof imageZoomObj != 'undefined') {
            imageZoomObj.kill()
        }
        
        setTimeout(() => {
            imageZoomObj = new ImageZoom(this.$el, {
                fillContainer: true,
                scale: 1.3,
                zoomStyle: 'border-radius: .375rem',
                zoomLensStyle: 'border-radius: .375rem; background: black; opacity: .1',
                offset: {vertical: 0, horizontal: 10},
            })
        }, 100);
    }
}">
    <div x-init="$watch('imageSource', () => initImageZoom()); $nextTick(() => initImageZoom())">
        <div class="overflow-hidden">
            <img class="sm:rounded-md" :src="imageSource" class="w-full" alt="">
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto mx-4 sm:mx-0">
        <template x-for="image in images">
            <button class="shrink-0 w-20 bg-gray-100 dark:bg-dark-400 !h-auto aspect-4/3 rounded overflow-hidden border border-dark-100 dark:border-dark-700"
                @click="imageSource = image.full">
                <img loading="lazy" x-bind:src="image.thumb" class="w-full h-full object-cover" alt="">
            </button>
        </template>
    </div>
</div>