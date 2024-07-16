<x-app-layout>
    <x-slot name="heading">{{ __('Shopping Cart') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ __('Shopping Cart') }}</x-breadcrumb>
    </x-slot>

    <section class="flex-grow bg-primary-100 dark:bg-dark-800/70 sm:p-4 md:px-4 md:py-8 lg:py-12 relative">
        <div class="container mx-auto flex flex-col xl:flex-row gap-4">
            <div class="bg-white dark:bg-dark-700/60 px-4 py-8 md:px-6 lg:py-0 xl:px-8 sm:rounded-md dark:border-dark-700 flex flex-col gap-6 lg:table w-full xl:w-8/12 2xl:w-9/12">
                <p class="lg:hidden uppercase mb-4 pb-4 border-b border-dark-100 dark:border-dark-700">Please ensure all item details and quantities are correct before placing order</p>

                <div class="hidden lg:table-header-group flex-wrap gap-4 justify-between items-center">
                    <div class="font-semibold table-cell align-middle pb-8 pt-8"></div>
                    <div class="font-semibold table-cell align-middle pb-8 pt-8">Product</div>
                    <div class="font-semibold table-cell align-middle pb-8 pt-8">Quantity</div>
                    <div class="font-semibold table-cell align-middle pb-8 pt-8"></div>
                </div>

                @foreach (range(1, rand(3, 7)) as $item)
                    <div class="flex lg:table-row gap-2 sm:gap-4 items-center justify-between">
                        <x-link :href="route('products.show', str()->slug(fake()->sentence(4)))" class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700 shrink-0">
                            <x-img src="{{ asset('/storage/product'.rand(1,4).'.webp') }}" class="w-14 h-14 sm:w-20 sm:h-20 rounded-md object-cover" alt="" />
                        </x-link>
                        
                        <x-link :href="route('products.show', str()->slug(fake()->sentence(4)))" class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700 flex-grow">
                            <h3 class="line-clamp-3">{{ fake()->sentence(4) }}</h3>
                        </x-link>

                        <div class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700">
                            <x-input type="number" class="w-14 sm:w-20" value="{{ rand(1, 5) }}" />
                        </div>

                        <div class="table-cell align-middle lg:pt-6 lg:pb-6 lg:border-t border-dashed border-dark-200/70 dark:border-dark-700">
                            <div class="flex justify-end">
                                <x-button styling="light" class="flex items-center gap-2 font-semibold !p-3">
                                    <x-icons.close class="!w-5 !h-5" />
                                    <span class="hidden sm:inline">{{ __('Remove') }}</span>
                                </x-button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex-grow max-w-full w-full xl:w-4/12 2xl:w-3/12 flex flex-col overflow-hidden max-xl:divide-y gap-4">
                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 sm:rounded-md gap-4 dark:border-dark-800 max-xl:py-10 flex flex-col">
                    <p class="hidden lg:block">Please ensure all item details and quantities are correct before placing order</p>
                    <x-link styling="primary" :href="route('request-quote')" class="text-center py-4">{{ __('Request A Quote') }}</x-link>
                    <x-link styling="light" :href="route('products.index')" class="text-center">{{ __('Continue Shopping') }}</x-link>
                </div>

                @include('layouts.partials._contact-card', ['title' => __('Need Help ?'), 'button' => 'light'])
            </div>
        </div>
    </section>
</x-app-layout>
