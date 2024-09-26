{
    "@type": "WebSite",
    "name": "{!! schema_text($title) !!}",
    "description": "{!! schema_text($description) !!}",
    "url": "{{ request()->url() }}",
    "image": [
        {!! 
            collect([setting('logo'), setting('darkmode_logo')])
                ->filter()
                ->map(fn($image) => $image->getSignedUrl(['border' => '150,FFF,expand', 'w' => '212', 'h' => 212, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp']))
                ->map(fn($image_path) => asset($image_path))
                ->map(fn($image_link) => '"'.$image_link.'"')
                ->implode(', ')
        !!}
    ],
    "sameAs": [
        {!! collect(setting('social_links') ?? [])->map(fn ($link) => '"'.$link.'"')->implode(', ') !!}
    ]
}