<x-app-layout>
    <x-slot name="heading">{{ __('Request Quote') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ __('Request Quote') }}</x-breadcrumb>
    </x-slot>

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
                    <div class="divide-y lg:absolute">
                        @foreach (range(1, rand(3,10)) as $item)
                            <x-link class="flex gap-2 sm:gap-4 items-center border-dashed border-dark-200/70 dark:border-dark-700 !p-4" :href="route('products.show', str()->slug(fake()->sentence(4)))">
                                <x-img src="{{ asset('/storage/product'.rand(1,4).'.webp') }}" class="shrink-0 w-14 h-14 sm:w-20 sm:h-20 rounded-md object-cover" alt="" />
                                
                                <div class="flex-grow">
                                    <h3 class="line-clamp-3">{{ fake()->sentence(4) }}</h3>
                                    <p>
                                        <span>{{ __('Quantity') }}</span>
                                        <span>{{ rand(1, 5) }}</span>
                                    </p>
                                </div>
                            </x-link>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:rounded-md flex-grow w-full overflow-hidden order-2 bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 flex flex-col gap-6">
                    <h2 class="uppercase font-semibold text-xl lg:text-2xl text-gray-800 dark:text-dark-100 leading-tight">
                        {{ __('Request a Quote') }}
                    </h2>

                    <p>Please provide the following details so we can offer you a comprehensive quote tailored to your needs.</p>

                    <hr class="border-dark-200/70 dark:border-dark-700">

                    <div class="flex flex-col gap-3">
                        <x-label for="">{{ __('Your Name') }}</x-label>
        
                        <x-input placeholder="{{ __('Name') }}" />
                    </div>

                    <div class="flex flex-col gap-3">
                        <x-label required for="">{{ __('Your Email Address') }}</x-label>
        
                        <x-input placeholder="{{ __('Email') }}" />
                    </div>

                    <div class="flex flex-col gap-3">
                        <x-label for="">{{ __('Your Phone') }}</x-label>
        
                        <x-input placeholder="{{ __('Phone') }}" />
                    </div>

                    <div class="flex flex-col gap-3">
                        <x-label>{{ __('Additional Details') }}:</x-label>
        
                        <x-textarea rows="4" placeholder="{{ __('Message') }}" />
                    </div>
                    
                    <x-button class="sm:max-w-40">{{ __('Submit') }}</x-button>
            </div>
        </div>
    </section>
</x-app-layout>
    