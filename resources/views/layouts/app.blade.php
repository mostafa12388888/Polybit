<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ direction() }}" x-ref="html" x-init="
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
    toggleDarkMode(e, status = null){
        console.log(status)
        if(status !== null) {
            this.darkMode = status;
        } else {
            this.darkMode = ! this.darkMode;
        }

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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <style>
            @font-face {
                font-family: 'Klavika';
                font-style: normal;
                font-weight: 100;
                font-display: swap;
                src: url({{ asset('/fonts/klavika-light.woff') }}) format('woff2');
            }
            @font-face {
                font-family: 'Klavika';
                font-style: normal;
                font-weight: 600;
                font-display: swap;
                src: url({{ asset('/fonts/klavika-regular.woff') }}) format('woff2');
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Baloo+Bhaijaan+2:wght@400..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * {
                /* box-shadow: 0 0 0 1px rgba(255, 0, 0, 0.1); */
            }
        </style>
    </head>
    <body class="font-sans rtl:font-sans-ar antialiased text-gray-800 dark:text-dark-100 flex flex-col bg-dark-50 dark:bg-dark-900 dark:border-dark-700 min-h-screen rtl:text-right rtl:dir text-base lg:text-[1.1rem] relative border-gray-100">
        @include('layouts.partials._header')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('layouts.partials._footer')

        @include('layouts.partials._bottom-navbar')
    </body>
</html>
