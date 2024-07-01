@props(['grid' => true, 'preview' => true])

@php($dropzoneDataVariableName = 'dz_'.uniqid())

<div {{ $attributes }} x-data="{{ $dropzoneDataVariableName }}" x-init="$nextTick(() => { initDropzone(); })">
    <div class="file-preview-template hidden min-w-[210px] relative flex-grow flex-wrap gap-3 items-center bg-white dark:bg-dark-800/40 p-4 rounded-lg">
        <div class="w-full warning items-center gap-4 text-red-700 bg-orange-50 shadow-sm rounded-lg text-center px-4 py-2.5 hidden">
            <div class="flex items-center justify-center text-4xl bg-white w-14 h-14 rounded-full">⚠️</div>
            <span class="warning-text"></span>
        </div>
        
        <x-button data-dz-remove type="button" styling="light" 
            class="!rounded-full absolute right-4 rtl:right-auto rtl:left-4 top-[calc(50%-1.5rem)] text-xl w-12 h-12 !p-0 flex items-center justify-center">
            <x-icons.close />
            <span class="sr-only">{{ __('Close') }}</span>
        </x-button>

        <div class="file-progress gap-2 items-center w-full rounded overflow-hidden hidden">
            <div class="h-2 flex-grow bg-gray-100 dark:bg-dark-700">
                <div class="progress bg-primary-500 h-full" style="width: 0%;"></div>
            </div>
            <div class="progress-text text-xs"></div>
        </div>

        @if($preview)
            <img data-dz-thumbnail src="{{ asset('images/file.png') }}" class="rounded-lg w-28" alt="File icon" />
            <video class="video-preview hidden rounded-lg w-48" controls></video>
        @endif

        <div class="file-info flex flex-col gap-2">
            <p class="name" data-dz-name></p>
            <p class="size" data-dz-size></p>
            <div class="success-message text-sm text-green-400"></div>
            <div class="error-message text-sm text-red-500" data-dz-errormessage></div>
        </div>
    </div>
    
    <div class="flex flex-col gap-6">
        <div class="droppable bg-gray-100/70 dark:bg-dark-700/70 border dark:border-dark-600 rounded-lg overflow-hidden border-dashed">
            <div class="dz-message flex flex-col gap-6 items-center text-center py-12 px-4">
                <div class="w-24 h-24 bg-white dark:bg-dark-600/50 flex items-center justify-center rounded-full">
                    <x-icons.upload class="!w-10 !h-10" stroke-width="1" />
                </div>

                <strong class="font-semibold">{{ __('Drag and drop files to upload') }}</strong>
                
                {!! $slot !!}

                <x-button type="button" styling="white" class="max-w-[100%] w-72 dark:bg-dark-600/50">{{ __('Select Video Files') }}</x-button>
            </div>
            
            <div class="files-previews-container flex flex-wrap gap-4 justify-center p-4 {{ $grid ? '' : 'flex-col' }}" @click.stop=""></div>
            
            <div class="add-more-files hidden bg-white dark:bg-dark-800/40 flex-wrap p-4 gap-4 lg:gap-8 items-center justify-center">
                <div class="self-start justify-self-start w-12 h-12 bg-gray-50 dark:bg-dark-700 flex items-center justify-center rounded-lg">
                    <x-icons.upload stroke-width="1" />
                </div>
                <p>Drag more files here to upload</p>
                <x-button type="button" styling="light" class="max-w-[100%]">{{ __('Select Video Files') }}</x-button>
            </div>
        </div>
        
        <div class="controls">
            <x-button @click="abort" type="button" styling="light" class="w-full abort hidden">{{ __('Cancel upload') }}</x-button>
            <x-button @click="upload" type="button" class="w-full upload">{{ __('Upload') }}</x-button>
            <x-button @click="reset" type="button" styling="light" class="w-full reset hidden">{{ __('Upload another Video/s') }}</x-button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        var dropzoneData = {
            dropzone: null,
            initDropzone() {
                var previewTemplate = this.$el.querySelector('.file-preview-template').cloneNode('true');
                previewTemplate.classList.remove('hidden');
                previewTemplate.classList.add('flex');

                var options = this.$el.dataset.options;
                options = options ? options.replaceAll("'", '"').replaceAll(' ', '').replaceAll('\n', '').replaceAll(',}', '}') : null;

                form = this.$el.closest('form');
                this.dropzone = new Dropzone(form, {
                    paramName: 'files',
                    url: form.getAttribute('action'),
                    parallelUploads: 20,
                    maxFiles: 100,
                    maxFilesize: 30720,
                    autoQueue: false,
                    previewTemplate: previewTemplate.outerHTML,
                    previewsContainer: this.$el.querySelector('.files-previews-container'),
                    clickable: this.$el.querySelector('.droppable'),
                    uploadMultiple: true,
                    timeout: 7200000,
                    ...JSON.parse(options),
                    uploadprogress: (file, progress) => this.uploadProgress(file, progress),
                    error: (file, response) => this.error(file, response),
                    init: function() {
                        this.on('addedfile', (file) => dropzoneData.addedfile(file));
                        this.on('complete', (file) => dropzoneData.complete(file));
                        this.on('success', (file, response) => dropzoneData.success(file, response));
                        this.on('queuecomplete', (progress) => dropzoneData.queuecomplete(progress));
                        this.on('sending', (file, xhr, formData) => dropzoneData.sending(file, xhr, formData));
                        this.on('removedfile', () => dropzoneData.removedfile());
                    }
                });
            },
            addedfile(file){
                this.$el.querySelector('.dz-message').classList.add('hidden');
                this.$el.querySelector('.add-more-files').classList.remove('hidden');
                this.$el.querySelector('.add-more-files').classList.add('flex');
                
                if (this.dropzone.files[this.dropzone.options.maxFiles] != null && this.dropzone.options.overrideFiles) { 
                    this.dropzone.removeFile(this.dropzone.files[0]);
                }

                imagePreviewElement = file.previewElement.querySelector('img');
                videoPreviewElement = file.previewElement.querySelector('video.video-preview');

                if (
                    videoPreviewElement &&
                    (['maybe', 'probably'].includes(videoPreviewElement.canPlayType(file.type)) ||
                    file.type == 'video/x-matroska')
                ) {
                    videoPreviewElement.classList.remove('hidden');
                    imagePreviewElement.classList.add('hidden');
                    var fileURL = URL.createObjectURL(file);
                    setTimeout(() => URL.revokeObjectURL(fileURL), 500);
                    videoPreviewElement.src = fileURL;
                }
            },
            uploadProgress(file, progress){
                if (! file.previewElement) return;
                file.previewElement.querySelector('.progress').style.width = progress + '%';
                file.previewElement.querySelector('.progress-text').textContent = progress.toFixed(1) + '%';
            },
            success(file, response){
                if (! file.previewElement) return;

                var message = typeof response == 'object' ? JSON.stringify(message) : response;

                if (typeof response == 'object' && response.message) {
                    message = response.message;
                }

                file.previewElement.querySelector('.success-message').innerHTML = message;

                if (typeof response == 'object' && response.warning) {
                    file.previewElement.querySelector('.warning').classList.remove('hidden');
                    file.previewElement.querySelector('.warning').classList.add('flex');

                    file.previewElement.querySelector('.warning-text').innerHTML = response.warning;
                }
            },
            error(file, response){
                if (! file.previewElement) return;

                file.previewElement.classList.add('dz-error');

                var message = typeof response == 'object' ? JSON.stringify(message) : response;

                if (typeof response == 'object' && response.errors) {
                    message = '';
                    Object.keys(response.errors).forEach(item => {message += response.errors[item][0] + '<br>'});
                }

                if (typeof response == 'object' && (response.error || response.message)) {
                    message = response.error ? response.error : response.message;
                }

                file.previewElement.querySelector('.error-message').innerHTML = message;
            },
            complete(file){
                file.previewElement.querySelector('.file-progress').classList.add('hidden');
            },
            queuecomplete(){
                if(this.dropzone.files.length == 0) {
                    // upload aborted
                    this.$el.querySelector('.controls .upload').classList.remove('hidden');
                    this.$el.querySelector('.controls .abort').classList.add('hidden');
                    this.$el.querySelector('.controls .reset').classList.add('hidden');
                } else {
                    // Upload finished
                    this.$el.querySelector('.controls .upload').classList.add('hidden');
                    this.$el.querySelector('.controls .abort').classList.add('hidden');
                    this.$el.querySelector('.controls .reset').classList.remove('hidden');
                }
            },
            sending(file, xhr, formData){
                var files_names = this.dropzone.files.map(function (file) {
                    return file.name.replace(/\.[^/.]+$/, "");
                });
                
                for (var i = 0; i < files_names.length; i++) {
                    formData.append('files_names[]', files_names[i]);
                }
                
                file.previewElement.querySelector('.file-progress').classList.remove('hidden');
                file.previewElement.querySelector('.file-progress').classList.add('flex');
                this.$el.querySelector('.controls .upload').classList.add('hidden');
                this.$el.querySelector('.controls .abort').classList.remove('hidden');
                this.$el.querySelector('.controls .reset').classList.add('hidden');
                this.$el.querySelector('.add-more-files').classList.add('hidden');
            },
            removedfile(){
                if (this.dropzone.files.length == 0) {
                    this.$el.querySelector('.dz-message').classList.remove('hidden');
                    this.$el.querySelector('.add-more-files').classList.add('hidden');
                    this.$el.querySelector('.add-more-files').classList.remove('flex');
                    this.$el.querySelector('.controls .upload').classList.remove('hidden');
                    this.$el.querySelector('.controls .abort').classList.add('hidden');
                    this.$el.querySelector('.controls .reset').classList.add('hidden');
                    this.$el.querySelectorAll('input, select').forEach(el => el.setAttribute('disabled', true))
                }
            },
            upload() {
                if (this.dropzone.getAcceptedFiles().length <= 0) return;
                this.dropzone.enqueueFiles(this.dropzone.getFilesWithStatus(Dropzone.ADDED));
                this.$el.querySelectorAll('input, select').forEach(el => el.setAttribute('disabled', false))
            },
            abort() {
                this.dropzone.removeAllFiles(true);
                this.$el.querySelectorAll('input, select').forEach(el => el.setAttribute('disabled', false))
            },
            reset() {
                this.dropzone.removeAllFiles(true);
                this.$el.querySelectorAll('input, select').forEach(el => el.setAttribute('disabled', false));
            }
        };

        Alpine.data('{{ $dropzoneDataVariableName }}', () => (dropzoneData))
    })
</script>
