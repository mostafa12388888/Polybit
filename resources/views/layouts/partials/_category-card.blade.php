@if ($category->description)
    <div class="flex flex-col sm:flex-row rounded shadow bg-white dark:bg-dark-700 w-full p-4 gap-4 items-center -mt-6 mb-8">
        <x-curator-glider fallback="logo" :media="$category->image" format="webp" width="480" height="280" fit="crop" quality="70" class="w-full sm:max-w-40 aspect-video object-cover rounded-md" :alt="$category->name"/>

        <div class="text-start flex flex-col gap-3">
            <h2 class="text-lg font-semibold">{{ $category->name }}</h2>

            <div x-data="{ expanded: false, needsTruncate: false }" 
                class="relative max-h-36 overflow-hidden" 
                    x-init="$nextTick(() => needsTruncate = $el.scrollHeight > $el.clientHeight)"
                    :class="expanded ? '!max-h-full pb-12' : '!max-h-36'">

                <div class="leading-loose dark:text-dark-200">{!! html($category->description) !!}</div>

                <template x-if="needsTruncate">
                    <div class="bg-white dark:bg-dark-700 w-full absolute bottom-0">
                        <x-button styling="light" @click="expanded = !expanded" 
                            class="text-sm font-semibold w-full md:max-w-xs mt-2 dark:!bg-dark-600/50">
                            <span x-text="expanded ? '{{ __('Read Less') }}' : '{{ __('Read More') }}'"></span>
                        </x-button>
                    </div>
                </template>
            </div>
        </div>
    </div>
@endif