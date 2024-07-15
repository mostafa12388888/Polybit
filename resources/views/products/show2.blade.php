<x-app-layout>
    <x-slot name="heading">{{ str()->title(fake()->sentence(6)) }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('projects.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit(fake()->sentence(10), 17) }}</x-breadcrumb>
    </x-slot>

    <section class="flex-grow bg-white dark:bg-dark-800/70 pb-6 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col gap-20">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="relative flex-grow shrink-0 w-full lg:max-w-md xl:max-w-xl">
                    @include('products.partials._product-images')
                </div>

                <div class="flex flex-col gap-6 mx-4 sm:mx-0">
                    <h2 class="font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ str()->title(fake()->sentence(5)) }}</h2>
                    
                    <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,10)) }}</p>

                    <div class="flex flex-col gap-6 sm:table w-fit">
                        @foreach (range(1,rand(1,3)) as $item)
                            <div class="flex flex-col gap-2 sm:table-row">
                                <x-label for="" class="sm:pe-8 sm:py-5 table-cell max-w-fit">{{ str()->title(fake()->sentence(2)) }}</x-label>
        
                                <x-select class="table-cell">
                                    @foreach (range(1, rand(2,5)) as $item)
                                        <option value="">{{ str()->title(fake()->sentence(3)) }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        @endforeach

                        <div class="flex flex-col gap-2 sm:table-row">
                            <x-label for="" class="sm:pe-8 sm:py-5 sm:!pt-12 table-cell max-w-fit">{{ __('Color') }}:</x-label>
    
                            <div class="table-cell">
                                <div class="flex gap-1.5 flex-wrap -mx-1">
                                    @php($colors = collect(['bg-black', 'bg-slate-500', 'bg-dark-500', 'bg-zinc-500', 'bg-neutral-500', 'bg-stone-500', 'bg-red-500', 'bg-orange-500', 'bg-amber-500', 'bg-yellow-500', 'bg-lime-500', 'bg-green-500', 'bg-emerald-500', 'bg-teal-500', 'bg-cyan-500', 'bg-sky-500', 'bg-blue-500', 'bg-indigo-500', 'bg-violet-500', 'bg-purple-500', 'bg-fuchsia-500', 'bg-pink-500', 'bg-rose-500'])->shuffle())

                                    @foreach (range(3, rand(3, 15)) as $item)
                                        @php($color = $colors->pop())
                                        <button class="flex hover:ring-1 focus:ring-2 ring-primary-400 rounded p-1 items-center justify-center">
                                            <span class="block w-9 h-9 shadow {{ $color }} rounded"></span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @foreach (array_filter(range(0,rand(0,2))) as $item)
                            <div class="flex flex-col gap-2 sm:table-row">
                                <x-label for="" class="sm:pe-8 sm:py-5 table-cell max-w-fit">{{ str()->title(fake()->sentence(2)) }}</x-label>
        
                                <x-select class="table-cell">
                                    @foreach (range(1, rand(2,5)) as $item)
                                        <option value="">{{ str()->title(fake()->sentence(3)) }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        @endforeach
                    </div>

                    <x-button styling="primary" class="flex gap-2 dark:bg-dark-700 justify-center items-center max-w-sm w-full py-4">
                        <x-icons.cart class="!w-5 !h-5" stroke-width="1.5" />
                        <span>{{ __('Add to cart') }}</span>
                    </x-button>
                </div>
            </div>

            <div class="lg:rounded-md overflow-hidden mx-4 sm:mx-0 shadow" x-data="{tab: 1}">
                <nav class="w-full flex max-lg:hidden bg-primary-50 dark:bg-dark-700/40 divide-x">
                    <div class="flex-grow border-dark-200/50 dark:border-dark-700/30">
                        <x-button styling="link" class="w-full border-b-[6px] !shadow-none rounded-none py-5 border-dark-200/50 dark:border-dark-600/20"
                            x-bind:class="{'border-b-dark-500 dark:border-b-dark-400': tab == 1}"
                            @click="tab = 1">
                            <span>Specifications</span>
                        </x-button>
                    </div>
                    <div class="flex-grow border-dark-200/50 dark:border-dark-700/30">
                        <x-button styling="link" class="w-full border-b-[6px] !shadow-none rounded-none py-5 border-dark-200/50 dark:border-dark-600/20"
                            x-bind:class="{'border-b-dark-500 dark:border-b-dark-400': tab == 2}"
                            @click="tab = 2">
                            <span>Additional Information</span>
                        </x-button>
                    </div>
                    <div class="flex-grow border-dark-200/50 dark:border-dark-700/30">
                        <x-button styling="link" class="w-full border-b-[6px] !shadow-none rounded-none py-5 border-dark-200/50 dark:border-dark-600/20"
                            x-bind:class="{'border-b-dark-500 dark:border-b-dark-400': tab == 3}"
                            @click="tab = 3">
                            <span>Warranty + Return Policy</span>
                        </x-button>
                    </div>
                    <div class="flex-grow border-dark-200/50 dark:border-dark-700/30">
                        <x-button styling="link" class="w-full border-b-[6px] !shadow-none rounded-none py-5 border-dark-200/50 dark:border-dark-600/20"
                            x-bind:class="{'border-b-dark-500 dark:border-b-dark-400': tab == 4}"
                            @click="tab = 4">
                            <span>Installation + Cleaning</span>
                        </x-button>
                    </div>
                    <div class="flex-grow border-dark-200/50 dark:border-dark-700/30">
                        <x-button styling="link" class="w-full border-b-[6px] !shadow-none rounded-none py-5 border-dark-200/50 dark:border-dark-600/20"
                            x-bind:class="{'border-b-dark-500 dark:border-b-dark-400': tab == 5}"
                            @click="tab = 5">
                            <span>Sustainability Documentation</span>
                        </x-button>
                    </div>
                </nav>

                <div class="lg:p-6 lg:bg-dark-50 lg:dark:bg-dark-700/40 flex flex-col gap-10 rounded-b-md">
                    <div class="max-lg:!flex flex flex-col gap-4" x-show="tab == 1">
                        <h2 class="lg:hidden font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ __('Specifications') }}</h2>

                        <div class="flex flex-col gap-4">
                            @foreach (range(1, rand(2,6)) as $item)
                                <div class="flex gap-4 flex-wrap items-center justify-between border lg:border-none rounded-md p-4 border-dark-100 dark:border-dark-700/50">
                                    <p>{{ str()->title(fake()->sentence(5)) }}</p>

                                    <span class="flex-grow border-t border-dashed border-dark-200 dark:border-dark-700 max-lg:hidden"></span>

                                    <div class="flex w-full sm:w-auto gap-2 flex-wrap">
                                        <x-button styling="light" class="flex items-center justify-center gap-2 flex-grow dark:lg:!bg-dark-600">
                                            <x-icons.download class="!w-5 !h-5" />
                                            <span>{{ __('Download') }}</span>
                                            <span>[PDF]</span>
                                        </x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="max-lg:!flex flex flex-col gap-4" x-cloak x-show="tab == 2">
                        <h2 class="lg:hidden font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ __('Additional Information') }}</h2>
                        
                        <div>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                        </div>
                    </div>
                    <div class="max-lg:!flex flex flex-col gap-4" x-cloak x-show="tab == 3">
                        <h2 class="lg:hidden font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ __('Warranty + Return Policy') }}</h2>

                        <div>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                        </div>
                    </div>
                    <div class="max-lg:!flex flex flex-col gap-4" x-cloak x-show="tab == 4">
                        <h2 class="lg:hidden font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ __('Installation + Cleaning') }}</h2>
    
                        <div>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                        </div>
                    </div>
                    <div class="max-lg:!flex flex flex-col gap-4" x-cloak x-show="tab == 5">
                        <h2 class="lg:hidden font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ __('Sustainability Documentation') }}</h2>
    
                        <div>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                            <p class="prose prose-zinc dark:prose-invert xl:prose-lg max-w-full">{{ fake()->paragraph(rand(6,15)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('products.partials._related-products')
</x-app-layout>
