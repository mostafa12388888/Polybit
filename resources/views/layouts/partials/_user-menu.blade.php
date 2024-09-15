@auth
    <x-dropdown align="end" dropdownClasses="w-full sm:w-48 pt-2" wrapperClasses="sm:relative">
        <x-slot:trigger>
            <x-button styling="light" class="h-11 px-2 flex gap-1.5 items-center justify-center">
                <x-icons.user class="!w-5 !h-5" />
                <span>{{ str()->limit(auth()->user()->name, 7, '') }}</span>
            </x-button>
        </x-slot>

        <x-slot:content>
            @if(auth()->user()?->is_admin)
                <x-dropdown.link class="flex gap-3 px-4" href="{{ route('filament.admin.pages.dashboard') }}">
                    <x-icons.computer-desktop class="!w-5 !h-5" />
                    <span>{{ __('Admin Panel') }}</span>
                </x-dropdown.link>
            @endif

            <x-dropdown.link class="flex gap-3 px-4" href="{{ route('wishlist') }}">
                <x-icons.heart class="!w-5 !h-5" />
                <span>{{ __('My wishlist') }}</span>
            </x-dropdown.link>

            <x-dropdown.link class="flex gap-3 px-4" href="{{ route('profile.edit') }}">
                <x-icons.cog class="!w-5 !h-5" />
                <span>{{ __('Profile') }}</span>
            </x-dropdown.link>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown.link class="flex gap-3 px-4" :navigate="false" href="javascript:void(0)" 
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <x-icons.logout class="!w-5 !h-5" />
                    <span>{{ __('Log Out') }}</span>
                </x-dropdown.link>
            </form>
        </x-slot>
    </x-dropdown>
@else
    <x-dropdown align="end" dropdownClasses="w-full sm:w-48 pt-2" wrapperClasses="sm:relative">
        <x-slot:trigger>
            <x-button styling="primary" class="h-11 px-2 flex gap-1.5 items-center justify-center">
                <x-icons.user class="!w-5 !h-5" />
                <span>{{ __('account') }}</span>
            </x-button>
        </x-slot>

        <x-slot:content>
            <x-dropdown.link class="flex gap-3 px-4" href="{{ route('wishlist') }}">
                <x-icons.heart class="!w-5 !h-5" />
                <span>{{ __('My wishlist') }}</span>
            </x-dropdown.link>

            <x-dropdown.link class="flex gap-3 px-4" href="{{ route('login') }}">
                <x-icons.login class="!w-5 !h-5" />
                <span>{{ __('Login') }}</span>
            </x-dropdown.link>
        </x-slot>
    </x-dropdown>
@endauth
