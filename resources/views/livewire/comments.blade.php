<div class="w-full block relative">
    <div id="fb-root w-full block relative"></div>
    <div class="fb-comments" data-colorscheme="dark" data-href="{{ localized_url(collect(locales(false))->where('default', true)->first()['code'], $url) }}" data-width="100%" data-numposts="5"></div>

    {{-- a Fix for width on safari browser --}}
    <style>
        .fb_iframe_widget_fluid_desktop, .fb_iframe_widget_fluid_desktop span, .fb_iframe_widget_fluid_desktop iframe {
            max-width: 100% !important;
            width: 100% !important;
        }
    </style>
    
    @assets
        <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v5.0"></script>
    @endassets
</div>
