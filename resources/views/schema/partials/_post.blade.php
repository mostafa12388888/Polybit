{
    "@type": "Article",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('posts.show', $post) }}"
    },
    "url": "{{ route('posts.show', $post) }}",
    "headline": "{!! schema_text($post->meta('title')) !!}",
    "description": "{!! schema_text($post->meta('description'), 150) !!}",
    "name": "{!! schema_text($post->meta('title')) !!}",
    "keywords": "{!! schema_text($post->meta('keywords')) !!}",
    "articleSection": "Blog",
    "image": {
        "@type": "ImageObject",
        "url": "{!! $post->meta('image') !!}"
    },
    "author": {
        "@type": "Person",
        "name": "{!! schema_text($post->user->name) !!}",
        "url": "{{ route('users.show', $post->user) }}"
    },
    "inLanguage": "{{ app()->getLocale() }}",
    "datePublished": "{{ $post->created_at?->toIso8601String() }}",
    "dateModified": "{{ $post->created_at?->toIso8601String() }}"
}