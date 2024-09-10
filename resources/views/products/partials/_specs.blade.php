<div class="lg:p-6 lg:bg-white lg:dark:bg-dark-700/40 flex flex-col lg:gap-10 rounded-t-md rounded-b-md border lg:border-t-0 border-dark-200 lg:border-dark-200 dark:border-dark-600/50 overflow-hidden">
    @foreach ($specs as $spec)    
        <x-button styling="primary" class="lg:hidden !shadow-none rounded-none flex-grow py-5 bg-gray-100 dark:bg-dark-700/40 dark:focus:!brightness-100 w-full border-dark-400 dark:border-dark-700 flex items-center gap-2 justify-between"
            x-bind:class="{'border-b': tab != {{ $loop->index + 1 }} && {{ $loop->last ? 'false' : 'true' }}}"
            @click="tab = (tab == {{ $loop->index + 1 }}) ? null : {{ $loop->index + 1 }}">
            <span>{{ $spec->title }}</span>
            <span class="text-xl opacity-70" x-text="tab == {{ $loop->index + 1 }} ? '-' : '+'"></span>
        </x-button>
        
        <div class="lg:!duration-0 lg:!transition-none" x-show="tab == {{ $loop->index + 1 }}" x-collapse>
            <div class="flex flex-col gap-4 max-lg:px-4 max-lg:py-6">
                @if ($spec->description)
                    <div class="prose prose-zinc dark:prose-invert max-w-full lg:px-4">
                        {!! html($spec->description) !!}
                    </div>
                @endif
    
                <div class="flex flex-col gap-4">
                    @foreach ($spec->media->where('pivot.type', app()->getLocale()) as $file)
                        <div class="flex gap-4 flex-wrap items-center justify-between rounded-md lg:p-4">
                            <p>{{ $file->title }}</p>
    
                            <span class="flex-grow border-t border-dashed border-dark-200 dark:border-dark-700 max-lg:hidden"></span>
    
                            <div class="flex w-auto gap-2 flex-wrap">
                                <x-link href="{{ $file->getSignedUrl() }}" target="_blank" download="{{ $file->title }}" styling="light" class="flex items-center justify-center gap-2 flex-grow dark:lg:!bg-dark-600">
                                    <x-icons.download class="!w-5 !h-5" />
                                    <span class="max-lg:hidden">{{ __('Download') }}</span>
                                    <span class="uppercase">[{{ $file->ext }}]</span>
                                </x-link>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>