@php
$mediaType = $state->is_video ?? null;
$media = $state->image_or_video ?? null;
@endphp

@if ($mediaType == '1' && $media)
{{-- صورة --}}
<img src="{{ \Awcodes\Curator\UrlBuilder::fromMedia($media) }}" alt="Image" style="max-width: 100px; max-height: 60px; border-radius: 4px;" />
@elseif ($mediaType == 2 && $media)
{{-- فيديو --}}
<video width="150" height="90" controls style="border-radius: 4px;">
    <source src="{{ \Awcodes\Curator\UrlBuilder::fromMedia($media) }}" type="video/mp4">
    متصفحك لا يدعم عرض الفيديو.
</video>
@elseif ($mediaType == 3)
{{-- روابط فيديو خارجية --}}
@if (is_array($state->external_videos) && count($state->external_videos) > 0)
    @foreach ($state->external_videos as $video)
        <iframe width="150" height="90" src="{{ $video['url'] ?? '' }}" frameborder="0" allowfullscreen style="margin-bottom: 4px;"></iframe>
    @endforeach
@else
    <span>لا توجد روابط فيديو</span>
@endif
@else
<span>لا توجد وسائط</span>
@endif
