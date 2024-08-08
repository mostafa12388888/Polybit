<x-app-layout>
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
</x-app-layout>
