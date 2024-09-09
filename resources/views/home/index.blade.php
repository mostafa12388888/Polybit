<x-app-layout>
    <x-slot name="head">
        <link rel="preload" as="image" href="{!! asset('/images/map.png') !!}" fetchpriority="high" />
    </x-slot>

    @if ($slides->count())
        @include('home.partials._top-slider')
    @endif

    @include('home.partials._features')

    @if ($store_categories->count())
        @include('home.partials._store-categories')
    @endif
    
    @if ($projects->count())
        @include('home.partials._projects')
    @endif
    
    @include('home.partials._contact')
    
    @if ($posts->count())
        @include('home.partials._posts')
    @endif
    
    <x-slot name="scripts">
        @minifyInclude('schema.home-schema')
    </x-slot>
</x-app-layout>
