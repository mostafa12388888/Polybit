@props(['styling' => ''])

@php
    $classes = "";


    switch ($styling) {
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
            $classes .= " rounded-md bg-secondary-100 dark:bg-dark-700 border-transparent focus:border-secondary-200 focus:bg-white dark:focus:bg-dark-600 focus:ring-0";
            break;
        default:
            $classes .= " rounded-md bg-secondary-100 dark:bg-dark-700 border-transparent focus:border-secondary-200 focus:bg-white dark:focus:bg-dark-600 focus:ring-0";
            break;
    }
@endphp

<textarea {{ ($disabled ?? false) ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'text',
    'class' => $classes,
]) !!}>{{ $slot }}</textarea>
