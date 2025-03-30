@if (setting('catalogs_delivery_method') == 'without_form')
    <section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 lg:py-6 xl:py-8">
        <div class="max-w-4xl mx-auto flex flex-col lg:flex-row lg:gap-4">
            <div class="lg:rounded-md overflow-hidden bg-white dark:bg-dark-700/60 w-full relative flex flex-col">
                <div class="flex flex-col lg:flex-row flex-grow justify-center gap-6 bg-white dark:bg-dark-700/60 px-4 py-6 items-center">
                    <div class="max-sm:w-full flex-shrink-0 overflow-hidden self-start">
                        <x-curator-glider fallback="logo" :media="$catalog->image" format="webp" width="160" fit="contain" quality="70" class="rounded-md max-w-[220px] w-full sm:w-40 object-cover bg-white" :alt="$catalog->title" loading="{{ ($lazy ?? null) ? 'lazy' : 'eager' }}" />
                    </div>

                    <div class="flex-grow flex flex-col gap-6">
                        <div class="prose prose-zinc dark:prose-invert">{!! html($catalog->description) !!}</div>

                        <x-link class="sm:max-w-sm text-center" styling="primary" :href="$catalog->document?->getSignedUrl()" target="_blank" rel="noopener">
                            <x-icons.download class="!w-5 !h-5" />
                            <span>{{ __('Download Catalog') }}</span>
                        </x-link>
                    </div>
                </div>
            </div>
        </div>
    </section>

@elseif($request_submitted)

    <section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 lg:py-6 xl:py-8">
        <div class="lg:container mx-auto flex flex-col lg:flex-row lg:gap-4">
            <div class="lg:rounded-md bg-white dark:bg-dark-700/60 w-full flex flex-col px-4 py-20 items-center justify-center gap-4">
                <x-icons.check-circle class="!w-14 !h-14" stroke-width=".8" />

                @if (setting('catalogs_delivery_method') == 'automatic')
                    <h3 class="text-lg">{{ __('Thank you for submitting the form') }}</h3>

                    <p class="text-lg">{{ __('You can download the catalog via the link below') }}</p>
                    
                    <div class="flex flex-wrap gap-3 pt-2">
                        <x-link styling="primary" :href="$catalog->document?->getSignedUrl()" target="_blank" rel="noopener">
                            <x-icons.download class="!w-5 !h-5" />
                            <span>{{ __('Download Catalog') }}</span>
                        </x-link>
                    </div>
                @else
                    <h3 class="text-lg">{{ __('Your request has been submitted') }}</h3>
                    <p class="text-lg">{{ __('We will contact you as soon as possible') }}</p>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <x-link styling="light" :href="route('home')" class="flex items-center justify-center gap-2">
                            <x-icons.home class="!w-5 !h-5" />
                            <span>{{ __('Go Home') }}</span>
                        </x-link>

                        <x-link styling="light" :href="route('catalogs.index')">
                            <x-icons.book class="!w-5 !h-5" />
                            <span>{{ __('Browse Our Catalogs') }}</span>
                        </x-link>
                    </div>
                @endif
            </div>
        </div>
    </section>
@else
    <section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 lg:py-6 xl:py-8">
        <div class="lg:container mx-auto flex flex-col lg:flex-row lg:gap-4">
            <div class="lg:rounded-md overflow-hidden bg-white dark:bg-dark-700/60 w-full relative flex flex-col lg:max-w-lg">
                <div class="flex flex-col gap-6 bg-white dark:bg-dark-700/60 px-4 py-6">
                    <div class="max-sm:w-full flex-shrink-0 overflow-hidden">
                        <x-curator-glider fallback="logo" :media="$catalog->image" format="webp" width="160" fit="contain" quality="70" class="rounded-md max-w-[220px] w-full sm:w-40 object-cover bg-white" :alt="$catalog->title" loading="{{ ($lazy ?? null) ? 'lazy' : 'eager' }}" />
                    </div>

                    <div class="flex-grow flex flex-col prose prose-zinc dark:prose-invert max-w-full">{!! html($catalog->description) !!}</div>
                </div>
            </div>

            <form wire:submit="request_catalog" class="lg:rounded-md flex-grow w-full overflow-hidden bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 flex flex-col gap-6">
                <h2 class="uppercase font-semibold text-xl lg:text-2xl text-gray-800 dark:text-dark-100 leading-tight">
                    {{ __('Request access to the catalog') }}
                </h2>

                <p>{{ __('Please provide the following details in order to access the catalog') }}.</p>

                <hr class="border-dark-200/70 dark:border-dark-700">

                <div class="flex flex-col gap-3">
                    <x-label for="">{{ __('Your Name') }}</x-label>

                    <x-input placeholder="{{ __('Name') }}" wire:model="name" />
                    
                    @error('name')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="flex flex-col gap-3">
                    <x-label required for="">{{ __('Your Email Address') }}</x-label>

                    <x-input placeholder="{{ __('Email') }}" wire:model="email" />

                    @error('email')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>
                
                <div class="flex flex-col gap-3">
                    <x-label for="">{{ __('Your Phone') }}</x-label>
                    
                    <x-input placeholder="{{ __('Phone') }}" wire:model="phone" />

                    @error('phone')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>
                
                <div class="flex flex-col gap-3">
                    <x-label for="">{{ __('Your Company') }}</x-label>
                    
                    <x-input placeholder="{{ __('Company Name') }}" wire:model="company" />

                    @error('company')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>

                <div class="flex flex-col gap-3">
                    <x-label>{{ __('Additional Details') }}:</x-label>

                    <x-textarea rows="4" placeholder="{{ __('Additional Details') }}" wire:model="message" />

                    @error('message')<div class="text-red-500">{{ $message }}</div>@enderror
                </div>
                
                <x-button class="sm:max-w-40 flex gap-2 items-center justify-center" wire:target="send_message" wire:loading.attr="disabled">
                    <span>{{ __('Submit') }}</span>
                    <x-spinner wire:target="send_message" wire:loading class="!w-4 !h-4" />
                </x-button>
            </form>
        </div>
    </section>
@endif
