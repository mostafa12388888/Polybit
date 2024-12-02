<div class="bg-white dark:bg-dark-600/40 md:p-6 relative">
    <x-slider class="md:rounded-lg md:container md:mx-auto md:shadow">
        <ul class="glide__slides h-72 sm:h-80 md:h-[22rem] lg:h-[25rem] xl:h-[30rem] 2xl:h-[34rem] min-[2561px]:h-[30rem]">
            @foreach ($slides as $slide)
                <li class="glide__slide h-full relative">
                    <div class="w-full h-full">
                        @if ($slide->title || $slide->description || $slide->actions)
                            <div class="absolute w-full h-full top-0 left-0"></div>

                            <div class="absolute w-full h-full p-8 md:py-20 md:px-24 flex flex-col gap-4 md:gap-6 xl:gap-8 justify-end" x-cloak>
                                <div class="bg-white/95 dark:bg-dark-700/95 w-fit max-w-2xl min-w-sm shadow rounded p-8 space-y-4">
                                    <h2 class="dark:text-dark-50 text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold">{{ $slide->title }}</h2>

                                    <p class="dark:text-dark-50 text-base xl:text-lg w-full max-w-6xl line-clamp-2 xl:line-clamp-3">{{ $slide->description }}</p>

                                    @if (is_array($slide->actions) && $slide->actions)
                                        <div class="flex gap-4 flex-wrap items-center">
                                            @foreach ($slide->actions as $action)
                                                @if ($action['text'] && $action['url'])
                                                    <x-link :styling="$loop->first ? 'primary' : 'white'" class="lg:px-6 lg:py-2 lg:text-lg opacity-80 hover:opacity-100 transition-opacity {{ ! $loop->first ? 'dark:!bg-dark-100 dark:hover:!bg-dark-200 dark:!text-dark-700 dark:hover:!text-dark-800' : '' }}" href="{!! $action['url'] !!}">{{ $action['text'] }}</x-link>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <x-curator-glider :media="$slide->image" format="webp" width="1280" height="480" fit="crop" quality="70" class="w-full h-full object-cover" :alt="config('app.name')" loading="{{ $loop->index ? 'lazy' : 'eager' }}" fetchpriority="{{ $loop->index ? 'auto' : 'high' }}" />
                    </div>
                </li>
            @endforeach
        </ul>
    </x-slider>
</div>
