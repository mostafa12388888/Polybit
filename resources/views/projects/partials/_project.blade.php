<x-link href="{{ route('projects.show', $project) }}" class="group flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none shadow !rounded-md overflow-hidden w-full">
    <div class="relative">
        <x-curator-glider fallback="logo" :media="$project->image" format="webp" width="480" height="280" fit="crop" quality="70" class="w-full aspect-video object-cover" :alt="$project->title" loading="{{ ($lazy ?? null) ? 'lazy' : 'eager' }}" />

        <div class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60  flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>
    
    <div class="flex flex-col gap-3 px-6 py-8">
        <h2 class="font-semibold truncate lg:text-lg">{{ $project->title }}</h2>
        <p class="font-light truncate">{{ str()->limit($project->subtitle, 150) }}</p>
    </div>
</x-link>