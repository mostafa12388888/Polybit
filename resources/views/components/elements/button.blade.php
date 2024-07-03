@props(['styling' => 'primary', 'size' => 'md', 'disabled' => false])

@php
    $classes = "focus:outline-none inline-block rounded-md text-gray-700 hover:text-gray-900 focus:text-gray-900 dark:text-dark-100 dark:hover:text-gray-100 dark:focus:text-gray-100";

    $classes .= $disabled ? " opacity-50 cursor-not-allowed" : "";

    switch ($styling) {
        case 'light-link':
            $classes .= " hover:bg-gray-100 dark:hover:bg-dark-700 focus:bg-gray-100 dark:focus:bg-dark-700 active:bg-gray-200 dark:active:bg-dark-600";
            break;
        case 'light':
            $classes .= " bg-gray-100 dark:bg-dark-700 hover:brightness-95 focus:brightness-95 active:brightness-90";
            break;
        case 'white':
            $classes .= " bg-white dark:bg-dark-700 hover:bg-gray-50 dark:bg-dark-700 dark:hover:brightness-95 focus:bg-gray-50 dark:focus:brightness-95 active:bg-gray-100 dark:active:brightness-90 shadow-sm";
            break;
        case 'primary':
            $classes .= " text-white hover:text-white focus:text-white active:text-white bg-primary-500 hover:bg-primary-600 focus:bg-primary-600 active:bg-primary-700";
            break;
        case 'danger':
            $classes .= " text-white hover:text-white focus:text-white active:text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 active:bg-red-600 ";
            break;
    }

    switch ($size) {
        case 'xs': $classes .= ' px-2 py-1 text-xs'; break;
        case 'sm': $classes .= ' px-3 py-1 text-sm'; break;
        case 'md': $classes .= ' px-4 py-2'; break;
        case 'lg': $classes .= ' px-6 py-3 text-lg'; break;
        case 'xl': $classes .= ' px-8 py-4 text-xl'; break;
        case '2xl': $classes .= ' px-10 py-5 text-2xl'; break;
        case '3xl': $classes .= ' px-12 py-6 text-3xl'; break;
    }
@endphp

<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => $classes,
    'disabled' => $disabled,
]) }}>
    {{ $slot }}
</button>
