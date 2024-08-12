<x-link href="#" class="flex-grow group flex max-sm:flex-col gap-6 text-start items-start !p-0 shadow-none overflow-hidden !rounded-none" :href="route('posts.show', $post)">
    <div class="relative flex-shrink-0 rounded-md overflow-hidden">
        <x-curator-glider fallback="logo" :media="$post->image" format="webp" width="480" height="280" fit="crop" quality="70" class="w-full aspect-[8/5] sm:aspect-[8/7] md:aspect-[8/5] sm:w-64 md:w-96 lg:w-96 object-cover" :alt="$post->title" />

        <div class="group-hover:opacity-100 opacity-0 transition-opacity absolute w-full h-full top-0 left-0 bg-dark-900/60 flex items-center justify-center text-white">
            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
        </div>
    </div>

    <div class="flex-grow flex flex-col gap-5">
        <div class="flex flex-col gap-3">
            <h5 class="font-semibold line-clamp-2 text-xl xl:text-xl">{{ $post->title }}</h5>
            <p class="font-light line-clamp-3">{{ str()->limit(text($post->body), 250) }}</p>
        </div>
    
        <div class="flex gap-2 items-center">
            <div class="flex gap-2">
                <x-icons.user class="flex-shrink-0 !w-4 !h-4" />
                <span class="text-sm font-light line-clamp-1">{{ $post->user->name }}</span>
            </div>
            <div class="flex gap-2">
                <x-icons.tag class="flex-shrink-0 !w-4 !h-4" />
                <span class="text-sm font-light line-clamp-1">{{ $post->category->name }}</span>
            </div>
        </div>
        
        <x-button styling="link" class="border dark:border-dark-700">{{ __('Continue Reading') }}</x-button>
    </div>
</x-link>

