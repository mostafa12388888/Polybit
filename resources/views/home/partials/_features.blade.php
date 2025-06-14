<div
    class="bg-white dark:bg-dark-600/40 px-4 sm:px-6 py-12 md:py-20 {{ config('app.theme') == 'theme-1' ? 'xl:py-36' : '' }} relative">
    <div
        class="absolute w-full h-full top-0 left-0 opacity-25 dark:opacity-15 z-0 bg-cover bg-no-repeat bg-center bg-map">
    </div>
    @include('home.partials._cartItem')

    <div
        class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap text-center relative z-10">
        <h1
            class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-4xl font-extrabold relative px-8 z-50">
            {{ __('Spice up your construction game') }}</h1>

        <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden">
            {{ __('Ignite excellence with us in the realm of Expansion Joint Manufacturing!') }}</p>

        <div class="flex flex-wrap w-full flex-grow mt-10 gap-4 lg:gap-6 xl:gap-8">
            <div class="group w-min min-w-full sm:min-w-80 flex flex-col items-center px-8 py-12 flex-grow rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative sm:hover:-translate-y-1 sm:hover:scale-105 transition-transform"
                x-data="{ expanded: false, needsTruncate: false }">
                <span
                    class="group-hover:bg-primary-500 group-hover:text-white group-hover:dark:bg-dark-600 group-hover:dark:text-white transition-colors bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 xl:h-20 xl:w-20 rounded-full mb-4 xl:mb-8">
                    <x-icons.arrow-trending-up class="!w-8 !h-8 xl:!w-10 xl:!h-10" stroke-width="1" />
                </span>

                <h3 class="font-bold text-lg xl:text-xl mb-4">{{ __('Elevate Your Projects') }}</h3>

                <p class="text-justify leading-loose dark:text-dark-200 line-clamp-5 mb-4" x-init="$nextTick(() => needsTruncate = $el.scrollHeight > $el.clientHeight)"
                    :class="expanded ? 'line-clamp-none' : 'line-clamp-5'">{{ __('elevate-your-projects') }}</p>

                <template x-if="needsTruncate">
                    <x-button styling="white" @click="expanded = !expanded"
                        class="text-sm font-semibold w-full bg-white/40">
                        <span x-text="expanded ? '{{ __('Read Less') }}' : '{{ __('Read More') }}'"></span>
                    </x-button>
                </template>
            </div>

            <div class="group w-min min-w-full sm:min-w-80 flex flex-col items-center px-8 py-12 flex-grow rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative sm:hover:-translate-y-1 sm:hover:scale-105 transition-transform"
                x-data="{ expanded: false, needsTruncate: false }">
                <span
                    class="group-hover:bg-primary-500 group-hover:text-white group-hover:dark:bg-dark-600 group-hover:dark:text-white transition-colors bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 xl:h-20 xl:w-20 rounded-full mb-4 xl:mb-8">
                    <x-icons.globe class="!w-8 !h-8 xl:!w-10 xl:!h-10" stroke-width="1" />
                </span>

                <h3 class="font-bold text-lg xl:text-xl mb-4 dark:text-dark-100">{{ __('Sustainability at the Core') }}
                </h3>

                <p class="text-justify leading-loose dark:text-dark-200 line-clamp-5 mb-4" x-init="$nextTick(() => needsTruncate = $el.scrollHeight > $el.clientHeight)"
                    :class="expanded ? 'line-clamp-none' : 'line-clamp-5'">{{ __('sustainability-at-the-core') }}</p>

                <template x-if="needsTruncate">
                    <x-button styling="white" @click="expanded = !expanded"
                        class="text-sm font-semibold w-full bg-white/40">
                        <span x-text="expanded ? '{{ __('Read Less') }}' : '{{ __('Read More') }}'"></span>
                    </x-button>
                </template>
            </div>

            <div class="group w-min min-w-full sm:min-w-80 flex flex-col items-center px-8 pt-12 pb-6 flex-grow rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative sm:hover:-translate-y-1 sm:hover:scale-105 transition-transform"
                x-data="{ expanded: false, needsTruncate: false }">
                <span
                    class="group-hover:bg-primary-500 group-hover:text-white group-hover:dark:bg-dark-600 group-hover:dark:text-white transition-colors bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 xl:h-20 xl:w-20 rounded-full mb-4 xl:mb-8">
                    <x-icons.rocket class="!w-8 !h-8 xl:!w-10 xl:!h-10" stroke-width="1" />
                </span>

                <h3 class="font-bold text-lg xl:text-xl mb-4">{{ __('Shaping the Future') }}</h3>

                <p class="text-justify leading-loose dark:text-dark-200 line-clamp-5 mb-4" x-init="$nextTick(() => needsTruncate = $el.scrollHeight > $el.clientHeight)"
                    :class="expanded ? 'line-clamp-none' : 'line-clamp-5'">{{ __('shaping-the-future') }}</p>

                <template x-if="needsTruncate">
                    <x-button styling="white" @click="expanded = !expanded"
                        class="text-sm font-semibold w-full bg-white/40">
                        <span x-text="expanded ? '{{ __('Read Less') }}' : '{{ __('Read More') }}'"></span>
                    </x-button>
                </template>
            </div>
        </div>

        @if (($page = request()->_page) && $page->body)
            <div
                class="prose prose-zinc dark:prose-invert ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 py-8 px-4 md:px-6 xl:px-8 min-w-full mt-1 xl:mt-0 rounded-xl xl:-mb-10">
                {!! html($page->body) !!}
            </div>
        @endif
    </div>
</div>
