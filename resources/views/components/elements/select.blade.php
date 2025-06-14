@props(['styling' => 'light', 'badge' => false])

@php
    $classes = "text-sm lg:text-base";

    switch ($styling) {
        case 'white':
            $classes .= " rounded-md border-none bg-white dark:bg-dark-700 hover:bg-secondary-50 dark:hover:brightness-95 focus:bg-secondary-50 dark:focus:brightness-95 active:bg-secondary-100 dark:active:brightness-90 shadow-sm";
            break;
        case 'light':
            $classes .= " rounded-md border-none bg-secondary-100 dark:bg-dark-700 hover:bg-secondary-200/70 dark:hover:bg-dark-600 focus:bg-secondary-200/70 dark:focus:bg-dark-600 active:bg-secondary-300/60 dark:active:brightness-90 shadow-sm";
            break;
        case 'simple':
            $classes .= " rounded-md border-secondary-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50";
            break;
        case 'underline':
            $classes .= " px-0.5 border-0 border-b-2 border-secondary-200 focus:ring-0 focus:border-black";
            break;
        case 'primary':
            $classes .= " rounded-md border-red-300 focus:border-transparent focus:ring-1 focus:ring-red-600";
            break;
        case 'solid':
            $classes .= " rounded-md bg-secondary-100 border-transparent focus:border-secondary-200 focus:bg-white focus:ring-0";
            break;
        default:
            $classes .= " rounded-md bg-secondary-100 border-transparent focus:border-secondary-200 focus:bg-white focus:ring-0";
            break;
    }
    
    $classes = $badge ? $classes . " pr-20 rtl:pr-0 rtl:pl-20" : $classes;
@endphp

<select {!! $attributes->merge(['class' => $classes]) !!}>
    {{ $slot }}
</select>