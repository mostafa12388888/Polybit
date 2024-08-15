@props(['navigate' => false])

@php ($url = $attributes->get('href'))

<a {{ $url && ! in_array($url, ['javascript:void(0)', '#']) && $navigate ? 'wire:navigate ' : '' }}{{ $attributes->merge([
    'class' => 'flex items-center gap-2 w-full px-4 py-3 text-left text-[.92rem] leading-5 text-gray-700 dark:text-dark-200 hover:bg-gray-100 dark:hover:bg-dark-800/30 focus:outline-none focus:bg-gray-100 dark:focus:bg-dark-800/30 transition duration-150 ease-in-out']) 
}}>{{ $slot }}</a>
