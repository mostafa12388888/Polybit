<?php

if (! function_exists('direction')) {
    function direction()
    {
        return request()->dir == 'rtl' ? 'rtl' : 'ltr';
    }
}

if (! function_exists('locales')) {
    function locales()
    {
        return [
            'ar' => 'العربية',
            'en' => 'English',
        ];
    }
}
