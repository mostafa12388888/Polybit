@props(['styling' => '', 'checked' => false])

@php
    $classes = "p-2 text-primary-500 dark:bg-dark-500 dark:text-dark-400 dark:border-dark-600 dark:ring-dark-600 dark:border-dark-600";

    switch ($styling) {
        case 'simple':
            $classes .= " rounded-md border-secondary-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50";
            break;
        case 'underline':
            $classes .= " px-0.5 border-0 border-b-2 border-secondary-200 focus:ring-0 focus:border-black";
            break;
        case 'primary':
            $classes .= " rounded border-primary-300 focus:border-transparent focus:ring-1 focus:ring-primary-600";
            break;
        case 'solid':
            $classes .= " rounded bg-secondary-100 border-secondary-200 focus:border-secondary-200 focus:bg-white focus:ring-0";
            break;
        default:
            $classes .= " rounded bg-secondary-100 border-secondary-200 focus:border-secondary-200 focus:bg-white focus:ring-0";
            break;
    }
@endphp

<input {{ ($disabled ?? false) ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'checkbox',
    'class' => $classes,
]) !!}  {{ ($checked ?? false) ? 'checked' : '' }}>
