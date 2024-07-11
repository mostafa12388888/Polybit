<x-slider>
    <ul class="glide__slides h-72 sm:h-80 md:h-96 lg:h-[30rem] xl:h-[34rem] 2xl:h-[42rem] min-[2561px]:h-[34rem]">
        @foreach (range(1,3) as $slide)
            <li class="glide__slide h-full relative">
                <div class="w-full h-full">
                    <div class="absolute w-full h-full top-0 left-0 bg-dark-900/60 dark:bg-dark-900/60"></div>

                    <div class="absolute w-full h-full p-8 md:p-24 flex flex-col gap-4 md:gap-6 xl:gap-8 items-center justify-center text-center">
                        <h2 class="text-gray-50 dark:text-dark-50 text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold">{{ str()->title(fake()->sentence(3)) }}</h2>

                        <p class="text-gray-50 dark:text-dark-50 text-base md:text-lg xl:text-xl w-full max-w-6xl line-clamp-2 xl:line-clamp-3">{{ fake()->paragraph(5) }}</p>

                        <div class="flex gap-4 flex-wrap items-center justify-center">
                            @foreach (array_filter(range(0, rand(1,2))) as $item)
                                <x-link styling="white" class="lg:px-6 lg:py-2 lg:text-lg opacity-80 hover:opacity-100 transition-opacity dark:!bg-dark-100 dark:hover:!bg-dark-200 dark:!text-dark-700 dark:hover:!text-dark-800" href="#">{{ str()->title(fake()->sentence(2)) }}</x-link>
                            @endforeach
                        </div>
                    </div>

                    <img loading="lazy" src="{{ asset('storage/slide' . $slide . '.webp') }}" class="w-full h-full object-cover" alt="">
                </div>
            </li>
        @endforeach
    </ul>
</x-slider>
