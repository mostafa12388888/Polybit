<x-app-layout>
    <x-slot name="title">{!! __(':query - Search results', ['query' => request()->q]) !!}</x-slot>

    <x-slot name="heading">{!! __('Search results') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ __('Search') }}</x-breadcrumb>
    </x-slot>


    <section class="container mx-auto flex flex-col gap-4 py-4">

            @forelse ($results ?? [] as $result)
                @if ($result instanceof \App\Models\Product)
                    <x-link href="{{ route('products.show', $result) }}" styling="white" class="py-6 flex gap-2 lg:gap-4 items-center rounded-md">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="100" height="100" fit="crop" quality="70" class="rounded-md overflow-hidden aspect-square object-cover" :alt="$result->name" />
        
                        <div class="flex flex-col gap-2">
                            <p class="font-semibold text-lg">{{ $result->name }}</p>
                            
                            @if ($result->price)
                                <p>{{ Number::format($result->price) }} <span class="text-sm">{{ __('E£') }}</span></p>
                            @endif

                            <p class="font-light line-clamp-2">{{ str()->limit(text($result->description), 250) }}</p>
                        </div>
                    </x-link>
                @elseif($result instanceof \App\Models\Post)
                    <x-link href="{{ route('posts.show', $result) }}" styling="white" class="py-6 flex gap-2 lg:gap-4 items-center rounded-md">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="100" height="100" fit="crop" quality="70" class="rounded-md overflow-hidden aspect-square object-cover" :alt="$result->title" />
        
                        <div class="flex flex-col gap-2">
                            <p class="font-semibold text-lg">{{ $result->title }}</p>
                            
                            <p class="font-light line-clamp-2">{{ str()->limit(text($result->body), 250) }}</p>
                        </div>
                    </x-link>
                @elseif($result instanceof \App\Models\Project)
                    <x-link href="{{ route('projects.show', $result) }}" styling="white" class="py-6 flex gap-2 lg:gap-4 items-center rounded-md">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="100" height="100" fit="crop" quality="70" class="rounded-md overflow-hidden aspect-square object-cover" :alt="$result->title" />
        
                        <div class="flex flex-col gap-2">
                            <p class="font-semibold text-lg">{{ $result->title }}</p>

                            <p class="font-light line-clamp-2">{{ str()->limit(text($result->subtitle), 250) }}</p>
                        </div>
                    </x-link>
                @elseif($result instanceof \App\Models\BlogCategory)
                    <x-link href="{{ route('blog-categories.show', $result) }}" styling="white" class="py-6 flex gap-2 lg:gap-4 items-center rounded-md0/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="100" height="100" fit="crop" quality="70" class="rounded-md overflow-hidden aspect-square object-cover" :alt="$result->name" />
        
                        <div class="flex flex-col gap-2">
                            <div class="flex-grow flex items-between gap-2">
                                <p class="flex-growfont-semibold text-lg">{{ $result->name }}</p>
                                <x-icons.tag class="opacity-50" />
                            </div>
                            
                            <p class="font-light line-clamp-2">{{ str()->limit(text($result->description), 250) }}</p>
                        </div>
                    </x-link>
                @elseif($result instanceof \App\Models\StoreCategory)
                    <x-link href="{{ route('store-categories.show', $result) }}" styling="white" class="py-6 flex gap-2 lg:gap-4 items-center rounded-md0/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="100" height="100" fit="crop" quality="70" class="rounded-md overflow-hidden aspect-square object-cover" :alt="$result->name" />
        
                        <div class="flex flex-col gap-2">
                            <div class="flex-grow flex items-between gap-2">
                                <p class="flex-growfont-semibold text-lg">{{ $result->name }}</p>
                                <x-icons.tag class="opacity-50" />
                            </div>

                            <p class="font-light line-clamp-2">{{ str()->limit(text($result->description), 250) }}</p>
                        </div>
                    </x-link>
                @endif
            @empty
                <div class="text-center px-6 py-6 dark:border-dark-700/70" wire:loading.remove.block>
                    @if(empty(trim($query)))
                        <x-spinner class="!w-6 !h-6" />
                    @else
                        <p>{{ __('No search results found') }}.</p>
                    @endif
        
                    @error('query')
                        <p class="py-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            @endforelse
    </section>

</x-app-layout>