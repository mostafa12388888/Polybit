<x-link class="group flex-grow flex flex-col text-start !p-0 bg-white dark:bg-dark-700/70 dark:shadow-none overflow-hidden !rounded-md" :href="route('posts.show', $post)">
    <div class="relative">
        <x-curator-glider fallback="logo" :media="$post->image" format="webp" width="480" height="280" fit="crop" quality="70" class="w-full max-sm:aspect-video sm:h-44 md:h-56 lg:h-72 xl:h-56 2xl:h-72 object-cover" :alt="$post->title" />

        <div class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60 flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>

    <div class="flex flex-col gap-3 px-6 pt-8 pb-6">
        <h5 class="font-semibold truncate lg:text-lg">{{ str()->title(fake()->sentence(3)) }}</h5>
        <p class="font-light line-clamp-2">{{ fake()->sentence(20) }}</p>
    </div>

    <div class="flex gap-2 items-center border-t border-dark-100 dark:border-dark-600/80 px-6 py-6">
        <div class="flex gap-2">
            <x-icons.user class="flex-shrink-0 !w-4 !h-4" />
            <span class="text-sm font-light line-clamp-1">{{ str()->limit(str()->title(fake()->sentence(2)), 240) }}</span>
        </div>
        <div class="flex gap-2">
            <x-icons.tag class="flex-shrink-0 !w-4 !h-4" />
            <span class="text-sm font-light line-clamp-1">{{ str()->limit(str()->title(fake()->sentence(3)), 240) }}</span>
        </div>
    </div>
</x-link>
