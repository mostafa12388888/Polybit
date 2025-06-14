<x-app-layout>
    <x-slot name="title">{!! $category ?? null ? $category->meta('title') : __('Products') !!}</x-slot>

    @if ($category ?? null)
        <x-slot name="description">{!! $category->meta('description') !!}</x-slot>

        <x-slot name="keywords">{!! $category->meta('keywords') !!}</x-slot>

        <x-slot name="image">{!! $category->meta('image') !!}</x-slot>
    @endif

    <x-slot name="heading">{!! $category ?? null ? $category->name : __('Products') !!}</x-slot>

    <x-slot name="breadcrumbs">
        @if($category ?? null)
            <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
            <x-breadcrumb :last="true">{{ str()->limit($category->name, 17) }}</x-breadcrumb>
        @else
            <x-breadcrumb :last="true">{{ __('Products') }}</x-breadcrumb>
        @endif
    </x-slot>

    <section class="flex-grow bg-secondary-100/50 dark:bg-dark-800 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="container mx-auto flex flex-col lg:flex-row items-start gap-3 md:gap-4 lg:gap-8 relative z-10">
            @if ($category ?? null)
                @include('layouts.partials._category-card', compact('category'))
            @endif
        </div>

        <div class="container mx-auto flex flex-col lg:flex-row items-start gap-3 md:gap-4 lg:gap-8 relative z-10">
            <div class="w-full flex gap-4 lg:gap-6 items-stretch justify-center flex-wrap relative">
                @forelse ($products as $product)
                    <div class="w-72 max-w-sm flex-grow flex">
                        @include('products.partials._product', ['lazy' => $loop->index > 1])
                    </div>
                @empty
                    @include('layouts.partials._empty')
                @endforelse

                <div class="w-full mt-6">
                    {{ $products->links() }}
                </div>
            </div>

            @if ($store_categories->count())
                <div class="flex-grow max-w-full w-full lg:w-5/12 xl:w-4/12 flex flex-col overflow-hidden max-lg:divide-y lg:gap-4">
                    <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-800 max-lg:py-10 flex flex-col">
                        <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Store Categories') }}</h3>

                        <div class="flex flex-col gap-6">
                            @foreach ($store_categories as $category)
                                <div class="flex flex-col gap-3">
                                    <x-link class="font-semibold" :href="route('store-categories.show', $category)">{{ $category->name }}</x-link>

                                    @foreach ($category->sub_categories as $sub_category)
                                        <x-link class="ms-3" :href="route('store-categories.show', $sub_category)">{{ $sub_category->name }}</x-link>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if (($page = request()->_page) && $page->body)
        <div class="bg-white dark:bg-dark-800 -mt-5 md:pb-10 z-10">
            <div class="lg:container mx-auto">
                <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/40 py-8 px-4 md:px-6 xl:px-8 min-w-full md:rounded-md">
                    {!! html($page->body) !!}
                </div>
            </div>
        </div>
    @endif

    <livewire:videos :subject="$category" lazy />

    <x-slot name="scripts">
        @minifyInclude('schema.products-schema', [
            'title' => $category ?? null ? $category->meta('title') : __('Products'),
        ])
    </x-slot>
</x-app-layout>
