@props([
    'multiple' => false,
    'label' => 'Drag & Drop your picture or <span class="filepond--label-action">Browse</span>',
    'aspect_ratio' => null,
    'layout' => null,
    'preview_height' => 200,
    'preview' => [],
])


<input 
    type="file" 
    x-data="{
        initFilePond () {
            const pond = FilePond.create($el, {
                credits: false,
                storeAsFile: true,
                labelIdle: `{{ $label }}`,
                labelFileRemoveError: 'ERROR',
                @if($preview_height)
                    imagePreviewHeight: {{ $preview_height }},
                    filePosterHeight: {{ $preview_height }},
                @endif
                @if($aspect_ratio)
                    {{-- imageCropAspectRatio: '{{ $aspect_ratio }}', --}}
                @endif
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,

                stylePanelLayout: '{{ $layout }}',
                @if($layout == 'circle' || $layout == 'compact circle')
                    styleLoadIndicatorPosition: 'left bottom',
                    styleProgressIndicatorPosition: 'right bottom',
                    styleButtonRemoveItemPosition: 'center bottom',
                    styleButtonProcessItemPosition: 'right bottom',
                @endif

                @if($preview && is_array($preview) && sizeof($preview))
                    files: [
                        @foreach($preview as $image)
                            @if(is_array($image) && isset($image['url']))
                                {
                                    source: ' ',
                                    options: {
                                        type: 'local',
                                        file: {
                                            name: '{{ $image['name'] ?? __('Image Preview') }}',
                                        },
                                        metadata: {
                                            poster: '{{ $image['url'] }}',
                                        },
                                    },
                                },
                            @endif
                        @endforeach
                    ],
                @endif

                server: {
                    remove: (source, load, error) => {
                        this.delete(source, load, error).then(res => load()).catch(err => error('Error'));
                    },
                },
            });
        }
    }" 
    x-init="$nextTick(() => { initFilePond(); })"
    {{ $multiple ? 'multiple' : '' }} 
    {!! $attributes !!} 
/>
