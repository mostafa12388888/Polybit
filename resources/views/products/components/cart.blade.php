<section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 sm:p-4 md:px-4 md:py-8 lg:py-12 relative">
    <div class="container mx-auto flex flex-col xl:flex-row gap-4">
        @if ($cart_items->count())
            <div class="bg-white dark:bg-dark-700/60 px-4 py-8 md:px-6 lg:py-0 xl:px-8 sm:rounded-md dark:border-dark-700 flex flex-col gap-6 lg:table w-full xl:w-8/12 2xl:w-9/12">
                <p class="lg:hidden uppercase mb-4 pb-4 border-b border-dark-100 dark:border-dark-700">{{ __('Please ensure all item details and quantities are correct before placing order') }}</p>
            
                <div class="hidden lg:table-header-group flex-wrap gap-4 justify-between items-center">
                    <div class="font-semibold table-cell align-middle pb-8 pt-8"></div>
                    <div class="font-semibold table-cell align-middle pb-8 pt-8">{{ __('Product') }}</div>
                    <div class="font-semibold table-cell align-middle pb-8 pt-8">{{ __('Quantity') }}</div>
                    <div class="font-semibold table-cell align-middle pb-8 pt-8"></div>
                </div>
                
                @foreach ($cart_items as $product)
                    <div class="flex lg:table-row gap-2 sm:gap-4 items-center justify-between" wire:key="item-{{ $product->index }}">
                        <x-link :href="route('products.show', $product)" class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700 shrink-0">
                            <x-curator-glider fallback="logo" :media="$product->image" format="webp" width="480" height="280" fit="contain" quality="70" class="w-14 h-14 sm:w-20 sm:h-20 rounded-md object-cover bg-white" :alt="$product->name" />
                        </x-link>
                        
                        <x-link :href="route('products.show', $product)" class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700 flex-grow">
                            <h3 class="line-clamp-3">{{ $product->name }}</h3>
                            @if ($variant = $product->variant)
                                <p class="text-sm font-thin">
                                    @foreach ($variant->attribute_values as $attribute_value)
                                        {{ $attribute_value->title ?: $attribute_value->value }}
                                        {{ $loop->last ? '' : ' - ' }}
                                    @endforeach
                                </p>
                            @endif
                        </x-link>

                        <div class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700">
                            <x-input type="number" class="w-14 sm:w-20" min="1" max="1000000" value="{{ $product->quantity }}" x-on:change.debounce.250ms="$wire.update_quantity({{ $product->index }}, $el.value)" />
                        </div>

                        <div class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700">
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
                    <p>{{ __('The shopping cart is empty') }}</p>
                </div>
            </div>
        @endif

        <div class="flex-grow max-w-full w-full xl:w-4/12 2xl:w-3/12 flex flex-col overflow-hidden max-xl:divide-y gap-4">
            <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 sm:rounded-md gap-4 dark:border-dark-800 max-xl:py-10 flex flex-col">
                @if ($cart_items->count())
                    <p class="hidden lg:block">{{ __('Please ensure all item details and quantities are correct before placing order') }}</p>
                    <x-link styling="primary" :href="route('request-quote')" class="text-center py-4">{{ __('Request A Quote') }}</x-link>
                @endif

                <x-link styling="light" :href="route('products.index')" class="text-center">{{ __('Continue Shopping') }}</x-link>
            </div>

            @include('layouts.partials._contact-card', ['title' => __('Need Help ?'), 'button' => 'light'])
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
