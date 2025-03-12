<section class="bg-white dark:bg-dark-800 -mt-10 lg:-mt-16 z-10">
    <section class="bg-secondary-100/70 dark:bg-dark-700/20 z-10 pattern">
        <div class="h-5 bg-contain bg-center divider dark:hidden"></div>
    
        <div class="px-4 sm:px-6 py-12 dark:py-14 relative">
            <div class="sm:container flex flex-wrap items-center justify-center mx-auto relative z-10">
                <div class="flex flex-col flex-wrap w-full flex-grow gap-y-4 gap-x-4 lg:gap-x-6 justify-center sm:flex-row">
                    @foreach (setting('stats') as $stat)
                        @if (optional($stat)['url'])
                            <a href="{{ $stat['url'] }}" target="_blank" rel="noopener nofollow" class="flex-grow flex gap-8 items-center bg-white dark:bg-dark-700/30 lg:bg-white/70 rounded-xl min-w-40 px-2 sm:hover:-translate-y-1 transition-transform">
                        @else
                            <div class="flex-grow flex gap-8 items-center bg-white dark:bg-dark-700/30 lg:bg-white/70 rounded-xl min-w-40 px-2">
                        @endif
                            @if ($stat['icon'])
                                <div class="ltr:border-r rtl:border-l dark:border-dark-700">
                                    <x-filament::icon icon="{{ $stat['icon'] }}" class="!w-12 !h-12 flex-shrink-0 my-2 mx-8" stroke-width="1.2" />
                                </div>
                            @else
                                <div class="ltr:border-r rtl:border-l border-transparent">
                                    <span class="w-12 h-12 flex-shrink-0 my-2 mx-10 md:mx-8"></span>
                                </div>
                            @endif

                            <div class="flex flex-col gap-4 xl:gap-5 p-4 py-12">
                                @if (ctype_digit($stat['count']))
                                    <p class="font-bold text-3xl md:text-4xl min-w-32" x-data="{ count: 0 }" 
                                        x-intersect="
                                            let t = $el.dataset.target / 50; 
                                            let i = setInterval(() => { 
                                                count += t;
                                                if (count >= $el.dataset.target) { 
                                                    count = $el.dataset.target; 
                                                    clearInterval(i); 
                                                }
                                            }, 20)
                                        " 
                                        x-bind:data-target="{{ $stat['count'] }}" 
                                        x-text="Math.floor(count)"
                                    >{{ $stat['count'] }}</p>
                                @else
                                    <p class="font-bold text-3xl md:text-4xl min-w-32">{{ $stat['count'] }}</p>
                                @endif

                                <p class="font-light">{{ $stat['title'] }}</p>
                            </div>
                        @if (optional($stat)['url'])
                            </a>
                        @else
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</section>