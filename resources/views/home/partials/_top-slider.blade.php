<x-slider autoplay="5000" slides_count="{{ $slides->count() }}">
    <ul class="glide__slides h-72 sm:h-80 md:h-96 lg:h-[30rem] xl:h-[34rem] 2xl:h-[42rem] min-[2561px]:h-[34rem]">
        @foreach ($slides as $slide)
            <li class="glide__slide h-full relative">
                <div class="w-full h-full">
                    @if ($slide->title || $slide->description || $slide->buttons)
                        @if (($link = $slide->link) && optional($link)['text'] && optional($link)['url'])
                            <a href="{{ $link['url'] }}" class="absolute w-full h-full top-0 left-0 bg-dark-900/60 dark:bg-dark-900/60" title="{{ $link['text'] }}">
                                <span class="sr-only">{{ $link['text'] }}</span>
                            </a>
                        @else
                            <div class="absolute w-full h-full top-0 left-0 bg-dark-900/60 dark:bg-dark-900/60"></div>
                        @endif

                        <div class="pointer-events-none absolute w-full h-full p-8 md:p-24 flex flex-col gap-4 md:gap-6 xl:gap-8 items-center justify-center text-center" x-cloak>
                            <h2 class="text-secondary-50 dark:text-dark-50 text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold">{{ $slide->title }}</h2>

                            <p class="text-secondary-50 dark:text-dark-50 text-base md:text-lg xl:text-xl w-full max-w-6xl line-clamp-2 xl:line-clamp-3">{{ $slide->description }}</p>

                            @if (is_array($slide->buttons))
                                <div class="flex gap-4 flex-wrap items-center justify-center pointer-events-auto">
                                    @foreach ($slide->buttons as $action)
                                        @if (optional($action)['text'] && optional($action)['url'])
                                            <x-link styling="white" class="lg:px-6 lg:py-2 lg:text-lg opacity-80 hover:opacity-100 transition-opacity dark:!bg-dark-100 dark:hover:!bg-dark-200 dark:!text-dark-700 dark:hover:!text-dark-800" href="{!! $action['url'] !!}">{{ $action['text'] }}</x-link>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <x-curator-glider :media="$slide->image" format="webp" width="720" height="240" fit="crop" quality="30" class="w-full h-full object-cover" :alt="$slide->title" loading="{{ $loop->index ? 'lazy' : 'eager' }}" fetchpriority="{{ $loop->index ? 'auto' : 'high' }}" />
                    @else
                        @if (($link = $slide->link) && optional($link)['text'] && optional($link)['url'])
                            <a href="{{ $link['url'] }}" title="{{ $link['text'] }}">
                                <span class="sr-only">{{ $link['text'] }}</span>

                                <x-curator-glider :media="$slide->image" format="webp" width="1280" height="480" fit="crop" quality="70" class="w-full h-full object-cover" :alt="config('app.name')" loading="{{ $loop->index ? 'lazy' : 'eager' }}" fetchpriority="{{ $loop->index ? 'auto' : 'high' }}" />
                            </a>
                        @else
                            <x-curator-glider :media="$slide->image" format="webp" width="1280" height="480" fit="crop" quality="70" class="w-full h-full object-cover" :alt="config('app.name')" loading="{{ $loop->index ? 'lazy' : 'eager' }}" fetchpriority="{{ $loop->index ? 'auto' : 'high' }}" />
                        @endif
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</x-slider>
