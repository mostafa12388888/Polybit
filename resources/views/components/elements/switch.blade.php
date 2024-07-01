@props(['checked' => false, 'size' => 'md'])

@php
    switch ($size) {
        case 'xs': $classes = 'w-7 h-4 after:h-3.5 after:w-3.5 after:left-[1px] rtl:after:right-[1px] after:top-[1px]'; break;
        case 'sm': $classes = 'w-9 h-5 after:h-4 after:w-4 after:left-[2px] rtl:after:right-[2px] after:top-[2px]'; break;
        case 'md': $classes = 'w-11 h-6 after:h-5 after:w-5 after:left-[2px] rtl:after:right-[2px] after:top-[2px]'; break;
        case 'lg': $classes = 'w-14 h-7 after:h-6 after:w-6 after:left-[4px] rtl:after:right-[4px] after:top-[2px]'; break;
        case 'xl': $classes = 'w-16 h-8 after:h-7 after:w-7 after:left-[4px] rtl:after:right-[4px] after:top-[2px]'; break;
    }

    if($size == 'xs') {
        $classes .= ' peer-checked:after:translate-x-[80%] rtl:peer-checked:after:-translate-x-[80%]';
    } else {
        $classes .= ' peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full';
    }
@endphp

<label class="relative inline-flex gap-2 items-center cursor-pointer {!! $attributes->get('class') !!}">
    <div class="relative">
        <input class="sr-only peer" {!! $attributes->merge(['type' => 'checkbox']) !!}  {{ $checked  ? 'checked' : '' }}>
    
        <div class="bg-gray-200 peer-focus:outline-none peer-focus:ring-0 dark:peer-focus:ring-primary-50 rounded-full peer dark:bg-dark-600 peer-checked:after:border-primary-500 after:content-[''] after:absolute after:bg-white after:border-gray-300 after:border after:rounded-full after:transition-all dark:border-dark-500 peer-checked:bg-primary-500 rtl:after:left-auto {{ $classes }}"></div>
    </div>

    <div class="inline">{{ $slot }}</div>
</label>