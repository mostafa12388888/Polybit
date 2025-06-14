<x-app-layout>
    <x-slot name="title">{!! __('Frequently asked questions') !!}</x-slot>
    
    <x-slot name="heading">{!! __('Frequently asked questions') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ __('FAQ') }}</x-breadcrumb>
    </x-slot>

    <section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 sm:p-4 md:px-4 md:py-8 lg:py-12 relative">
        <div class="container mx-auto flex flex-col lg:flex-row gap-4 mb-6 max-md:mt-6">
            <div class="max-w-4xl flex-grow w-full lg:w-8/12 2xl:w-9/12 flex flex-col gap-4 max-sm:px-4">
                <h2 class="font-semibold text-lg uppercase text-gray-800 dark:text-dark-100">{{ __('Find answers to frequently asked questions.') }}</h2>
                <p>{{ __('Welcome to our FAQ page! Here, you\'ll find answers to the most common questions about our services and products. If you can\'t find the information you\'re looking for, please feel free to contact our support team.') }}</p>
            </div>
        </div>

        <div class="container mx-auto flex flex-col lg:flex-row gap-4 lg:gap-6">
            <div class="flex-grow w-full lg:w-8/12 2xl:w-9/12 flex flex-col gap-4 max-sm:p-4">
                @foreach ($faqs as $faq)
                    <div class="bg-white dark:bg-dark-700/60 rounded-md  flex flex-col" x-data="{ expanded: false }">
                        <button class="text-start py-4 px-2 md:px-4 xl:px-6 flex items-center gap-2" @click="expanded = ! expanded">
                            @if (direction() == 'rtl')
                                <x-icons.chevron-left x-show="! expanded" />
                            @else
                                <x-icons.chevron-right x-show="! expanded" />
                            @endif

                            <x-icons.chevron-down x-cloak x-show="expanded" />
    
                            <h2 class="font-semibold text-gray-800 dark:text-dark-100">{{ $faq->question }}</h2>
                        </button>
                        <div x-show="expanded" x-cloak x-collapse>
                            <div class="pb-6 px-4 md:px-6 xl:px-8 prose prose-zinc dark:prose-invert max-w-full">
                                {!! html($faq->answer) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex-grow max-w-full w-full lg:w-4/12 2xl:w-3/12 flex flex-col overflow-hidden max-lg:divide-y lg:gap-4">
                @include('layouts.partials._contact-card')
            </div>
        </div>

        @if (($page = request()->_page) && $page->body)
            <div class="lg:container mx-auto lg:pt-10">
                <div class="prose prose-zinc dark:prose-invert bg-primary-50 dark:bg-dark-700/40 py-8 px-4 md:px-6 xl:px-8 min-w-full md:rounded-md">
                    {!! html($page->body) !!}
                </div>
            </div>
        @endif
    </section>

    <section class="flex-grow bg-dark-100 sm:bg-white dark:bg-dark-700/25 dark:sm:bg-dark-700/50 sm:p-2 md:p-4 lg:py-4 pattern dark:pattern-dark">
        <div class="container mx-auto">
            <x-link :href="route('posts.index')" class="max-w-2xl mx-auto flex-grow justify-center w-full lg:w-8/12 2xl:w-9/12 flex items-center gap-4 !py-6 max-sm:px-4">
                <div class="shrink-0 opacity-80">
                    <svg fill="currentColor" width="70px" height="70px" viewBox="0 0 32 32">
                        <path d="M16,6l-13,0c-0.552,0 -1,0.448 -1,1l0,22c0,0.552 0.448,1 1,1l22,0c0.552,0 1,-0.448 1,-1l0,-13c0,-0.552 -0.448,-1 -1,-1c-0.552,-0 -1,0.448 -1,1l0,12c0,0 -20,0 -20,0c0,0 0,-20 0,-20c-0,0 12,0 12,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Zm-9,19l14,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-14,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-0,-4l4,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm22.707,-13.293c0.391,-0.39 0.391,-1.024 0,-1.414l-4,-4c-0.39,-0.391 -1.024,-0.391 -1.414,-0l-10,10c-0.14,0.139 -0.235,0.317 -0.274,0.511l-1,5c-0.065,0.328 0.037,0.667 0.274,0.903c0.236,0.237 0.575,0.339 0.903,0.274l5,-1c0.194,-0.039 0.372,-0.134 0.511,-0.274l10,-10Zm-22.707,9.293l4,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm0,-4l5,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-5,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z"/>
                    </svg>
                </div>

                <div class="flex flex-col gap-2">
                    <h2 class="font-semibold text-lg uppercase text-gray-800 dark:text-dark-100">{{ __('Explore Our Blog.') }}</h2>
                    <p>{{ __('For more in-depth articles, updates, and insights into our services and industry trends, be sure to visit our blog.') }}</p>
                </div>
            </x-link>
        </div>
    </section>

    <x-slot name="scripts">
        @minifyInclude('schema.faq-schema')
    </x-slot>
</x-app-layout>
