<form class="relative flex-grow w-full lg:w-auto lg:max-w-2xl xl:max-w-4xl" 
    action="{{ route('search') }}"
    x-data="{
        visible: false,
        focused: false,
        focus () { 
            this.focused = true
        },
        focusOut () { 
            this.focused = false
        },
        reset () {
            this.focusOut()
            search = null
        }
    }"
    @click.outside="focused || visible ? reset() : ''"
    @keyup.escape.window="focused || visible ? reset() : ''"
    x-init="$watch('search', value => setTimeout(() => visible = value, 1))"
    x-trap.inert.noscroll="focused || visible"
    @keydown.down="$focus.wrap().next()"
    @keydown.up="$focus.wrap().previous()"
>
    <!-- Overlay -->
    <div wire:ignore class="bg-dark-800/40 fixed top-0 bottom-0 left-0 right-0"
        x-cloak x-show="focused" x-transition.opacity @click.stop="reset"></div>

    <div>
        <x-input styling="solid" type="search" 
            name="q" id="query" placeholder="{{ __('Search...') }}" 
            wire:model.live.debounce.750ms="query" :value="$query" 
            @input="$el.value ? focus() : focusOut()" 
            class="relative dark:focus:bg-dark-600/70 focus:border-primary-300 dark:focus:border-transparent border-transparent outline-none px-4 py-2.5 w-full ltr:pr-20 rtl:pl-20"
            x-bind:class="focused ? '!rounded-b-none !border-x-transparent !border-t-transparent' : ''" 
            autocomplete="off" />

        <div class="search-results absolute bg-white dark:bg-dark-600 w-full shadow-xl rounded-b-md divide-y overflow-hidden max-h-[480px] overflow-y-auto"
            x-cloak x-bind:class="focused ? 'block' : 'hidden'">
            @forelse ($results ?? [] as $result)
                @if ($result instanceof \App\Models\Product)
                    <x-link href="{{ route('products.show', $result) }}" styling="white" class="flex gap-2 items-center rounded-none dark:border-dark-600/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="50" height="50" fit="crop" quality="70" class="rounded aspect-square object-cover" :alt="$result->name" />

                        <div>
                            <p>{{ $result->name }}</p>
                            
                            @if ($result->price)
                                <p>{{ Number::format($result->price) }} <span class="text-sm">{{ __('E£') }}</span></p>
                            @endif
                        </div>
                    </x-link>
                @elseif($result instanceof \App\Models\Post)
                    <x-link href="{{ route('posts.show', $result) }}" styling="white" class="flex gap-2 items-center rounded-none dark:border-dark-600/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="50" height="50" fit="crop" quality="70" class="rounded aspect-square object-cover" :alt="$result->title" />

                        <p>{{ $result->title }}</p>
                    </x-link>
                @elseif($result instanceof \App\Models\Project)
                    <x-link href="{{ route('projects.show', $result) }}" styling="white" class="flex gap-2 items-center rounded-none dark:border-dark-600/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="50" height="50" fit="crop" quality="70" class="rounded aspect-square object-cover" :alt="$result->title" />

                        <p>{{ $result->title }}</p>
                    </x-link>
                @elseif($result instanceof \App\Models\BlogCategory)
                    <x-link href="{{ route('blog-categories.show', $result) }}" styling="white" class="flex gap-2 items-center rounded-none dark:border-dark-600/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="50" height="50" fit="crop" quality="70" class="rounded aspect-square object-cover" :alt="$result->name" />

                        <div class="flex-grow flex items-between gap-2">
                            <p class="flex-grow">{{ $result->name }}</p>
                            <x-icons.tag class="opacity-50" />
                        </div>
                    </x-link>
                @elseif($result instanceof \App\Models\StoreCategory)
                    <x-link href="{{ route('store-categories.show', $result) }}" styling="white" class="flex gap-2 items-center rounded-none dark:border-dark-600/50">
                        <x-curator-glider fallback="logo" :media="$result->image" format="webp" width="50" height="50" fit="crop" quality="70" class="rounded aspect-square object-cover" :alt="$result->name" />

                        <div class="flex-grow flex items-between gap-2">
                            <p class="flex-grow">{{ $result->name }}</p>
                            <x-icons.tag class="opacity-50" />
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

            <div class="px-6 py-6 text-center dark:border-dark-700/70" wire:loading.block>
                <x-spinner class="!w-6 !h-6" />
            </div>

            {{-- @if (! empty(trim($query)))
                <div class="w-full sticky bottom-0 p-4 flex gap-1 flex-wrap items-center justify-center bg-white dark:bg-dark-700 dark:border-dark-700/70">
                    <x-button styling="link" size="sm">{{ __('All Results') }}</x-button>
                </div>
            @endif --}}
        </div>
    </div>

    <x-button styling="link" class="absolute top-0 ltr:right-0 rtl:left-0 z-10 h-full px-6 ltr:rounded-l-none rtl:rounded-r-none ltr:border-l rtl:border-r border-primary-200/40 dark:border-dark-800/20 focus:bg-secondary-200/70 focus:dark:bg-dark-700"
        x-bind:class="focused ? '!rounded-b-none' : ''">
        <x-icons.search class="" class="!w-5 !h-5"/>
        <span class="sr-only">{{ __('Search') }}</span>
    </x-button>
</form>
