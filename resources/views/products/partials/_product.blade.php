<x-link href="{{ route('products.show', $product) }}" class="flex-grow group flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none shadow !rounded-md overflow-hidden w-full">
    <div class="relative">
        <x-curator-glider fallback="logo" :media="$product->image" format="webp" width="480" height="280" fit="fill-max" quality="70" class="w-full aspect-video object-cover" :alt="$product->name" />

        <div class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60  flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>
    
    <div class="flex flex-col gap-2 px-6 py-6">
        @if ($product->price)
            <div class="flex gap-3 items-baseline">
                <p class="font-semibold truncate text-2xl">{{ Number::format($product->price) }} <span class="text-base">{{ __('E£') }}</span></p>

                @if ($product->price_before_discount && $product->price_before_discount > $product->price)
                    <p class="line-through">{{ Number::format($product->price_before_discount) }} {{ __('E£') }}</p>
                @endif
            </div>
        @endif
        
        <h5 class=" truncate lg:text-lg">{{ $product->name }}</h5>
    </div>
        
    {{-- <x-button styling="light" class="flex gap-2 dark:bg-dark-700 justify-center rounded-none py-4">
        <x-icons.cart class="!w-5 !h-5" stroke-width="1.5" />
        <span>{{ __('Add to cart') }}</span>
    </x-button> --}}
</x-link>