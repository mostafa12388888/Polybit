<section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 sm:p-4 md:px-4 md:py-8 lg:py-12 relative">
    <div class="container mx-auto flex flex-col xl:flex-row gap-4">
        @if ($wishlist_items->count())
            <div class="bg-white dark:bg-dark-700/60 px-4 py-4 md:px-6 xl:px-8 sm:rounded-md dark:border-dark-700 flex flex-col w-full xl:w-8/12 2xl:w-9/12 divide-y">
                @foreach ($wishlist_items as $product)
                    <div class="flex gap-2 sm:gap-4 items-center justify-between py-4 border-dashed border-dark-200/70 dark:border-dark-700" wire:key="item-{{ $product->index }}">
                        <x-link :href="route('products.show', $product)" class="align-middle shrink-0">
                            <x-curator-glider fallback="logo" :media="$product->image" format="webp" width="480" height="280" fit="contain" quality="70" class="w-14 h-14 sm:w-16 sm:h-16 rounded-md object-cover bg-white" :alt="$product->name" />
                        </x-link>
                        
                        <x-link :href="route('products.show', $product)" class="align-middle flex-grow flex flex-col gap-1">
                            <h3 class="line-clamp-3">{{ $product->name }}</h3>
                            
                            @if ($product->category)
                                <h4 class="line-clamp-3 text-sm">{{ $product->category?->name }}</h4>
                            @endif
                        </x-link>

                        <div class="table-cell align-middle">
                            <div class="flex justify-end">
                                <x-button styling="light" class="flex items-center gap-2 !p-3" wire:click="remove_item({{ $product->index }})" 
                                    wire:target="remove_item({{ $product->index }})" wire:loading.attr="disabled">
                                    <x-icons.close class="!w-5 !h-5" />
                                    <span class="text-sm hidden sm:inline">{{ __('Remove') }}</span>
                                    <x-spinner wire:target="remove_item({{ $product->index }})" wire:loading class="!w-4 !h-4" />
                                </x-button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-dark-700/60 px-4 py-16 md:px-6 xl:px-8 sm:rounded-md dark:border-dark-700 flex flex-grow items-center justify-center flex-col w-full xl:w-8/12 2xl:w-9/12">
                <div class="w-full flex flex-col gap-4 lg:gap-6 items-center justify-center">
                    <x-icons.folder-open class="!w-16 !h-16" stroke-width="1" />
                    <div class="flex flex-col gap-2 text-center">
                        <p>{{ __('Your wishlist is empty') }}</p>
                        <p class="text-sm">{{ __('Add more products to your wishlist and save it for easy access later') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex-grow max-w-full w-full xl:w-4/12 2xl:min-w-max flex flex-col overflow-hidden max-xl:divide-y gap-4">
            @include('layouts.partials._contact-card', [
                'title' => __('Have inquiry about our products ?'), 
                'sub_title' => __('We are here to help'), 
                'button' => 'light',
            ])
        </div>
    </div>

    @if (($page = request()->_page) && $page->body)
        <div class="lg:container mx-auto py-4 lg:pt-10">
            <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 min-w-full rounded-md">
                {!! html($page->body) !!}
            </div>
        </div>
    @endif
</section>
