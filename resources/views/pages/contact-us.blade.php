<x-slot name="title">{{ __('Contact Us') }}</x-slot>

<x-slot name="heading">{{ __('Contact Us') }}</x-slot>

<x-slot name="breadcrumbs">
    <x-breadcrumb :last="true">{{ __('Contact Us') }}</x-breadcrumb>
</x-slot>

<div>
    <section class="bg-white dark:bg-dark-600/40 px-4 sm:px-6 py-12 md:py-16 xl:py-20 relative">
        <div class="absolute w-full h-full top-0 left-0 opacity-25 dark:opacity-15 z-0 bg-cover bg-no-repeat bg-center" style="background-image: url('/images/map.png');"></div>
    
        <div class="container mx-auto flex flex-col gap-3 md:gap-4 lg:gap-8 justify-center items-center flex-wrap relative z-10">
            <h2 class="uppercase text-dark-800 dark:text-dark-100 text-2xl lg:text-3xl xl:text-4xl font-extrabold relative px-8 z-50">{{ __('Reach out to us') }}</h2>
    
            <p class="text-base md:text-base xl:text-lg text-ellipsis w-full max-w-6xl overflow-hidden text-center mb-4">{{ __('We\'re Ready to Assist with Your Inquiries and Support Needs') }}</p>
    
            @if (($address = setting('address')) || ($phones = setting('phones')) || ($emails = setting('emails')))
                <div class="flex flex-wrap w-full flex-grow gap-4 lg:gap-6 xl:gap-8">
                    @if ($address)
                        <div class="w-min min-w-full sm:min-w-80 flex gap-4 px-4 py-6 flex-grow items-center rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-primary-100/60 to-primary-200/80 dark:from-dark-700/50 dark:to-dark-700/80 relative hover:-translate-y-1 hover:scale-105 transition-transform">
                            <span class="bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 lg:w-20 lg:h-20 rounded-full">
                                <x-icons.map-pin class="!w-8 !h-8" stroke-width="1" />
                            </span>
                            <div class="flex flex-col">
                                <h4 class="font-bold text-lg">{{ __('Address') }}</h4>
                                <p class="text-balance leading-loose dark:text-dark-200">{{ $address }}</p>
                            </div>
                        </div>
                    @endif
        
                    @if ($phones)
                        <div class="w-min min-w-full sm:min-w-80 flex gap-4 px-4 py-6 flex-grow items-center rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-primary-100/60 to-primary-200/80 dark:from-dark-700/50 dark:to-dark-700/80 relative hover:-translate-y-1 hover:scale-105 transition-transform">
                            <span class="bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 lg:w-20 lg:h-20 rounded-full">
                                <x-icons.phone class="!w-8 !h-8" stroke-width="1" />
                            </span>
                            <div class="flex flex-col">
                                <h4 class="font-bold text-lg">{{ __('Phone Number') }}</h4>
                                <p class="leading-loose dark:text-dark-200">
                                    @foreach ($phones ?: [] as $phone)
                                        <x-link class="w-full" href="tel:{{ $phone }}" dir="ltr">{{ $phone }}</x-link>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endif
        
                    @if ($emails)
                        <div class="w-min min-w-full sm:min-w-80 flex gap-4 px-4 py-6 flex-grow items-center rounded-xl ltr:bg-gradient-to-bl rtl:bg-gradient-to-br from-primary-100/60 to-primary-200/80 dark:from-dark-700/50 dark:to-dark-700/80 relative hover:-translate-y-1 hover:scale-105 transition-transform">
                            <span class="bg-white/70 dark:bg-dark-700/70 flex items-center justify-center h-16 w-16 lg:w-20 lg:h-20 rounded-full">
                                <x-icons.envelope class="!w-8 !h-8" stroke-width="1" />
                            </span>
                            <div class="flex flex-col">
                                <h4 class="font-bold text-lg">{{ __('Email Address') }}</h4>
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
    
    <section class="flex-grow bg-primary-100 dark:bg-dark-800/70 lg:py-6 xl:py-8 relative">
        <div class="lg:container mx-auto flex flex-col lg:flex-row lg:gap-4">
            <div class="lg:rounded-md overflow-hidden lg:shadow bg-white dark:bg-dark-700/60 flex-grow order-3 lg:order-1">
                <iframe class="w-full h-full min-h-96" src="https://maps.google.com/maps?q=22%20%D8%A7%D9%84%D8%B4%D9%87%D9%8A%D8%AF%20%D9%85%D8%AD%D9%85%D8%AF%20%D8%B9%D8%A8%D8%AF%20%D8%A7%D9%84%D9%87%D8%A7%D8%AF%D9%8A%D8%8C%20%D9%85%D8%B3%D8%A7%D9%83%D9%86%20%D8%A7%D9%84%D9%85%D9%87%D9%86%D8%AF%D8%B3%D9%8A%D9%86%D8%8C%20%D9%85%D8%AF%D9%8A%D9%86%D8%A9%20%D9%86%D8%B5%D8%B1%D8%8C%20%D9%85%D8%AD%D8%A7%D9%81%D8%B8%D8%A9%20%D8%A7%D9%84%D9%82%D8%A7%D9%87%D8%B1%D8%A9%E2%80%AC%204451722&t=m&z=10&output=embed"></iframe>
            </div>
    
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
</div>
