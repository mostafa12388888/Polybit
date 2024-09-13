<nav class="sm:hidden" x-ref="bottomNavbar">
    <div class="mt-[4.6rem]"></div>
    
    <div class="fixed bottom-0 left-0 z-50 w-full h-[4.6rem] bg-white dark:bg-dark-700">
        <div class="dark:bg-dark-800/70 h-full border-t border-dark-200 dark:border-dark-700/40">
            <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
                <x-link :href="route('home')" class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none">
                    <x-icons.home class="!w-6 !h-6" />
                    <span class="text-sm max-[370px]:text-xs">{{ __('Home') }}</span>
                </x-link>
                <x-link :href="route('products.index')" class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none">
                    <x-icons.store class="!w-6 !h-6" />
                    <span class="text-sm max-[370px]:text-xs">{{ __('Store') }}</span>
                </x-link>
                <x-link :href="route('cart')" class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none">
                    <div class="relative inline-flex">
                        <livewire:cart-items-count :bottom_navbar="true" />
                        <x-icons.cart class="!w-6 !h-6" />
                    </div>
                    <span class="text-sm max-[370px]:text-xs">{{ __('Cart') }}</span>
                </x-link>
                <x-link :href="route('contact-us')" class="inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none">
                    <x-icons.envelope class="!w-6 !h-6" />
                    <span class="text-sm max-[370px]:text-xs">
                        <span>{{ __('Contact') }}</span>
                    </span>
                </x-link>

                <x-dropdown align="top" dropdownClasses="shadow-none w-full pt-2 absolute left-0 bottom-[4.6rem]" wrapperClasses="items-center flex" triggerClasses="flex-grow flex flex-wrap h-full" contentClasses="py-2">
                    <x-slot:trigger>
                        <x-button styling="" class="flex-grow inline-flex gap-1 flex-col items-center justify-center hover:bg-dark-100 dark:hover:bg-dark-700/70 !rounded-none">
                            <x-icons.user class="!w-6 !h-6" />
                            <span class="text-sm max-[370px]:text-xs">{{ __('account') }}</span>
                        </x-button>
                    </x-slot>

                    <x-slot:content>
                        @if(auth()->user()?->is_admin)
                            <x-dropdown.link class="flex gap-3 px-4" href="{{ route('filament.admin.pages.dashboard') }}">
                                <x-icons.computer-desktop class="!w-5 !h-5" />
                                <span>{{ __('Admin Panel') }}</span>
                            </x-dropdown.link>
                        @endif
                        
                        @if (auth()->user())
                            <x-dropdown.link class="flex gap-3 px-4 py-4" href="{{ route('profile.edit') }}">
                                <x-icons.user class="!w-5 !h-5" />
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown.link>
                        @endif

                        <x-dropdown.link class="flex gap-3 px-4 py-4" href="{{ route('wishlist') }}">
                            <x-icons.heart class="!w-5 !h-5" />
                            <span>{{ __('My wishlist') }}</span>
                        </x-dropdown.link>

                        @if (auth()->user())
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown.link class="flex gap-3 px-4" :navigate="false" href="javascript:void(0)" 
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <x-icons.logout class="!w-5 !h-5" />
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown.link>
                            </form>
                        @else
                            <x-dropdown.link class="flex gap-3 px-4 py-4" href="{{ route('login') }}">
                                <x-icons.user class="!w-5 !h-5" />
                                <span>{{ __('login') }}</span>
                            </x-dropdown.link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
