@props(['width' => 640, 'height' => 220])

@if (setting('header_banner') || setting('darkmode_header_banner'))
    @php
        $header_banner = setting('header_banner') ?: setting('darkmode_header_banner');
        $darkmode_header_banner = setting('darkmode_header_banner') ?: setting('header_banner');
        $header_banner_url = $header_banner?->getSignedUrl(['w' => $width, 'h' => $height, 'fit' => 'crop', 'fm' => 'webp', 'q' => 60]);
        $darkmode_header_banner_url = $darkmode_header_banner->getSignedUrl(['w' => $width, 'h' => $height, 'fit' => 'crop', 'fm' => 'webp', 'q' => 60]);
        $header_banner_title = $header_banner?->title;
        $darkmode_header_banner_title = $darkmode_header_banner->title;
    @endphp

    <x-img 
        src="{!! $darkmode ? $darkmode_header_banner_url : $header_banner_url !!}" 
        title="{!! $darkmode ? $darkmode_header_banner_title : $header_banner_title !!}"
        x-bind:src="darkMode ? '{!! $darkmode_header_banner_url !!}' : '{!! $header_banner_url !!}'" 
        x-bind:title="darkMode ? '{!! $darkmode_header_banner_title !!}' : '{!! $header_banner_title !!}'" 
        alt="{{ __(':app_name header_banner', ['app_name' => config('app.name')]) }}" 
        {{ $attributes->merge(array_filter([
            'class' => 'absolute w-full h-full top-0 left-0 object-cover',
            'width' => $width, 
            'height' => $height,
        ])) }} 
    />
@else
    <h2 class="font-semibold text-lg">{{ config('app.name') }}</h2>
@endif
