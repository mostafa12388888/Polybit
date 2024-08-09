<x-app-layout>
    <x-slot name="heading">{{ str()->title(fake()->sentence(6)) }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('posts.index')">Blog</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit(fake()->sentence(10), 17) }}</x-breadcrumb>
    </x-slot>

    <article class="flex-grow bg-primary-100 dark:bg-dark-800/70 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col lg:flex-row sm:gap-4 max-sm:divide-y">
            <div class="lg:rounded-md flex-grow w-full lg:w-8/12 2xl:w-9/12 overflow-hidden">
                <div class="prose prose-zinc dark:prose-invert xl:prose-lg bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 max-w-full">
                    <p>{{ fake()->paragraph(rand(7,14)) }}</p>
                    <x-img loading="lazy" src="{{ asset('storage/slide'. rand(1,3) .'.webp') }}" class="max-w-full" alt="" />
                    <p>{{ fake()->paragraph(rand(10,15)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <x-img loading="lazy" src="{{ asset('storage/slide'. rand(1,3) .'.webp') }}" class="max-w-full" alt="" />
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <x-img loading="lazy" src="{{ asset('storage/slide'. rand(1,3) .'.webp') }}" class="max-w-full" alt="" />
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                </div>
                
                <div class="border-t border-dark-100 dark:border-dark-700 pt-4 bg-white dark:bg-dark-50 dark:opacity-85 py-8 px-2 md:px-4 xl:px-6">
                    <livewire:comments />
                </div>
            </div>
            
            <div class="flex-grow max-w-full w-full lg:w-4/12 2xl:w-3/12 flex flex-col overflow-hidden max-lg:divide-y lg:gap-4 dark:border-dark-700">
                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('share this post') }}</h3>
                    
                    @include('layouts.partials._share-buttons')
                </div>

                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Related posts you might like') }}</h3>
                    @foreach (range(1,6) as $item)
                        <x-link :href="route('posts.show', str()->slug(fake()->sentence(4)))">{{ fake()->sentence(4) }}</x-link>
                    @endforeach
                </div>
                
                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Our latest posts') }}</h3>
                    @foreach (range(1,6) as $item)
                        <x-link :href="route('posts.show', str()->slug(fake()->sentence(4)))">{{ fake()->sentence(4) }}</x-link>
                    @endforeach
                </div>
            </div>
        </div>
    </article>
</x-app-layout>
