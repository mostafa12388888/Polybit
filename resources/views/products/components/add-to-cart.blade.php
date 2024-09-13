<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-6 sm:table w-full sm:w-fit">
        @foreach ($this->available_attributes_with_values as $attribute)
            <div class="flex-grow flex flex-col gap-2 sm:table-row">
                
                @if($attribute->values->count() == 1)
                    <span class="sm:pe-8 sm:py-5 table-cell max-w-fit">{{ $attribute->name }} : </span>
                    <span>{{ $attribute->values->first()->title ?: $attribute->values->first()->value }}</span>
                    
                @else
                
                    @if ($attribute->type->isColors())
                        <span class="sm:pe-8 sm:py-5 table-cell max-w-fit">{{ $attribute->name }}</span>

                        <div class="table-cell align-middle" x-data="{ activeColor: null }">
                            <div class="flex gap-0.5 flex-wrap -mx-1">
                                @foreach ($attribute->values as $value)
                                    @php($available = in_array($value->id, $available_attribute_values))

                                    <div class="{{ ! $available ? 'cursor-not-allowed opacity-25 blur-[2px]' : '' }}" title="{{ $value->title }}">
                                        <button class="flex hover:ring-1 rounded p-1.5 items-center justify-center {{ ! $available ? 'pointer-events-none' : '' }}"
                                            x-bind:class="activeColor == {{ $value->id }} ? 'ring-2 hover:ring-2 ring-primary-400' : 'ring-primary-200'"
                                            @click="
                                                $wire.set('selected_attribute_values.{{ $attribute->id }}', activeColor == {{ $value->id }} ? null : {{ $value->id }})
                                                activeColor = {{ $value->id }}
                                            "
                                        >
                                            <span class="block w-9 h-9 shadow rounded" style="background: {{ $value->value }};"></span>
                                            <span class="sr-only">{{ $value->title }}</span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <x-label class="sm:pe-8 sm:py-5 table-cell max-w-fit" for="attr_{{ $attribute->id }}">{{ $attribute->name }}</x-label>

                        <x-select class="table-cell text-sm px-8 py-3 sm:py-2 max-w-sm" id="attr_{{ $attribute->id }}" wire:model.live="selected_attribute_values.{{ $attribute->id }}">
                            <option value="" selected>- {{ __('Select :attribute', ['attribute' => $attribute->name]) }}</option>

                            @foreach ($attribute->values as $value)
                                @php($available = in_array($value->id, $available_attribute_values))
                                <option value="{{ $value->id }}" {{ ! $available ? 'disabled' : '' }}>{{ $value->value }}</option>
                            @endforeach
                        </x-select>
                    @endif
                @endif
            </div>

            @error('attribute_' . $attribute->id)
                <div class="flex flex-col gap-2 sm:table-row max-sm:-mt-4">
                    <div class="sm:pe-8 sm:py-5 table-cell max-w-fit"></div>
                    <div class="text-red-500">{{ $message }}</div>
                </div>
            @enderror
        @endforeach
    </div>

    @if(! $product->is_available)
    <div class="text-lg text-red-500 flex gap-2 items-center">
        <x-icons.exclamation-triangle class="!w-7 !h-7" />
        <span>{{ __('The product is currently unavailable') }}.</span>
    </div>
    @endif

    <div class="flex flex-wrap gap-2">
        @if($product->is_available && ! $added_to_cart)
            <div class="flex-grow flex flex-wrap items-center gap-4 md:max-w-xs w-full sm:w-auto">
                <x-button styling="primary" class="flex gap-2 dark:bg-dark-700 justify-center items-center w-full py-4 px-10"
                    wire:click="add_to_cart" wire:target="add_to_cart" wire:loading.attr="disabled">
                    <x-icons.cart wire:target="add_to_cart" wire:loading.remove stroke-width="1.5" />
                    <x-spinner wire:target="add_to_cart" wire:loading class="!w-5 !h-5" />
                    <span class="font-bold">{{ __('Add to cart') }}</span>
                </x-button>
            </div>
        @endif

        @if($added_to_cart)
            <div class="max-w-xl flex flex-wrap items-center gap-4 border border-secondary-200 dark:border-dark-600 p-2 rounded-lg justify-between">
                <div class="flex gap-2 items-center">
                    <x-icons.check-circle class="!w-7 !h-7 text-green-600" />
                    <span>{{ __('Added To Cart') }}</span>
                </div>

                <x-link styling="light" class="dark:bg-dark-700 justify-center items-center !px-6" :href="route('cart')">
                    <span>{{ __('Go to cart') }}</span>
                </x-link>
            </div>
        @endif
    
        @if($added_to_wishlist)
            <div class="flex-grow flex flex-wrap items-center gap-4 md:max-w-xs">
                <x-button styling="light" class="flex gap-2 dark:bg-dark-600 justify-center items-center w-full py-4 px-10"
                    wire:click="remove_from_wishlist" wire:target="remove_from_wishlist" wire:loading.attr="disabled">
                    <x-icons.heart-solid wire:target="remove_from_wishlist" wire:loading.remove class="text-dark-500/90 dark:text-dark-300" />
                    <x-spinner wire:target="remove_from_wishlist" wire:loading class="!w-5 !h-5" />
                    <span>{{ __('Remove from wishlist') }}</span>
                </x-button>
            </div>
        @else
            <div class="flex-grow flex flex-wrap items-center gap-4 md:max-w-xs">
                <x-button styling="light" class="flex gap-2 dark:bg-dark-700/60 justify-center items-center w-full py-4 px-10"
                    wire:click="add_to_wishlist" wire:target="add_to_wishlist" wire:loading.attr="disabled">
                    <x-icons.heart wire:target="add_to_wishlist" wire:loading.remove stroke-width="1.1" class="text-secondary-700 dark:text-dark-300" />
                    <x-spinner wire:target="add_to_wishlist" wire:loading class="!w-5 !h-5" />
                    <span>{{ __('Add to wishlist') }}</span>
                </x-button>
            </div>
        @endif
    </div>

    @error('availability')<div class="text-red-500">{{ $message }}</div>@enderror
</div>
