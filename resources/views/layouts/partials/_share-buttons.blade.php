@php($url = urlencode($url ?? request()->url()))

<div class="flex flex-wrap gap-2 items-center">
    <x-link styling="light" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" class="!p-0 flex items-center justify-center w-10 h-10">
        <x-icons.facebook class="!w-5 !h-5 text-dark-500 dark:text-dark-300" />
        <span class="sr-only">{{ __('Share on Facebook') }}</span>
    </x-link>
    
    <x-link styling="light" target="_blank" href="https://x.com/intent/tweet?url={{ $url }}" class="!p-0 flex items-center justify-center w-10 h-10">
        <x-icons.twitter class="!w-5 !h-5 text-dark-500 dark:text-dark-300" />
        <span class="sr-only">{{ __('Share on Twitter') }}</span>
    </x-link>
    
    <x-link styling="light" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}&source=LinkedIn" class="!p-0 flex items-center justify-center w-10 h-10">
        <x-icons.linkedin class="!w-5 !h-5 text-dark-500 dark:text-dark-300" />
        <span class="sr-only">{{ __('Share on Linkedin') }}</span>
    </x-link>
    
    <x-link styling="light" target="_blank" href="whatsapp://send?text={{ $url }}" class="!p-0 flex items-center justify-center w-10 h-10">
        <x-icons.whatsapp class="!w-5 !h-5 text-dark-500 dark:text-dark-300" />
        <span class="sr-only">{{ __('Share on Whatsapp') }}</span>
    </x-link>
</div>