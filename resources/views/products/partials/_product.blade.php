<x-link :href="request()->is('product-store') ? route('products.show.store', $product) : route('products.show', $product)"
    class="flex-grow group flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none shadow !rounded-md overflow-hidden w-full">
    <div class="relative">
        <x-curator-glider fallback="logo" :media="$product->image" format="webp" width="480" height="280" fit="contain"
            quality="70" class="w-full aspect-video object-contain bg-white" :alt="$product->name"
            loading="{{ $lazy ?? null ? 'lazy' : 'eager' }}" />

        @if ($product->tags->count() == 1)
            <span
                class="text-sm px-3 py-1 rounded text-white bg-secondary-500 dark:bg-secondary-600 absolute top-4 rtl:right-3 ltr:left-3">
                {{ $product->tags->first()->name }}
            </span>
        @elseif($product->tags->count())
            <span
                class="text-sm px-3 py-1 rounded text-white bg-secondary-500 dark:bg-secondary-600 absolute top-4 rtl:right-3 ltr:left-3"
                x-data="{
                    tags: {{ $product->tags->pluck('name')->toJson() }},
                    currentIndex: 0,
                    show: true
                }" x-init="setInterval(() => {
                    show = false;
                    setTimeout(() => {
                        currentIndex = (currentIndex + 1) % tags.length;
                        show = true;
                    }, 300);
                }, 3000)" x-text="tags[currentIndex]" x-show="show"
                x-transition.opacity.duration.300ms>
            </span>
        @endif

        <div
            class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60  flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>

    <div class="flex flex-col gap-2 px-6 py-6">
        @if ($product->price)
            <div class="flex gap-3 items-baseline">
                <p class="font-semibold truncate text-2xl">{{ Number::format($product->price) }} <span
                        class="text-base">{{ __('E£') }}</span></p>

                @if ($product->price_before_discount && $product->price_before_discount > $product->price)
                    <p class="line-through">{{ Number::format($product->price_before_discount) }} {{ __('E£') }}
                    </p>
                @endif
            </div>
        @endif

        <h2 class="font-semibold truncate text-lg">{{ $product->name }}</h2>

        <h3>{{ $product->category?->name }}</h3>
    </div>
</x-link>
