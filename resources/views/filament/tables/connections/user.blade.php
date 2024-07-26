@php
    $user = $getRecord()->other_partey;
@endphp

<a href="{{ route('filament.dashboard.resources.users.view', ['record' => $user]) }}" class="flex w-full disabled:pointer-events-none justify-start text-start">
    <div class="fi-ta-text-item inline-flex items-center gap-1.5 group/item">
        <span class="fi-ta-text-item-label group-hover/item:underline group-focus-visible/item:underline text-sm leading-6 text-gray-950 dark:text-white">
            {{ $user->name }}
        </span>
    </div>
</a>