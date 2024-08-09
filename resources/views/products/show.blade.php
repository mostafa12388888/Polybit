<x-app-layout>
    <x-slot name="heading">{{ $product->name }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('projects.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit($product->name, 17) }}</x-breadcrumb>
    </x-slot>

    <section class="flex-grow bg-white dark:bg-dark-800/70 pb-6 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col gap-20">
            <div class="flex flex-col lg:flex-row gap-12">
                @if($product->images->count())
                    <div class="relative flex-grow shrink-0 w-full lg:max-w-md xl:max-w-xl">
                        @include('products.partials._product-images')
                    </div>
                @endif

                <div class="flex flex-col gap-6 mx-4 sm:mx-0">
                    <h2 class="font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ $product->name }}</h2>
                    
                    <p class="prose prose-zinc dark:prose-invert max-w-full">{!! html($product->description) !!}</p>

                    <div class="flex flex-col gap-6 sm:table w-fit">
                        @foreach ($product->attributes_with_values as $attribute)
                            <div class="flex flex-col gap-2 sm:table-row">
                                <x-label for="" class="sm:pe-8 sm:py-5 table-cell max-w-fit">{{ $attribute->name }}</x-label>
        
                                @if ($attribute->type->isColors())
                                    <div class="table-cell">
                                        <div class="flex gap-0.5 flex-wrap -mx-1">
                                            @foreach ($attribute->values as $value)
                                                <button class="flex hover:ring-1 focus:ring-2 ring-primary-400 rounded p-1.5 items-center justify-center" title="{{ $value->title }}">
                                                    <span class="block w-9 h-9 shadow rounded" style="background: {{ $value->value }};"></span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <x-select class="table-cell">
                                        @foreach ($attribute->values as $value)
                                            <option value="{{ $value->slug }}">{{ $value->value }}</option>
                                        @endforeach
                                    </x-select>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <x-button styling="primary" class="flex gap-2 dark:bg-dark-700 justify-center items-center max-w-sm w-full py-4">
                        <x-icons.cart class="!w-5 !h-5" stroke-width="1.5" />
                        <span>{{ __('Add to cart') }}</span>
                    </x-button>
                </div>
            </div>

            <div class="lg:rounded-md overflow-hidden mx-4 sm:mx-0" x-data="{tab: 1}">
                <nav class="w-full flex max-lg:hidden bg-primary-50 dark:bg-dark-700/20">
                    @foreach ($product->specs->sortBy('order') as $spec)
                        <x-button styling="light-link" class="!shadow-none rounded-none flex-grow py-5 border-b border-dark-200 dark:border-dark-600/50 !rounded-t-md bg-transparent"
                            x-bind:class="{'!bg-white border border-b-0 dark:!bg-dark-700/40 dark:focus:!brightness-100': tab == {{ $loop->index + 1 }}}"
                            @click="tab = {{ $loop->index + 1 }}">
                            <span>{{ $spec->title }}</span>
                        </x-button>
                    @endforeach
                </nav>

                
                @if($product->specs->count())
                    @include('products.partials._specs')
                @endif
            </div>
        </div>
    </section>

    @if($related_products->count())
        @include('products.partials._related-products')
    @endif
</x-app-layout>
