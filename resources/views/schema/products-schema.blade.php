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
                        @foreach($products as $product)
                            {
                                "@type": "ListItem",
                                "position": {{ $loop->index }},
                                "item": {
                                    "@type": "Product",
                                    "name": "{!! schema_text($product->name) !!}",
                                    "image": "{!! $product->meta('image') !!}",
                                    "sku": "{{ $product->slug }}",
                                    "description": "{!! schema_text($product->meta('description'), 150) !!}",
                                    "offers": {
                                        "@type": "Offer",
                                        "url": "{{ route('products.show', $product) }}",
                                        "price": {{ $product->price ?: 111 }},
                                        "priceValidUntil": "{{ now()->addYear()->format('Y-m-d') }}",
                                        "priceCurrency": "EGP",
                                        "availability": "InStock",
                                        "itemCondition": "NewCondition",
                                        "hasMerchantReturnPolicy": {
                                            "@type": "MerchantReturnPolicy",
                                            "applicableCountry": "EG",
                                            "returnPolicyCategory": "MerchantReturnFiniteReturnWindow",
                                            "merchantReturnDays": 14,
                                            "returnMethod": "ReturnByMail",
                                            "returnFees": "FreeReturn"
                                        }
                                    },
                                    "aggregateRating": {
                                        "@type": "AggregateRating",
                                        "ratingValue": {{ $product->rate }},
                                        "bestRating": 10,
                                        "worstRating": 1,
                                        "ratingCount": {{ $product->ratings_count() }}
                                    }
                                }
                            }{{ $loop->last ? '' : ',' }}
                        @endforeach
                    ]
                }
            }
        ]
    }
</script>
