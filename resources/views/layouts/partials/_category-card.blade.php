@if ($category->description)
    <div class="flex flex-col sm:flex-row rounded shadow bg-white dark:bg-dark-700 w-full p-4 gap-4 items-center -mt-6 mb-8">
        <x-curator-glider fallback="logo" :media="$category->image" format="webp" width="480" height="280" fit="crop" quality="70" class="w-full sm:max-w-40 aspect-video object-cover rounded-md" :alt="$category->name"/>

        <div class="text-start flex flex-col gap-3">
            <h2 class="text-lg font-semibold">{{ $category->name }}</h2>
            <div>{!! html($category->description) !!}</div>
        </div>
    </div>
@endif