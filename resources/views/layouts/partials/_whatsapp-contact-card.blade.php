<?php 
    if(! $store_categories->filter(fn ($c) => count($c->phones ?? []))->count()) {
        return;
    }
?>
<section class="bg-white dark:bg-dark-700/60 border-y border-secondary-100 dark:border-none pattern">
    <div class="container mx-auto px-4 py-6 flex justify-center">
        <div class="flex-grow flex flex-col max-w-3xl" x-data="{open: false}">
            <div class="flex gap-6 items-center">
                <div class="w-16 h-16 rounded-full bg-secondary-100/80 dark:bg-dark-700 flex items-center justify-center flex-shrink-0">
                    <x-icons.whatsapp class="!w-[1.4rem] !h-[1.4rem] text-primary-700 dark:text-primary-300"/>
                </div>
                
                <div class="flex-grow flex flex-col md:flex-row flex-wrap gap-3 md:justify-between md:items-center">
                    <div class="flex flex-col gap-1.5">
                        <p class="font-semibold">{{ __('Have any questions, suggestions or complains ?') }}</p>
                        <p>{{ __('Message us on whatsapp.') }}</p>
                    </div>
                    
                    <x-button styling="light" class="flex-grow md:max-w-[220px] flex gap-2 items-stretch rtl:items-center justify-center !px-12 py-3 focus:brightness-100" x-on:click="open = ! open">
                        <span class="text-[.93rem] font-semibold">{{ __('Message Us') }}</span>
                    </x-button>
                </div>
            </div>
            
            <div x-show="open" x-cloak x-collapse>
                <div class="pt-4 flex flex-col gap-2">
                    @foreach ($store_categories as $store_category)
                        @foreach (array_filter($store_category->phones ?? []) as $phone)
                            @php
                                $phone = new \Propaganistas\LaravelPhone\PhoneNumber($phone);

                                if(! $phone->getCountry()) {
                                    continue;
                                }
                            @endphp
                            <div class="px-4 py-2.5 rounded-lg flex gap-3 flex-wrap items-center justify-between bg-secondary-100/50 dark:bg-dark-700/30">
                                <div class="flex gap-4 items-center">
                                    <x-icons.bookmark class="!w-5 !h-5"/>
        
                                    <p class="">{{ $store_category->name }}</p>
                                </div>

                                <x-link href="https://wa.me/{{ str_replace('+', '', $phone) }}" styling="white" class="flex gap-2 items-stretch rtl:items-center justify-center px-8 py-3">
                                    <span class="ltr:text-start rtl:text-end" dir="ltr">{{ $phone->formatNational() }}</span>
                                </x-link>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>