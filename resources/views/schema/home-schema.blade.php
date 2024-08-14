<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            @minifyInclude('schema.partials._place'),
            @minifyInclude('schema.partials._organization'),
            @minifyInclude('schema.partials._website'),
            {
                "@type": "ItemList",
                "name": "{{ config('app.name') }}",
                "itemListElement": [
                    @if ($slides->count())
                        {
                            "@type": "ItemList",
                            "name": "{{ __('Featured Projects') }}",
                            "itemListElement": [
                                @foreach ($slides as $slide)
                                    {
                                        "@type": "ListItem",
                                        "position": {{ $loop->index }},
                                        "name": "{!! schema_text($slide->title) !!}",
                                        "image": "{!! $slide->image?->getSignedUrl(['fm' => 'webp', 'w' => 1280, 'h' => 480, 'q' => 70]) !!}"
                                    }{{ $loop->last ? '' : ',' }}
                                @endforeach
                            ]
                        },
                    @endif
                    @if ($store_categories->count())
                        {
                            "@type": "ItemList",
                            "name": "{{ __('Featured Projects') }}",
                            "itemListElement": [
                                @foreach ($store_categories as $category)
                                    {
                                        "@type": "ListItem",
                                        "position": {{ $loop->index }},
                                        "url": "{{ route('store-categories.show', $category) }}",
                                        "name": "{!! schema_text($category->name) !!}",
                                        "image": "{!! $category->image?->getSignedUrl(['fm' => 'webp', 'w' => 1280, 'h' => 480, 'q' => 70]) !!}"
                                    }{{ $loop->last ? '' : ',' }}
                                @endforeach
                            ]
                        },
                    @endif
                    @if ($projects->count())
                        {
                            "@type": "ItemList",
                            "name": "{{ __('Featured Projects') }}",
                            "itemListElement": [
                                @foreach ($projects as $project)
                                    {
                                        "@type": "ListItem",
                                        "position": {{ $loop->index }},
                                        "url": "{{ route('projects.show', $project) }}",
                                        "name": "{!! schema_text($project->title) !!}",
                                        "image": "{!! $project->image?->getSignedUrl(['fm' => 'webp', 'w' => 1280, 'q' => 70]) !!}"
                                    }{{ $loop->last ? '' : ',' }}
                                @endforeach
                            ]
                        },
                    @endif
                    @if ($posts->count())
                        {
                            "@type": "ItemList",
                            "name": "{{ __('Latest Blog Posts') }}",
                            "itemListElement": [
                                @foreach ($posts as $post)
                                    {
                                        "@type": "ListItem",
                                        "position": {{ $loop->index }},
                                        "url": "{{ route('posts.show', $post) }}",
                                        "name": "{!! schema_text($post->title) !!}",
                                        "description": "{!! schema_text(text($post->body), 150) !!}",
                                        "image": "{!! $post->image?->getSignedUrl(['fm' => 'webp', 'w' => 1280, 'q' => 70]) !!}"
                                    }{{ $loop->last ? '' : ',' }}
                                @endforeach
                            ]
                        },
                    @endif
                    {
                        "@type": "ListItem",
                        "item": {
                        "@type": "ItemList",
                        "name": "{{ __('Contact Us') }}",
                        "url": "{{ route('contact-us') }}"
                        }
                    }
                ]
            }
        ]
    }
</script>
