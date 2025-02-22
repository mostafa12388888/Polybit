<x-app-layout>
    <x-slot name="title">{!! __('Shopping Cart') !!}</x-slot>

    <x-slot name="heading">{!! __('Shopping Cart') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :href="route('products.index')">{{ __('Products') }}</x-breadcrumb>
        <x-breadcrumb :last="true">{{ __('Shopping Cart') }}</x-breadcrumb>
    </x-slot>

    <livewire:cart />

    <x-slot name="scripts">
        <!-- Event snippet for عملية شراء conversion page
        In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
        <script>
            function gtag_report_conversion(url) {
                var callback = function () {
                    if (typeof(url) != 'undefined') {
                        window.location = url;
                    }
                };
                gtag('event', 'conversion', {
                    'send_to': 'AW-16825848814/-GO9CNTouowaEO6nmNc-',
                    'transaction_id': '',
                    'event_callback': callback
                });
                return false;
            }
        </script>
    </x-slot>
</x-app-layout>
