@auth
    <x-dropdown align="end" dropdownClasses="w-full sm:w-48" wrapperClasses="sm:relative">
        <x-slot:trigger>
            <x-button styling="light" class="h-11 px-2 flex gap-1.5 items-center justify-center">
                <x-icons.user class="!w-5 !h-5" />
                <span>{{ str()->limit(auth()->user()->name, 10) }}</span>
            </x-button>
        </x-slot>

        <x-slot:content>
            <x-dropdown.link href="{{ route('profile.edit') }}">{{ __('Profile') }}</x-dropdown.link>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown.link :navigate="false" href="javascript:void(0)" 
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown.link>
            </form>
        </x-slot>
    </x-dropdown>
@else
    <x-link styling="primary" class="h-11 px-2 flex gap-1.5 items-center justify-center" href="{{ route('login') }}">
        <x-icons.user class="!w-5 !h-5" />
        <span class="hidden sm:inline">{{ __('Sign In') }}</span>
    </x-link>
@endauth
