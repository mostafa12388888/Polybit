<x-link href="{{ route('projects.show', str()->slug(fake()->sentence(4))) }}" class="group flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none shadow !rounded-md overflow-hidden">
    <div class="relative">
        <img loading="lazy" src="{{ asset('storage/slide'. rand(1,3) .'.webp') }}" class="w-full aspect-video object-cover" alt="">

        <div class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60  flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>
    
    <div class="flex flex-col gap-3 px-6 py-8">
        <h5 class="font-semibold truncate lg:text-lg">{{ str()->title(fake()->sentence(3)) }}</h5>
        <p class="font-light truncate">{{ str()->title(fake()->sentence(3)) }}</p>
    </div>
</x-link>