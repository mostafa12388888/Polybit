<x-app-layout>
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

            <div class="w-full flex gap-12 sm:gap-16 items-center flex-wrap">
                @forelse ($posts as $post)
                    <div class="2xl:w-4/12 max-w-4xl flex-grow flex">
                        @include('posts.partials._post-card-horizontal', compact('post'))
                    </div>
                @empty
                    @include('layouts.partials._empty')
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
