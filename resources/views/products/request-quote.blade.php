<x-app-layout>
    <x-slot name="title">{!! __('Request Quote') !!}</x-slot>

    <x-slot name="heading">{!! __('Request Quote') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ __('Request Quote') }}</x-breadcrumb>
    </x-slot>

    <livewire:request-quote />
</x-app-layout>
