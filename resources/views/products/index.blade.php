<x-app-layout>
    <div class="w-full flex gap-4 items-center justify-center">
        @foreach (range(1, 8) as $item)
            <x-link class="flex-grow flex flex-col items-center p-6 border" :href="route('products.show', str()->slug(fake()->sentence(3)))">
                {{ str()->title(fake()->sentence(3)) }}
            </x-link>
        @endforeach
    </div>
</x-app-layout>
