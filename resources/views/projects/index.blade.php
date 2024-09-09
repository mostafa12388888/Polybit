<x-app-layout>
    <x-slot name="title">{{ __('Projects') }}</x-slot>

    <x-slot name="heading">{{ __('Projects') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{__('Projects') }}</x-breadcrumb>
    </x-slot>

    <div class="flex-grow bg-gray-100 dark:bg-dark-800/70 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
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
</x-app-layout>
