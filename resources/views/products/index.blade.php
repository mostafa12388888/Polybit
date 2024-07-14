<x-app-layout>
    <x-slot name="heading">{{ __('Products') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{__('Products') }}</x-breadcrumb>
    </x-slot>


    <section class="flex-grow bg-primary-100 dark:bg-dark-800/70 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="container mx-auto flex flex-col lg:flex-row items-start gap-3 md:gap-4 lg:gap-8 relative z-10">
        
            <div class="w-full flex gap-4 lg:gap-6 items-center justify-center flex-wrap">
                @foreach (range(1, 12) as $item)
                    <div class="w-72 max-w-sm flex-grow flex">
                        @include('products.partials._product')
                    </div>
                @endforeach
            </div>
            
            <div class="flex-grow max-w-full w-full lg:w-5/12 xl:w-4/12 flex flex-col overflow-hidden max-lg:divide-y lg:gap-4">
                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-800 max-lg:py-10 flex flex-col">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Store Categories') }}</h3>

                    <div class="flex flex-col gap-6">
                        @foreach (range(1, 6) as $item)
                            <div class="flex flex-col gap-3">
                                <x-link class="font-semibold" :href="route('products.index')">{{ fake()->sentence(3) }}</x-link>
                                
                                @foreach (range(1, rand(2, 4)) as $item)
                                    <x-link class="ms-3" :href="route('products.index')">{{ fake()->sentence(3) }}</x-link>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
