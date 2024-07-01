<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('app.direction', request()->dir == 'rtl' ? 'rtl' : 'ltr') }}" x-ref="html" x-init="
    if (@js($darkmode) === null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        toggleDarkMode();
    }
" class="{{ $darkmode ? 'dark' : '' }}" x-bind:class="{'dark': darkMode}" x-data="{
    darkMode: @js($darkmode),
    search: null,
    toggleSearch(){
        if(this.search === null) {
            this.search = $refs.search.offsetParent !== null;
        }
        this.search = ! this.search;
    },
    toggleDarkMode(){
        this.darkMode = ! this.darkMode;
        Cookies.set('darkMode', this.darkMode);
        $dispatch('darkModeToggled');
    }
}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * {
                /* box-shadow: 0 0 0 1px rgba(255, 0, 0, 0.1); */
            }
        </style>
    </head>
    <body class="font-sans rtl:font-sans-ar antialiased text-gray-800 dark:text-dark-100 flex flex-col bg-gray-100 dark:bg-dark-900 dark:border-dark-700 min-h-screen rtl:text-right rtl:dir text-[0.9rem] lg:text-base relative">
        @include('layouts.partials._header')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('layouts.partials._footer')
    </body>
</html>
