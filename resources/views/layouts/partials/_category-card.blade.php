@if ($category->description)
    <div class="flex rounded shadow w-full p-4 gap-4 items-center -mt-6 mb-4">
        <x-curator-glider fallback="logo" :media="$category->image" format="webp" width="480" height="280" fit="crop" quality="70" class="w-full max-w-40 aspect-video object-cover rounded-md" :alt="$category->name"/>

        <div class="text-start">
            <h2 class="text-lg font-semibold">{{ $category->name }}</h2>
            <div>{!! html($category->description) !!}</div>
        </div>
    </div>
@endif