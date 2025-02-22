<x-app-layout>
    <x-slot name="title">{!! __('Contact Us') !!}</x-slot>

    <x-slot name="heading">{!! __('Contact Us') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ __('Contact Us') }}</x-breadcrumb>
    </x-slot>

    <livewire:contact-us />

    <x-slot name="scripts">
        <!-- Event snippet for call site conversion page
        In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
        <script>
            function gtag_report_conversion(url) {
                var callback = function () {
                    if (typeof(url) != 'undefined') {
                        window.location = url;
                    }
                };
                gtag('event', 'conversion', {
                    'send_to': 'AW-16825848814/ng0MCM6ktpYaEO6nmNc-',
                    'event_callback': callback
                });
                return false;
            }
        </script>
        
        @minifyInclude('schema.contact-us-schema', [
            'title' => __('Contact Us'),
        ])
    </x-slot>
</x-app-layout>