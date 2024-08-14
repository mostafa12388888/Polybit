<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            @minifyInclude('schema.partials._place'),
            @minifyInclude('schema.partials._organization'),
            @minifyInclude('schema.partials._website'),
            {
                "@type": "CollectionPage",
                "name": "{{ $title }}",
                "mainEntity": {
                    "@type": "ItemList",
                    "itemListElement": [
                        @foreach($posts as $post)
                            {
                                "@type": "ListItem",
                                "position": {{ $loop->index }},
                                "item": @minifyInclude('schema.partials._post')
                            }{{ $loop->last ? '' : ',' }}
                        @endforeach
                    ]
                }
            }
        ]
    }
</script>
