<x-app-layout>
    <x-slot name="title">{{ $product->meta('title') }}</x-slot>

    <x-slot name="description">{{ $product->meta('description') }}</x-slot>

    <x-slot name="keywords">{{ $product->meta('keywords') }}</x-slot>

    <x-slot name="image">{!! $product->meta('image') !!}</x-slot>

    <x-slot name="heading">{{ $product->name }}</x-slot>

    @if (! $product->translated())
        <link rel="canonical" href="{{ localized_url($product->locales()[0] ?? app()->getLocale()) }}" />
    @endif

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit($product->name, 17) }}</x-breadcrumb>
    </x-slot>

    <section class="flex-grow bg-white dark:bg-dark-800/70 pb-6 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col gap-20">
            <div class="flex flex-col lg:flex-row gap-8">
                @if($product->images->count())
                    <div class="relative flex-grow shrink-0 w-full lg:max-w-md xl:max-w-xl">
                        @include('products.partials._product-images')
                    </div>
                @endif

                <div class="flex flex-col gap-6 mx-4 sm:mx-0 mt-4">
                    <h2 class="font-bold text-5xl lg:text-5xl rtl:text-4xl rtl:lg:text-4xl text-dark-800 dark:text-dark-100 leading-tight">{{ $product->name }}</h2>
                    
                    <div class="prose prose-zinc dark:prose-invert max-w-full">{!! html($product->description) !!}</div>

                    <livewire:add-to-cart :product="$product" />
                </div>
            </div>

            @php
                $specs = $product->specs->filter(function ($spec) {
                    return in_array(app()->getLocale(), $spec->locales ?? []) || $spec->media->where('pivot.type', app()->getLocale())->count();
                })->sortBy('order');
            @endphp

            @if ($specs->count())
                <div class="max-sm:px-4 lg:rounded-md overflow-hidden" x-data="{tab: 1}">
                    <nav class="w-full flex max-lg:hidden bg-primary-50 dark:bg-dark-700/20">
                        @foreach ($specs as $spec)
                            <x-button styling="light-link" class="!shadow-none rounded-none flex-grow py-5 border-b border-dark-200 dark:border-dark-600/50 !rounded-t-md bg-transparent {{ count($specs) < 4 ? 'max-w-sm' : '' }}"
                                x-bind:class="{'!bg-white border border-b-0 dark:!bg-dark-700/40 dark:focus:!brightness-100': tab == {{ $loop->index + 1 }}}"
                                @click="tab = {{ $loop->index + 1 }}">
                                <span>{{ $spec->title }}</span>
                            </x-button>
                        @endforeach

                        @if(count($specs) < 4)
                            <div class="flex-grow border-b border-dark-200 dark:border-dark-600/50"></div>
                        @endif
                    </nav>

                    @include('products.partials._specs')
                </div>
            @endif

            <div class="bg-gray-50 dark:bg-dark-700/60 p-4 md:p-6 lg:rounded-md gap-2 dark:border-dark-700 flex flex-wrap justify-between items-center">
                <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100">{{ __('share this product') }}</h3>
                
                @include('layouts.partials._share-buttons')
            </div>

            <div class="bg-white dark:bg-dark-50 dark:opacity-85 px-2 md:px-0">
                <livewire:comments :url="request()->url()" />
            </div>
        </div>
    </section>

    @if($related_products->count())
        @include('products.partials._related-products')
    @endif

    <x-slot name="scripts">
        @minifyInclude('schema.product-schema')
    </x-slot>
</x-app-layout>
