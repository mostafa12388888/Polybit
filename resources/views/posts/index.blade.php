<x-app-layout>
    <x-slot name="title">{{ $category ?? null ? $category->meta('title') : __('Blog Posts') }}</x-slot>

    @if ($category ?? null)
        <x-slot name="description">{{ $category->meta('description') }}</x-slot>

        <x-slot name="keywords">{{ $category->meta('keywords') }}</x-slot>

        <x-slot name="image">{!! $category->meta('image') !!}</x-slot>
    @endif

    <x-slot name="head">
        {{-- This code to address issue with duplicated blog url and you can remove it later  --}}
        @if(! request()->page)
            <link rel="canonical" href="{{ route('posts.index') }}" />
        @endif
    </x-slot>

    <x-slot name="heading">{{ $category ?? null ? $category->name : __('Blog Posts') }}</x-slot>

    <x-slot name="breadcrumbs">
        @if($category ?? null)
            <x-breadcrumb :href="route('posts.index')">{{ __('Posts') }}</x-breadcrumb>
            <x-breadcrumb :last="true">{{ str()->limit($category->name, 17) }}</x-breadcrumb>
        @else
            <x-breadcrumb :last="true">{{ __('Posts') }}</x-breadcrumb>
        @endif
    </x-slot>
    
    <div class="flex-grow bg-white dark:bg-dark-800/70 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
            @if ($category ?? null)
                @include('layouts.partials._category-card', compact('category'))
            @endif
            
            <div class="w-full flex gap-12 sm:gap-16 items-center flex-wrap justify-center">
                @forelse ($posts as $post)
                    <div class="max-w-4xl flex-grow flex">
                        @include('posts.partials._post-card-horizontal', ['lazy' => $loop->index > 1])
                    </div>
                @empty
                    @include('layouts.partials._empty')
                @endforelse
            </div>

            <div class="w-full mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        @minifyInclude('schema.posts-schema', [
            'title' => $category ?? null ? $category->meta('title') : __('Blog Posts'),
        ])
    </x-slot>
</x-app-layout>
