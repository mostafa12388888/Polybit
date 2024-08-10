<x-app-layout>
    <x-slot name="heading">{{ __('Shopping Cart') }}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ __('Shopping Cart') }}</x-breadcrumb>
    </x-slot>

    <livewire:cart-items />
</x-app-layout>
