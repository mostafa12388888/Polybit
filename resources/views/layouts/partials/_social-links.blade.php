@foreach (setting('social_links') ?: [] as $social_link)
    <x-link styling="light" href="{!! $social_link !!}" class="!p-0 flex items-center justify-center w-10 h-10">
        @if (strpos(parse_url($social_link)['host'], 'fb.com') !== false || strpos(parse_url($social_link)['host'], 'facebook.com') !== false)
            <x-icons.facebook class="!w-5 !h-5 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('Facebook Link') }}</span>
        @elseif (strpos(parse_url($social_link)['host'], 'x.com') !== false || strpos(parse_url($social_link)['host'], 'twitter.com') !== false)
            <x-icons.twitter class="!w-5 !h-5 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('Twitter Link') }}</span>
        @elseif (strpos(parse_url($social_link)['host'], 'youtube.com') !== false)
            <x-icons.youtube class="!w-6 !h-6 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('Youtube Link') }}</span>
        @elseif (strpos(parse_url($social_link)['host'], 'instagram.com') !== false)
            <x-icons.instagram class="!w-7 !h-5 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('Instagram Link') }}</span>
        @elseif (strpos(parse_url($social_link)['host'], 'linkedin.com') !== false)
            <x-icons.linkedin class="!w-5 !h-5 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('Linkedin Link') }}</span>
        @elseif (strpos(parse_url($social_link)['host'], 'wa.me') !== false)
            <x-icons.whatsapp class="!w-5 !h-5 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('Whatsapp Link') }}</span>
        @else
            <x-icons.link class="!w-5 !h-5 text-dark-600/90 dark:text-dark-300" />
            <span class="sr-only">{{ __('External Link') }}</span>
        @endif
    </x-link>
@endforeach
