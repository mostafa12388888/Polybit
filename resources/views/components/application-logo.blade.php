@props(['width' => 120])

@if (setting('logo') || setting('darkmode_logo'))
    @php
        $logo = setting('logo') ?: setting('darkmode_logo');
        $darkmode_logo = setting('darkmode_logo') ?: setting('logo');
        $logo_url = $logo?->getSignedUrl(['w' => $width, 'fm' => 'webp', 'q' => 70], false);
        $darkmode_logo_url = $darkmode_logo->getSignedUrl(['w' => $width, 'fm' => 'webp'], false);
        $original_height = $darkmode ? $darkmode_logo->height : $logo->height;
        $original_width = $darkmode ? $darkmode_logo->width : $logo->width;
        $height = ceil($width * $original_height / $original_width);
    @endphp

    <x-img src="{!! $darkmode ? $darkmode_logo_url : $logo_url !!}" x-bind:src="darkMode ? '{!! $darkmode_logo_url !!}' : '{!! $logo_url !!}'" alt="{{ __(':app_name Logo', ['app_name' => config('app.name')]) }}" {{ $attributes->merge(['class' => 'w-auto']) }} width="{{ $width }}" height="{{ $height }}" />
@else
    <h2 class="font-semibold text-lg">{{ config('app.name') }}</h2>
@endif
