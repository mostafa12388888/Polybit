<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ direction() }}" x-ref="html" x-init="
    if (@js($darkmode) === null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        toggleDarkMode();
    }
" class="{{ $darkmode ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Baloo+Bhaijaan+2:wght@400..800&display=swap" rel="stylesheet">

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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans rtl:font-sans-ar antialiased text-gray-800 dark:text-dark-100 rtl:text-right">
        <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-dark-900 pattern dark:pattern-dark">

            <div class="w-full sm:max-w-xl sm:shadow-md overflow-hidden sm:rounded-lg flex flex-col dark:bg-dark-800">
                <div class="text-center bg-gray-50 dark:bg-dark-800 px-6 lg:px-10 py-8">
                    <x-link :href="route('home')">
                        <x-application-logo class="h-12 fill-current text-gray-500" />
                    </x-link>
                </div>

                <div class="bg-white dark:bg-dark-700/30 px-6 lg:px-10 py-8">
                    {{ $slot }}
                </div>

                @if($footer ?? null)
                    <div class="text-center bg-gray-50 dark:bg-dark-800 px-6 lg:px-10 py-8">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
