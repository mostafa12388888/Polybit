<x-slot name="title">{{ __('Request Quote') }}</x-slot>

<x-slot name="heading">{{ __('Request Quote') }}</x-slot>

<x-slot name="breadcrumbs">
    <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
    <x-breadcrumb :last="true">{{ __('Request Quote') }}</x-breadcrumb>
</x-slot>

@if($order_created)
    <section class="flex-grow bg-primary-100 dark:bg-dark-800/70 lg:py-6 xl:py-8">
        <div class="lg:container mx-auto flex flex-col lg:flex-row lg:gap-4">
            <div class="lg:rounded-md bg-white dark:bg-dark-700/60 w-full flex flex-col px-4 py-20 items-center justify-center gap-4">
                <x-icons.check-circle class="!w-14 !h-14" stroke-width=".8" />
                <h3 class="text-lg">{{ __('Order Created') }}</h3>
                <p class="text-lg">{{ __('We will contact you as soon as possible') }}</p>

                <div class="flex flex-wrap gap-3 pt-2">
                    <x-link styling="light" :href="route('home')" class="flex items-center justify-center gap-2">
                        <x-icons.home class="!w-5 !h-5" />
                        <span>{{ __('Go Home') }}</span>
                    </x-link>

                    <x-link styling="light" :href="route('products.index')">
                        <x-icons.cart class="!w-5 !h-5" />
                        <span>{{ __('Continue Shopping') }}</span>
                    </x-link>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="flex-grow bg-primary-100 dark:bg-dark-800/70 lg:py-6 xl:py-8">
        <div class="lg:container mx-auto flex flex-col lg:flex-row lg:gap-4">
            <div class="lg:rounded-md overflow-hidden bg-white dark:bg-dark-700/60 w-full lg:max-w-sm relative flex flex-col order-3 lg:order-1">
                <div class="flex gap-2 flex-wrap justify-between items-center p-4 border-y lg:border-t-0 border-dark-200/70 dark:border-dark-700">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100">{{ __('Order Summery') }}</h3>

                    <x-link styling="light" size="sm" :href="route('cart')" class="flex gap-1 items-center py-2">
                        <x-icons.cart class="!w-5 !h-5" />
                        <span>{{ __('Edit') }}</span>
                    </x-link>
                </div>

                <div class="relative flex-grow overflow-auto">
                    <div class="divide-y lg:absolute w-full">
                        @foreach (cart($cart_items)->items() as $product)
                            <x-link :href="route('products.show', $product)" class="flex gap-2 sm:gap-4 items-center border-dashed border-dark-200/70 dark:border-dark-700 !p-4">
                                <x-curator-glider fallback="logo" :media="$product->image" format="webp" width="480" height="280" fit="fill" bg="white" quality="70" class="shrink-0 w-14 h-14 sm:w-20 sm:h-20 rounded-md object-cover" :alt="$product->name" />
                                
                                <div class="flex-grow flex flex-col gap-2">
                                    <h3 class="line-clamp-3">{{ $product->name }}</h3>
                                    @if ($product->variant)
                                        <p class="text-sm font-thin">
                                            @foreach ($product->variant->attribute_values as $attribute_value)
                                                {{ $attribute_value->title ?: $attribute_value->value }}
                                                {{ $loop->last ? '' : ' - ' }}
                                            @endforeach
                                        </p>
                                    @endif
                                    <p>
                                        <span>{{ __('Quantity') }}</span>
                                        <span>{{ $product->quantity }}</span>
                                    </p>
                                </div>
                            </x-link>
                        @endforeach
                    </div>
                </div>
            </div>

            <form wire:submit="request_quote" class="lg:rounded-md flex-grow w-full overflow-hidden order-2 bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 flex flex-col gap-6">
                <h2 class="uppercase font-semibold text-xl lg:text-2xl text-gray-800 dark:text-dark-100 leading-tight">
                    {{ __('Request a Quote') }}
                </h2>

                <p>{{ __('Please provide the following details so we can offer you a comprehensive quote tailored to your needs') }}.</p>

                <hr class="border-dark-200/70 dark:border-dark-700">

                <div class="flex flex-col gap-3">
                    <x-label for="">{{ __('Your Name') }}</x-label>

                    <x-input placeholder="{{ __('Name') }}" wire:model="name" />
                    
                    @error('name')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="flex flex-col gap-3">
                    <x-label required for="">{{ __('Your Email Address') }}</x-label>

                    <x-input placeholder="{{ __('Email') }}" wire:model="email" />

                    @error('email')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>
                
                <div class="flex flex-col gap-3">
                    <x-label for="">{{ __('Your Phone') }}</x-label>
                    
                    <x-input placeholder="{{ __('Phone') }}" wire:model="phone" />

                    @error('phone')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="flex flex-col gap-3">
                    <x-label>{{ __('Additional Details') }}:</x-label>

                    <x-textarea rows="4" placeholder="{{ __('Message') }}" wire:model="message" />

                    @error('message')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>
                
                <x-button class="sm:max-w-40 flex gap-2 items-center justify-center" wire:target="send_message" wire:loading.attr="disabled">
                    <span>{{ __('Submit') }}</span>
                    <x-spinner wire:target="send_message" wire:loading class="!w-4 !h-4" />
                </x-button>
            </form>
        </div>
    </section>
@endif
