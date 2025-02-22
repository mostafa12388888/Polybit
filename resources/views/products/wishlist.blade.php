
<x-app-layout>
    <x-slot name="title">{!! __('Wishlist') !!}</x-slot>

    <x-slot name="heading">{!! __('Wishlist') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ __('Wishlist') }}</x-breadcrumb>
    </x-slot>

    <livewire:wishlist />
</x-app-layout>
