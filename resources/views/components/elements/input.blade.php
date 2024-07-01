@props(['styling' => ''])

@php
    $classes = "";

    switch ($styling) {
        case 'simple':
            $classes .= " rounded border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50";
            break;
        case 'underline':
            $classes .= " px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black";
            break;
        case 'primary':
            $classes .= " rounded bg-gray-50 dark:bg-dark-700 border-primary-400/60 focus:border-primary-400 dark:border-dark-600 dark:focus:border-dark-600 outline-0 focus:ring-0";
            break;
        case 'solid':
            $classes .= " rounded bg-gray-100 dark:bg-dark-700 border-transparent focus:border-gray-500 focus:bg-white dark:focus:bg-dark-600 focus:ring-0";
            break;
        default:
            $classes .= " rounded bg-gray-100 dark:bg-dark-700 border-transparent focus:border-gray-500 focus:bg-white dark:focus:bg-dark-600 focus:ring-0";
            break;
    }
@endphp

<input {{ ($disabled ?? false) ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'text',
    'class' => $classes,
]) !!}>
