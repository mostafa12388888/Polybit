<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-6 sm:table w-fit">
        @foreach ($this->available_attributes_with_values as $attribute)
            <div class="flex flex-col gap-2 sm:table-row">
                <x-label class="sm:pe-8 sm:py-5 table-cell max-w-fit">{{ $attribute->name }}</x-label>

                @if($attribute->values->count() == 1)
                    <span for="" class="sm:pe-8 sm:py-5 table-cell max-w-fit">:</span>
                    <span>{{ $attribute->values->first()->title ?: $attribute->values->first()->value }}</span>

                @else

                    @if ($attribute->type->isColors())
                        <div class="table-cell align-middle">
                            <div class="flex gap-0.5 flex-wrap -mx-1">
                                @foreach ($attribute->values as $value)
                                    @php($available = in_array($value->id, $available_attribute_values))

                                    <div class="{{ ! $available ? 'cursor-not-allowed opacity-25 blur-[2px]' : '' }}" title="{{ $value->title }}">
                                        <button class="flex hover:ring-1 rounded p-1.5 items-center justify-center {{ ! $available ? 'pointer-events-none' : '' }} {{ optional($selected_attribute_values)[$attribute->id] == $value->id ? 'ring-2 hover:ring-2 ring-primary-400' : 'ring-primary-200' }}"
                                            @if (optional($selected_attribute_values)[$attribute->id] == $value->id)
                                                wire:click="$set('selected_attribute_values.{{ $attribute->id }}', null)"
                                            @else
                                                wire:click="$set('selected_attribute_values.{{ $attribute->id }}', {{ $value->id }})"
                                            @endif
                                        >
                                            <span class="block w-9 h-9 shadow rounded" style="background: {{ $value->value }};"></span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <x-select class="table-cell text-sm px-8" wire:model.live="selected_attribute_values.{{ $attribute->id }}">
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

    @if($added_to_cart)
        <div class="flex flex-wrap items-center gap-4 border p-4 rounded-lg justify-between">
            <div class="flex gap-2 items-center">
                <x-icons.check-circle class="!w-7 !h-7 text-green-600" />
                <span>{{ __('Added To Cart') }}</span>
            </div>

            <x-link styling="light" class="dark:bg-dark-700 justify-center items-center !px-6" :href="route('cart')">
                <span>{{ __('Go to cart') }}</span>
            </x-link>
        </div>
    @else
        @if ($product->is_available)
            <div class="flex flex-wrap items-center gap-4">
                <x-button styling="primary" class="flex gap-2 dark:bg-dark-700 justify-center items-center max-w-sm w-full py-4"
                    wire:click="add_to_cart" wire:target="add_to_cart" wire:loading.attr="disabled">
                    <x-icons.cart class="!w-5 !h-5" stroke-width="1.5" />
                    <span>{{ __('Add to cart') }}</span>
                    <x-spinner wire:target="add_to_cart" wire:loading class="!w-4 !h-4" />
                </x-button>
                
                @error('availability')<div class="text-red-500">{{ $message }}</div>@enderror
            </div>
        @else
            <div class="text-lg text-red-500 flex gap-2 items-center">
                <x-icons.exclamation-triangle class="!w-7 !h-7" />
                <span>{{ __('The product is currently unavailable') }}.</span>
            </div>
        @endif
    @endif
</div>
