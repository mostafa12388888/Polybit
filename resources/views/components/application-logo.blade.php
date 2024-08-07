
@if (setting('logo') || setting('darkmode_logo'))
    @php
        $logo = setting('logo') ?: setting('darkmode_logo');
        $darkmode_logo = setting('darkmode_logo') ?: setting('logo');
        $logo_url = $logo?->getSignedUrl(['w' => 120, 'fm' => 'webp'], false);
        $darkmode_logo_url = $darkmode_logo->getSignedUrl(['w' => 120, 'fm' => 'webp'], false);
    @endphp

    <x-img src="{!! $darkmode ? $darkmode_logo_url : $logo_url !!}" x-bind:src="darkMode ? '{!! $darkmode_logo_url !!}' : '{!! $logo_url !!}'" alt="{{ __(':app_name Logo', ['app_name' => config('app.name')]) }}" {{ $attributes }} />
@else
    <h2 class="font-semibold text-lg">{{ config('app.name') }}</h2>
@endif
