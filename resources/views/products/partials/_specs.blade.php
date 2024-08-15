<div class="lg:p-6 lg:bg-white lg:dark:bg-dark-700/40 flex flex-col gap-10 rounded-b-md lg:border lg:border-t-0 border-dark-200 dark:border-dark-600/50">
    @foreach ($specs as $spec)
        <div class="max-lg:!flex flex flex-col gap-4" x-show="tab == {{ $loop->index + 1 }}">
            <h2 class="lg:hidden font-semibold text-xl lg:text-2xl text-dark-800 dark:text-dark-100 leading-tight">{{ $spec->title }}</h2>

            <div class="prose prose-zinc dark:prose-invert max-w-full">
                {!! html($spec->description) !!}
            </div>

            <div class="flex flex-col gap-4">
                @foreach ($spec->media->where('pivot.type', app()->getLocale()) as $file)
                    <div class="flex gap-4 flex-wrap items-center justify-between border lg:border-none rounded-md p-4 border-dark-100 dark:border-dark-700/50">
                        <p>{{ $file->title }}</p>

                        <span class="flex-grow border-t border-dashed border-dark-200 dark:border-dark-700 max-lg:hidden"></span>

                        <div class="flex w-full sm:w-auto gap-2 flex-wrap">
                            <x-link href="{{ $file->getSignedUrl() }}" target="_blank" download="{{ $file->title }}" styling="light" class="flex items-center justify-center gap-2 flex-grow dark:lg:!bg-dark-600">
                                <x-icons.download class="!w-5 !h-5" />
                                <span>{{ __('Download') }}</span>
                                <span class="uppercase">[{{ $file->ext }}]</span>
                            </x-link>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>