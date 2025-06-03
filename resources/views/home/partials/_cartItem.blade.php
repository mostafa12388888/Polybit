<section class="w-full py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 mt-10 gap-4 lg:gap-6 xl:gap-8">
        @forelse ($cards as $card)
            @php
                $media = DB::table('curator_media')->where('id', $card->image_or_video)->first();
            @endphp
            <div
                class="group rounded-lg shadow-md p-2 text-center hover:shadow-lg ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative sm:hover:-translate-y-1 sm:hover:scale-105 transition-transform">
                <div class="relative w-full rounded-lg shadow-md overflow-hidden" style="height:280px">

                    {{-- النوع 1 = صورة --}}
                    @if ($card->is_video == 1 && $media)
                        <a href="{{ $card->link ?? '#' }}" target="_blank" class="w-full block h-full">
                            <img src="{{ '/storage/' . $media->path }}" alt="">
                            <div
                                class="group-hover:opacity-100 opacity-0 transition-opacity absolute inset-0 bg-dark-900/60 flex items-center justify-center text-white">
                                <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
                            </div>
                        </a>

                        {{-- النوع 2 = فيديو داخلي --}}
                    @elseif ($card->is_video == 2 && $media)
                        <video class="customVideo w-full h-full object-cover" controls preload="none"
                            poster="{{ asset('/storage/thumbnails/' . pathinfo($media->path, PATHINFO_FILENAME) . '.jpg') }}"
                            style="cursor: pointer;">
                            <source src="{{ '/storage/' . $media->path }}" type="video/mp4">
                            متصفحك لا يدعم عرض الفيديو.
                        </video>
                        <div>
                            <a href="{{ $card->link ?? '#' }}" target="_blank" class="btn btn-primary">
                                التفاصيل
                            </a>
                        </div>
                        {{-- النوع 3 = فيديوهات خارجية --}}
                    @elseif ($card->is_video == 3 && is_array($card->external_videos))
                        @foreach ($card->external_videos as $video)
                            @if (!empty($video['url']))
                                <iframe width="100%" height="100%" src="{{ $video['url'] }}" frameborder="0"
                                    allowfullscreen></iframe>
                            @endif
                        @endforeach

                        {{-- لا يوجد وسائط --}}
                    @else
                        <a href="{{ $card->link ?? '#' }}" target="_blank" class="w-full block h-full">
                            <img src="{{ asset('images/default.webp') }}" class="w-full h-full object-cover"
                                alt="صورة افتراضية" />
                        </a>
                        <div
                            class="group-hover:opacity-100 opacity-0 transition-opacity absolute inset-0 bg-dark-900/60 flex items-center justify-center text-white">
                            <x-icons.link class="!w-9 !h-9" stroke-width="1.5" />
                        </div>
                    @endif

                </div>

                <div class="p-4">




                    <h3 class="text-xl font-semibold mb-2">
                        {{ $card->getTranslation('title', app()->getLocale()) }}
                    </h3>
                    <p class="text-gray-600 mb-4">
                        {{ $card->getTranslation('description', app()->getLocale()) }}
                    </p>
                    @if ($card->is_video != 1)
                    <div class="bg-white p-2 rounded hover:opacity-70">
                    <a href="{{ $card->link ?? '#' }}" target="_blank"
                       class="block text-center bg-white text-gray-600 font-semibold rounded px-4 py-2 hover:gradient-to-b hover:opacity-70 transition">
                       {{ __('Additional Details') }}
                       </a>
                    </div>
                    @endif
                </div>
            </div>
        @empty
        @endforelse
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const videos = document.querySelectorAll(".customVideo");

        videos.forEach(video => {
            video.addEventListener("click", function() {
                if (video.paused) {
                    video.play();
                } else {
                    video.pause();
                }
            });
        });
    });
</script>
