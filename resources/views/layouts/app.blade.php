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
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

        @if ($icon = setting('favicon') ?: setting('logo'))
            <link rel="shortcut icon" type="image/png" href="{!! $icon->getSignedUrl(['w' => 32, 'h' => 32, 'fm' => 'ico', 'fit' => 'fill-max']) !!}">
        @endif

        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <title>{{ $title }}</title>
        <meta name="description" content="{{ $description ?? setting('app_description') }}" />

        @if($keywords ?? null)
            <meta name="keywords" content="{{ $keywords }}" />
        @endif

        <meta property="og:type" content="website" />
        <meta property="og:locale" content="{{ app()->getLocale() }}" />
        <meta property="og:site_name" content="{{ config('app.name') }}" />
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:url" content="{{ request()->url() }}" />
        
        @if ($image)
            <meta property="og:image" content="{!! $image !!}" />
            <meta property="og:image:height" content="1200" />
            <meta property="og:image:width" content="630" />

            <meta name="twitter:image" content="{!! $image !!}" />
            <meta name="twitter:image:alt" content="{{ $image_alt }}" />
        @endif

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="{{ $title }}" />
        <meta name="twitter:description" content="{{ $description }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <style>
            @font-face {
                font-family: 'Klavika';
                font-style: normal;
                font-weight: 400;
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

        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Baloo+Bhaijaan+2:wght@400..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{ $head ?? null }}
    </head>
    <body class="font-sans rtl:font-sans-ar antialiased text-gray-800 dark:text-dark-100 flex flex-col bg-dark-50 dark:bg-dark-900 dark:border-dark-700 min-h-screen rtl:text-right rtl:dir text-base relative border-gray-100">
        @include('layouts.partials._header')

        <main class="flex-grow flex flex-col">
            @if ($heading ?? null)
                <div class="px-4 sm:px-6 bg-white dark:bg-dark-800 shadow-sm z-10 relative overflow-hidden">
                    <div class="absolute w-full h-full top-0 left-0 opacity-50 dark:opacity-100 z-20 bg-cover bg-no-repeat bg-center pointer-events-none" style="background-image: url('/images/header-background.webp');"></div>

                    <div class="container mx-auto py-10 lg:py-12">
                        <h1 class="uppercase font-semibold text-xl lg:text-2xl text-gray-800 dark:text-dark-100 leading-tight">
                            {{ $heading }}
                        </h1>
                    </div>
                </div>
            @endif
            
            @if ($breadcrumbs ?? null)
                <div class="px-4 sm:px-6 bg-white dark:bg-dark-800 shadow-sm z-20">
                    <div class="border-t border-dark-100 dark:border-dark-700/50">
                        <div class="container mx-auto py-3 text-sm flex items-center gap-2">
                            <x-breadcrumb class="flex items-center justify-center gap-1.5" :href="route('home')">
                                <x-icons.home class="!w-5 !h-5" stroke-width="1" /> 
                                <span>{{ __('Home') }}</span>
                            </x-breadcrumb>

                            {{ $breadcrumbs }}
                        </div>
                    </div>
                </div>
            @endif
            
            {{ $slot }}
        </main>

        @include('layouts.partials._footer')

        @include('layouts.partials._bottom-navbar')
    </body>
</html>
