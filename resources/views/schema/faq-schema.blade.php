
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            @minifyInclude('schema.partials._place'),
            @minifyInclude('schema.partials._organization'),
            @minifyInclude('schema.partials._website'),
            {
                "@type": "FAQPage",
                "mainEntity": [
                    @foreach ($faqs as $faq)
                        {
                            "@type": "Question",
                            "name": "{!! schema_text($faq->question) !!}",
                            "acceptedAnswer": {
                                "@type": "Answer",
                                "text": "{!! schema_text(text($faq->answer)) !!}"
                            }
                        }{{ $loop->last ? '' : ',' }}
                    @endforeach
                ]
            }
        ]
    }
</script>