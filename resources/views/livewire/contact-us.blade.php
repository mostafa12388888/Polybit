<div>
    <section class="bg-white dark:bg-dark-600/40 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="absolute w-full h-full top-0 left-0 opacity-25 dark:opacity-15 z-0 bg-cover bg-no-repeat bg-center bg-map"></div>
    
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap relative z-10">
            <h2 class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-4xl font-extrabold relative px-8 z-50">{{ __('Reach out to us') }}</h2>
    
            <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden text-center mb-4">{{ __('We\'re Ready to Assist with Your Inquiries and Support Needs') }}</p>

            @php
                $addresses = setting('addresses') ?: [];
                $phones = setting('phones');
                $emails = setting('emails');
            @endphp
    
            @if ($addresses || $phones || $emails || true)
                <div class="flex flex-wrap w-full flex-grow gap-4 lg:gap-6 xl:gap-8">
                    @foreach (array_filter($addresses, fn($address) => $address['address'] ?? '') as $address)
                        <div class="w-min min-w-full sm:min-w-80 flex gap-4 px-4 py-6 flex-grow items-center rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative hover:-translate-y-1 hover:scale-105 transition-transform">
                            <span class="bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 lg:w-20 lg:h-20 rounded-full flex-shrink-0">
                                <x-icons.map-pin class="!w-8 !h-8" stroke-width="1" />
                            </span>
                            <div class="flex flex-col">
                                <h2 class="font-bold text-lg">{{ $address['location_name'] ?: __('Address') }}</h2>
                                <p class="text-balance leading-loose dark:text-dark-200">{{ $address['address'] }}</p>
                            </div>
                        </div>
                    @endforeach
        
                    @if ($phones)
                        <div class="w-min min-w-full sm:min-w-80 flex gap-4 px-4 py-6 flex-grow items-center rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative hover:-translate-y-1 hover:scale-105 transition-transform">
                            <span class="bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 lg:w-20 lg:h-20 rounded-full flex-shrink-0">
                                <x-icons.phone class="!w-8 !h-8" stroke-width="1" />
                            </span>
                            <div class="flex flex-col">
                                <h2 class="font-bold text-lg">{{ __('Phone Number') }}</h2>
                                <p class="leading-loose dark:text-dark-200">
                                    @foreach ($phones ?: [] as $phone)
                                        @php
                                            $phone = new \Propaganistas\LaravelPhone\PhoneNumber($phone);
                                            
                                            if(!$phone->getCountry()) {
                                                continue;
                                            }
                                        @endphp
                                        <x-link class="w-full" href="tel:{{ $phone }}" dir="ltr">{{ $phone->formatNational() }}</x-link>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endif
        
                    @if ($emails)
                        <div class="w-min min-w-full sm:min-w-80 flex gap-4 px-4 py-6 flex-grow items-center rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-secondary-200/20 to-secondary-200/60 dark:from-dark-700/50 dark:to-dark-700/80 relative hover:-translate-y-1 hover:scale-105 transition-transform">
                            <span class="bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 lg:w-20 lg:h-20 rounded-full flex-shrink-0">
                                <x-icons.envelope class="!w-8 !h-8" stroke-width="1" />
                            </span>
                            <div class="flex flex-col">
                                <h2 class="font-bold text-lg">{{ __('Email Address') }}</h2>
                                
                                <p class="leading-loose dark:text-dark-200">
                                    @foreach ($emails ?: [] as $email)
                                        <x-link class="w-full" href="mail:{{ $email }}">{{ $email }}</x-link>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
    
    <section class="flex-grow bg-secondary-100/50 dark:bg-dark-800/70 lg:py-6 xl:py-8 relative">
        <div class="lg:container mx-auto flex flex-col lg:flex-row lg:gap-4">
            @if (setting('location'))
                <div class="lg:rounded-md overflow-hidden lg:shadow bg-white dark:bg-dark-700/60 flex-grow order-3 lg:order-1">
                    <livewire:map />
                </div>
            @endif
    
            <div class="lg:rounded-md flex-grow w-full lg:w-6/12 2xl:w-6/12 overflow-hidden order-2 flex">
                @if ($message_sent)
                    <div class="lg:rounded-md bg-white dark:bg-dark-700/60 w-full flex-grow flex flex-col px-4 py-20 items-center justify-center gap-4">
                        <x-icons.check-circle class="!w-14 !h-14" stroke-width=".8" />
                        <h3 class="text-lg">{{ __('We recieved Your message') }}</h3>
                        <p class="text-lg">{{ __('We will contact you as soon as possible') }}</p>

                        <x-link styling="light" :href="route('home')" class="flex items-center justify-center gap-2">
                            <x-icons.home class="!w-5 !h-5" />
                            <span>{{ __('Go Home') }}</span>
                        </x-link>
                    </div>
                @else
                    <form wire:submit="send_message" class="flex-grow bg-white dark:bg-dark-700/60 py-8 px-4 md:px-6 xl:px-8 flex flex-col gap-6">
                        <h2 class="uppercase font-semibold text-xl lg:text-2xl text-gray-800 dark:text-dark-100 leading-tight">
                            {{ __('Send Us A Message') }}
                        </h2>
        
                        <div class="flex flex-col gap-3">
                            <x-label required for="">{{ __('Your Name') }}</x-label>
            
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
                            <x-label required for="">{{ __('Your Message') }}</x-label>
            
                            <x-textarea rows="4" placeholder="{{ __('Message') }}" wire:model="message" />
                            
                            @error('message')<div class="text-red-500">{{ $message }}</div>@enderror
                        </div>
                        
                        <x-button class="sm:max-w-40 flex gap-2 items-center justify-center" wire:target="send_message" wire:loading.attr="disabled">
                            <span>{{ __('Submit') }}</span>
                            <x-spinner wire:target="send_message" wire:loading class="!w-4 !h-4" />
                        </x-button>
                    </form>
                @endif
            </div>
        </div>

    </section>

    @if (($page = request()->_page) && $page->body)
        <div class="bg-secondary-100/50 dark:bg-dark-800 py-4 md:pb-10 z-10">
            <div class="lg:container mx-auto">
                <div class="prose prose-zinc dark:prose-invert bg-white dark:bg-dark-700/40 py-8 px-4 md:px-6 xl:px-8 min-w-full md:rounded-md">
                    {!! html($page->body) !!}
                </div>
            </div>
        </div>
    @endif
</div>
