@props(['navigate' => true, 'last' => false])

@if ($last)
    <span {{ $attributes->merge(['class' => 'opacity-80']) }}>{{ $slot }}</span>
@else
    <x-link {{ $attributes }}>{{ $slot }}</x-link>
    <x-icons.chevron-right class="!w-3 !h-3"/>
@endif