@props(['width' => 1200])

@if (setting('header_banner') || setting('darkmode_header_banner'))
    @php
        $header_banner = setting('header_banner') ?: setting('darkmode_header_banner');
        $darkmode_header_banner = setting('darkmode_header_banner') ?: setting('header_banner');
        $header_banner_url = $header_banner?->getSignedUrl(['w' => $width, 'fm' => 'webp', 'q' => 70]);
        $darkmode_header_banner_url = $darkmode_header_banner->getSignedUrl(['w' => $width, 'fm' => 'webp']);
        $original_height = $darkmode ? $darkmode_header_banner->height : $header_banner->height;
        $original_width = $darkmode ? $darkmode_header_banner->width : $header_banner->width;
        $height = $original_width ? ceil($width * $original_height / $original_width) : null;
    @endphp

    <x-img src="{!! $darkmode ? $darkmode_header_banner_url : $header_banner_url !!}" x-bind:src="darkMode ? '{!! $darkmode_header_banner_url !!}' : '{!! $header_banner_url !!}'" alt="{{ __(':app_name header_banner', ['app_name' => config('app.name')]) }}" {{ $attributes->merge(array_filter([
        'class' => 'absolute w-full h-full top-0 left-0 object-cover',
        'width' => $width, 
        'height' => $height,
    ])) }} 
    />
@else
    <h2 class="font-semibold text-lg">{{ config('app.name') }}</h2>
@endif
