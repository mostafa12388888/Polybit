{
    "@type": "BlogPosting",
    "url": "{{ route('posts.show', $post) }}",
    "headline": "{!! schema_text($post->meta('title')) !!}",
    "name": "{!! schema_text($post->meta('title')) !!}",
    "keywords": "{!! schema_text($post->meta('keywords')) !!}",
    "articleSection": "Blog",
    "image": "{!! $post->meta('image') !!}",
    "author": {
        "@type": "Person",
        "name": "{{ $post->user->name }}",
        "url": "{{ route('users.show', $post->user) }}"
    },
    "description": "{!! schema_text($post->meta('description'), 150) !!}",
    "datePublished": "{{ $post->created_at?->toIso8601String() }}",
    "dateModified": "{{ $post->created_at?->toIso8601String() }}",
    "inLanguage": "{{ app()->getLocale() }}",
    "mainEntityOfPage": {
        "@id": "{{ route('posts.show', $post) }}#webpage"
    }
}