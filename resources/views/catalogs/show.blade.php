<x-app-layout>
    <x-slot name="title">{!! $catalog->meta('title') !!}</x-slot>

    <x-slot name="description">{!! $catalog->meta('description') !!}</x-slot>

    <x-slot name="keywords">{!! $catalog->meta('keywords') !!}</x-slot>

    <x-slot name="image">{!! $catalog->meta('image') !!}</x-slot>

    <x-slot name="head">
        <link rel="preload" as="image" href="{!! $catalog->meta('image') !!}" fetchpriority="high" />
    </x-slot>

    <x-slot name="heading">{!! $catalog->title !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('catalogs.index')">{{ __('Catalogs') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ str()->limit($catalog->title, 17) }}</x-breadcrumb>
    </x-slot>

    <livewire:request-catalog :catalog="$catalog" />
</x-app-layout>
