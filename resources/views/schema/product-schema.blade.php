<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            @minifyInclude('schema.partials._place'),
            @minifyInclude('schema.partials._organization'),
            @minifyInclude('schema.partials._website'),
            {
                "@type": "Product",
                "name": "{!! schema_text($product->name) !!}",
                "image": [{!! 
                    $product->images->count() ? collect($product->images)->filter()
                        ->map(fn($image) => $image->getSignedUrl(['fm' => 'webp', 'w' => 1280, 'q' => 70]))
                        ->map(fn($image_path) => asset($image_path))
                        ->map(fn($image_link) => '"'.$image_link.'"')
                        ->implode(', ') : '"' . $product->meta('image') . '"'
                !!}],
                "sku": "{{ $product->slug }}",
                "keywords": "{!! schema_text($product->meta('keywords')) !!}",
                "description": "{!! schema_text($product->meta('description'), 150) !!}",
                "category": [
                    @foreach ($product->categories as $category)
                        "{!! schema_text($category->name) !!}"{{ $loop->last ? '' : ',' }}
                    @endforeach
                ],
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
                },
                "mainEntityOfPage": {
                    "@id": "{{ route('products.show', $product) }}#webpage"
                }
            }
        ]
    }
</script>