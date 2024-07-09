<x-app-layout>
    <x-slot name="heading">{{ str()->title(str_replace('-', ' ', request()->page)) }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ str()->limit(str()->title(str_replace('-', ' ', request()->page)), 17) }}</x-breadcrumb>
    </x-slot>

    <article class="flex-grow bg-primary-100 dark:bg-dark-800/70 sm:p-2 md:p-4 lg:py-6 xl:py-8 relative">
        <div class="container mx-auto flex flex-col lg:flex-row sm:gap-4 max-sm:divide-y">
            <div class="lg:rounded-md flex-grow w-full lg:w-8/12 2xl:w-9/12 overflow-hidden">
                <div class="prose prose-zinc dark:prose-invert xl:prose-lg bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 max-w-full">
                    <p>{{ fake()->paragraph(rand(5,10)) }}</p>
                    <p>{{ fake()->paragraph(rand(10,15)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,15)) }}</p>
                    <p>{{ fake()->paragraph(rand(10,15)) }}</p>
                    <h3>{{ str()->title(fake()->sentence(10)) }}</h3>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                    <p>{{ fake()->paragraph(rand(10,25)) }}</p>
                </div>
            </div>
        </div>
    </article>
</x-app-layout>
