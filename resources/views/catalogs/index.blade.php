<x-app-layout>
    <x-slot name="title">{!! __('Catalogs') !!}</x-slot>

    <x-slot name="heading">{!! __('Catalogs') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ __('Catalogs') }}</x-breadcrumb>
    </x-slot>
    
    <div class="flex-grow bg-white dark:bg-dark-800 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
            <div class="w-full flex gap-12 sm:gap-16 items-center flex-wrap justify-center">
                @forelse ($catalogs as $catalog)
                    <div class="max-w-4xl flex-grow flex">
                        @include('catalogs.partials._catalog', ['lazy' => $loop->index > 1])
                    </div>
                @empty
                    @include('layouts.partials._empty')
                @endforelse
            </div>

            <div class="w-full mt-6">
                {{ $catalogs->links() }}
            </div>
        </div>
    </div>

    @if (($page = request()->_page) && $page->body)
        <div class="bg-white dark:bg-dark-800 -mt-10 dark:pb-5 md:pb-10 z-10">
            <div class="md:container mx-auto">
                <div class="prose prose-zinc dark:prose-invert bg-primary-50 dark:bg-dark-700/40 py-8 px-4 md:px-6 xl:px-8 min-w-full md:rounded-md">
                    {!! html($page->body) !!}
                </div>
            </div>
        </div>
    @endif
    
    {{-- <x-slot name="scripts">
        @minifyInclude('schema.posts-schema', [
            'title' => $category ?? null ? $category->meta('title') : __('Blog Posts'),
        ])
    </x-slot> --}}
</x-app-layout>
