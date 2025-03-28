<x-app-layout>
    <x-slot name="title">{!! __('Projects') !!}</x-slot>

    <x-slot name="heading">{!! __('Projects') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{__('Projects') }}</x-breadcrumb>
    </x-slot>

    <div class="flex-grow bg-secondary-100/50 dark:bg-dark-800 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
            <div class="w-full flex gap-4 lg:gap-6 items-center justify-center flex-wrap">
                @forelse ($projects as $project)
                    <div class="w-96 max-w-lg flex-grow flex">
                        @include('projects.partials._project', ['lazy' => $loop->index > 1])
                    </div>
                @empty
                    @include('layouts.partials._empty')
                @endforelse
            </div>
            
            <div class="w-full">
                {{ $projects->links() }}
            </div>
        </div>
    </div>

    @if (($page = request()->_page) && $page->body)
        <div class="bg-white dark:bg-dark-800 -mt-5 dark:pb-5 md:pb-10 z-10">
            <div class="lg:container mx-auto">
                <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/40 py-8 px-4 md:px-6 xl:px-8 min-w-full md:rounded-md">
                    {!! html($page->body) !!}
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
