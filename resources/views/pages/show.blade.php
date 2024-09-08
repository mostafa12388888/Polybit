<x-app-layout>
    <x-slot name="title">{{ $page->meta('title') }}</x-slot>

    <x-slot name="description">{{ $page->meta('description') }}</x-slot>

    <x-slot name="keywords">{{ $page->meta('keywords') }}</x-slot>

    <x-slot name="image">{!! $page->meta('image') !!}</x-slot>

    <x-slot name="heading">{{ $page->title }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ str()->limit($page->title, 17) }}</x-breadcrumb>
    </x-slot>

    <section class="flex-grow bg-primary-100 dark:bg-dark-800/70 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col lg:flex-row sm:gap-4 max-sm:divide-y">
            <div class="lg:rounded-md flex-grow w-full lg:w-8/12 2xl:w-9/12 overflow-hidden">
                <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 max-w-full">
                    {!! html($page->body) !!}
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        @minifyInclude('schema.page-schema', [
            'title' => $page->meta('title'),
            'description' => $page->meta('description'),
        ])
    </x-slot>
</x-app-layout>
