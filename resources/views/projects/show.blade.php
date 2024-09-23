<x-app-layout>
    <x-slot name="title">{{ $project->meta('title') }}</x-slot>

    <x-slot name="description">{{ $project->meta('description') }}</x-slot>

    <x-slot name="keywords">{{ $project->meta('keywords') }}</x-slot>

    <x-slot name="image">{!! $project->meta('image') !!}</x-slot>
    
    <x-slot name="heading">{{ $project->title }}</x-slot>

    <x-slot name="head">
        @if (! $project->translated())
            <link rel="canonical" href="{{ localized_url($project->locales()[0] ?? app()->getLocale()) }}" />
        @endif
    </x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('projects.index')">{{ __('Projects') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit($project->title, 17) }}</x-breadcrumb>
    </x-slot>

    <article class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col lg:flex-row sm:gap-4 max-sm:divide-y">
            <div class="lg:rounded-md flex-grow w-full lg:w-8/12 2xl:w-9/12 overflow-hidden">
                @if($project->images->count())
                    <div class="dark:bg-dark-800">
                        <x-slider class="min-[2561px]:rounded-2xl min-[2561px]:container min-[2561px]:mx-auto">
                            <ul class="glide__slides w-full">
                                @foreach ($project->images as $image)
                                    <li class="glide__slide h-full relative">
                                        <x-curator-glider :media="$image" format="webp" width="1920" height="1080" fit="crop" quality="70" class="w-full aspect-video object-cover" :alt="$project->title" />
                                    </li>
                                @endforeach
                            </ul>
                        </x-slider>
                    </div>
                @endif

                <div class="prose prose-zinc dark:prose-invert xl:ltr:prose-lg bg-white dark:bg-dark-700/60 pt-8 px-4 md:px-6 xl:px-8 max-w-full">
                    <h3>{{ $project->title }}</h3>
                    
                    <p>{{ $project->subtitle }}</p>
                </div>
                
                @if ($project->attributes)
                    <div class="prose prose-zinc dark:prose-invert xl:ltr:prose-lg bg-white dark:bg-dark-700/60 max-w-full pt-12 pb-4">
                        <div class="w-full border-t border-b overflow-hidden dark:border-dark-700">
                            <table class="w-full divide-y bg-secondary-50 dark:bg-dark-700/70 my-0 text-base">
                                @foreach ($project->attributes as $attribute)
                                    <tr class="even:bg-white even:dark:bg-dark-800/40 dark:border-dark-700">
                                        <td class="p-4 md:p-6 xl:px-8 font-semibold align-middle">{{ optional($attribute)['key'] }}</td>
                                        <td class="p-4 md:p-6 xl:px-8 w-full">{{ optional($attribute)['value'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
                
                <div class="prose prose-zinc dark:prose-invert xl:ltr:prose-lg bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 max-w-full text-justify">
                    {!! html($project->description) !!}
                </div>
            </div>
            
            <div class="flex-grow max-w-full w-full lg:w-4/12 2xl:w-3/12 flex flex-col overflow-hidden max-lg:divide-y lg:gap-4 dark:border-dark-700">
                <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                    <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Share this project') }}</h3>
                    
                    @include('layouts.partials._share-buttons')
                </div>
                
                @if ($latest_projects->count())
                    <div class="bg-white dark:bg-dark-700/60 p-4 md:p-6 xl:p-8 lg:rounded-md gap-3 dark:border-dark-700 max-lg:py-10 flex flex-col">
                        <h3 class="uppercase font-semibold text-lg text-gray-800 dark:text-dark-100 mb-2 lg:mb-3">{{ __('Our latest projects') }}</h3>
                        @foreach ($latest_projects as $project)
                            <x-link :href="route('projects.show', $project)">{{ $project->title }}</x-link>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </article>
</x-app-layout>
