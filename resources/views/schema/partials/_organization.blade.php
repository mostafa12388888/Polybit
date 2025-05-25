{
    "@type": "Organization",
    "@id": "{{ config('app.url') }}/#organization",
    "name": "{!! schema_text(config('app.name')) !!}",
    "url": "{{ request()->url() }}",

    @if (setting('logo'))
        "logo": {
            "@type": "ImageObject",
            "@id": "{{ config('app.url') }}/#logo",
            "url": "{!! asset(setting('logo')->getSignedUrl(['border' => '150,FFF,expand', 'w' => '212', 'h' => 212, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp'], true)) !!}",
            "contentUrl": "{!! asset(setting('logo')->getSignedUrl(['border' => '150,FFF,expand', 'w' => '212', 'h' => 212, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp'], true)) !!}",
            "caption": "{!! schema_text(config('app.name')) !!}",
            "inLanguage": "{{ app()->getLocale() }}"
        },
    @endif

    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "Customer Service",
        "telephone": [
            {!! collect(setting('phones') ?? [])->map(fn ($phone) => '"'.$phone.'"')->implode(', ') !!}
        ],
        "email": [
            {!! collect(setting('emails') ?? [])->map(fn ($email) => '"'.$email.'"')->implode(', ') !!}
        ],
        "areaServed": "Worldwide",
        "availableLanguage": ["Arabic", "English"]
    },

    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Al-Khosos",
      "addressLocality": "Al-Khanka Center",
      "addressRegion": "Qalyubia Governorate",
      "postalCode": "13774",
      "addressCountry": "eg"
    }
}
