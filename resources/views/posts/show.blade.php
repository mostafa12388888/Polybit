<x-app-layout>
    <x-slot name="title">{{ $post->meta('title') }}</x-slot>

    <x-slot name="description">{{ $post->meta('description') }}</x-slot>

    <x-slot name="keywords">{{ $post->meta('keywords') }}</x-slot>

    <x-slot name="image">{!! $post->meta('image') !!}</x-slot>

    <x-slot name="head">
        <link rel="preload" as="image" href="{!! $post->meta('image') !!}" fetchpriority="high" />
        
        <link rel="canonical" href="{{ localized_url($post->locales()[0] ?? app()->getLocale(), request()->url()) }}" />
    </x-slot>
    
    
    <x-slot name="heading">{{ $post->title }}</x-slot>

    <x-slot name="subheading">
        <div class="flex gap-x-4 gap-y-3 flex-wrap text-sm items-center mt-6">
            <div class="flex gap-2 items-center">
                <x-icons.user class="flex-shrink-0 !w-4 !h-4" />
                <span class="text-sm font-light line-clamp-1">{{ $post->user->name }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <x-icons.tag class="flex-shrink-0 !w-4 !h-4" />
                <a href="{{ route('blog-categories.show', $post->category) }}" class="text-sm font-light line-clamp-1">{{ $post->category->name }}</a>
            </div>
            <div class="flex gap-2 items-center">
                <x-icons.clock class="flex-shrink-0 !w-4 !h-4" />
                <span class="text-sm font-light line-clamp-1">{{ $post->updated_at->translatedFormat('d M, Y') }}</span>
            </div>
        </div>
    </x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('posts.index')">{{ __('Posts') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit($post->title, 17) }}</x-breadcrumb>
    </x-slot>

    <article class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col lg:flex-row sm:gap-4 max-sm:divide-y">
            <div class="lg:rounded-md flex-grow w-full lg:w-8/12 2xl:w-9/12 overflow-hidden">
                <img src="{{ $post->meta('image') }}" class="w-full" alt="{{ $post->meta('image-alt') }}" fetchpriority="high" width="1920" height="1080">

                <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 max-w-full">
                    {!! html($post->body) !!}
                </div>
                
                <div class="border-t border-dark-100 dark:border-dark-700 pt-4 bg-white dark:bg-dark-50 dark:opacity-85 py-8 px-2 md:px-4 xl:px-6">
                    <livewire:comments :url="request()->url()" />
                </div>
            </div>
            
            <div class="flex-grow max-w-full w-full lg:w-4/12 2xl:w-3/12 flex flex-col overflow-hidden max-lg:divide-y lg:gap-4 dark:border-dark-700">
                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('share this post') }}</h3>
                    
                    @include('layouts.partials._share-buttons')
                </div>

                @if ($related_posts->count())
                    <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                        <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Related posts you might like') }}</h3>
                        @foreach ($related_posts as $related_post)
                            <x-link :href="route('posts.show', $related_post)">{{ $related_post->title }}</x-link>
                        @endforeach
                    </div>
                @endif
                
                @if ($latest_posts->count())
                    <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                        <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Our latest posts') }}</h3>
                        @foreach ($latest_posts as $latest_post)
                            <x-link :href="route('posts.show', $latest_post)">{{ $latest_post->title }}</x-link>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </article>

    <x-slot name="scripts">
        @minifyInclude('schema.post-schema')
    </x-slot>
</x-app-layout>
