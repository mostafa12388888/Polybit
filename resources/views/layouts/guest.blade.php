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
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

    @includeIf('layouts.optional._head')

    @if ($icon = setting('favicon') ?: setting('logo'))
        <link rel="shortcut icon" type="image/png" href="{!! $icon->getSignedUrl(['w' => 32, 'h' => 32, 'fm' => 'ico', 'fit' => 'fill-max', 'q' => 70, 'bg' => 'white'], true) !!}">
        <link rel="apple-touch-icon" sizes="180x180" href="{!! $icon->getSignedUrl(['w' => 180, 'h' => 180, 'fm' => 'png', 'fit' => 'fill-max', 'q' => 70, 'bg' => 'white'], true) !!}">
    @endif

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>{{ $title ?: config('app.name', 'App') }}</title>
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
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

        <meta name="twitter:image" content="{!! $image !!}" />
        <meta name="twitter:image:alt" content="{{ $image_alt }}" />
    @endif

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{ $description }}">

    <link rel="canonical" href="{{ $canonical ?? request()->url() }}" />

    @foreach ($alternate_locales as $locale)
        <link rel="alternate" href="{{ localized_url($locale) }}" hreflang="{{ $locale }}"/>
    @endforeach

    @if (app()->getLocale() == 'ar')
        <style>
            @font-face {
                font-family: 'Almarai';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(/fonts/almarai-regular.woff2) format('woff2');
                unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0898-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EFD-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
            }
            @font-face {
                font-family: 'Almarai';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(/fonts/almarai-bold.woff2) format('woff2');
                unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0898-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC, U+102E0-102FB, U+10E60-10E7E, U+10EFD-10EFF, U+1EE00-1EE03, U+1EE05-1EE1F, U+1EE21-1EE22, U+1EE24, U+1EE27, U+1EE29-1EE32, U+1EE34-1EE37, U+1EE39, U+1EE3B, U+1EE42, U+1EE47, U+1EE49, U+1EE4B, U+1EE4D-1EE4F, U+1EE51-1EE52, U+1EE54, U+1EE57, U+1EE59, U+1EE5B, U+1EE5D, U+1EE5F, U+1EE61-1EE62, U+1EE64, U+1EE67-1EE6A, U+1EE6C-1EE72, U+1EE74-1EE77, U+1EE79-1EE7C, U+1EE7E, U+1EE80-1EE89, U+1EE8B-1EE9B, U+1EEA1-1EEA3, U+1EEA5-1EEA9, U+1EEAB-1EEBB, U+1EEF0-1EEF1;
            }
        </style>
    @else
        <style>
            @font-face {
                font-family: 'Klavika';
                font-style: normal;
                font-weight: 200;
                font-display: swap;
                src: url(/fonts/klavika-light.woff) format('woff2');
                size-adjust: 105%;
            }
            @font-face {
                font-family: 'Klavika';
                font-style: normal;
                font-weight: 600;
                size-adjust: 110%;
                font-display: swap;
                font-style: bold;
                src: url(/fonts/klavika-regular.woff) format('woff2');
            }
        </style>
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $head ?? null }}

    @includeIf('layouts.optional._head-end')
</head>

<body class="font-sans rtl:font-sans-ar antialiased text-gray-800 dark:text-dark-100 rtl:text-right">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-secondary-100 dark:bg-dark-900 pattern dark:pattern-dark">

        <div class="w-full sm:max-w-xl sm:shadow-md overflow-hidden sm:rounded-lg flex flex-col dark:bg-dark-800">
            <div class="text-center bg-secondary-50 dark:bg-dark-800 px-6 lg:px-10 py-8">
                <x-link :href="route('home')">
                    <x-application-logo class="h-12 fill-current text-secondary-500" />
                </x-link>
            </div>

            <div class="bg-white dark:bg-dark-700/30 px-6 lg:px-10 py-8">
                {{ $slot }}
            </div>

            @if (($page = request()->_page) && $page->body)
                <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 min-w-full shadow">
                    {!! html($page->body) !!}
                </div>
            @endif

            @if($footer ?? null)
                <div class="text-center bg-secondary-50 dark:bg-dark-800 px-6 lg:px-10 py-8">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>

    @includeIf('layouts.optional._scripts')

    {{ $scripts ?? null }}

    @includeIf('layouts.optional._scripts-end')
</body>
</html>
