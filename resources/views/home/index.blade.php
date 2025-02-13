<x-app-layout>
    <x-slot name="title">{!! __('Home') !!}</x-slot>

    @if ($slides->count())
        @if (config('app.theme') == 'theme-1')
            @include('home.partials._top-slider')
        @else
            @include('home.partials._top-slider-2')
        @endif
    @endif

    @include('home.partials._features')

    @if ($products->count())
        @include('home.partials._products')
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
