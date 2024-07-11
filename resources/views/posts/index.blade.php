<x-app-layout>
    <x-slot name="heading">{{ __('Blog Posts') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">Blog</x-breadcrumb>
    </x-slot>

    <div class="flex-grow bg-white dark:bg-dark-800/70 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">

            <div class="w-full flex gap-12 sm:gap-16 items-center flex-wrap">
                @foreach (range(1, 12) as $item)
                    <div class="2xl:w-4/12 max-w-4xl flex-grow flex">
                        @include('posts.partials._post-card-horizontal')
                    </div>
                @endforeach
            </div>
            
            {{-- <div class="w-full flex gap-4 items-center justify-center flex-wrap">
                @foreach (range(1, 6) as $item)
                    <div class="w-96 max-w-lg flex-grow flex">
                        @include('posts.partials._post-card-vertical')
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>
</x-app-layout>
