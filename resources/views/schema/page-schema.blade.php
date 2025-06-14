<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            @minifyInclude('schema.partials._place'),
            @minifyInclude('schema.partials._organization'),
            @minifyInclude('schema.partials._website'),
            {
                "@context": "https://schema.org",
                "@type": "WebPage",
                "name": "{!! schema_text($title) !!}",
                "description": "{!! schema_text($description) !!}"
            }
        ]
    }
</script>

