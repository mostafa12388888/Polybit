<span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
    Body
</span>

<div class="p-4 break-all rounded border leading-loose">
    <div class="block">
        {!! $getRecord()->formatted_body() ?: '<div class="opacity-50">No Content</div>' !!}
    </div>
</div>