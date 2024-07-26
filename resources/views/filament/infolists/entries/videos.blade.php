@php
    $videos = $getRecord()->media->whereIn('mime_type', setting('video_mimetypes'));
@endphp

<div class="grid gap-y-2">
    <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
            Videos
        </span>
    </dt>
    
    <div class="flex flex-wrap gap-1.5">
        @foreach ($videos as $media)
            <div class="flex aspect-video">
                <video playsinline controls
                    data-poster="{{ $media->thumbnail() }}" x-init="new Plyr($el)">
                    <source src="{{ $media->video() }}" type="video/mp4" />
                </video>
            </div>
        @endforeach
    </div>
</div>
