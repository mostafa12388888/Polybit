<?php

if (! function_exists('direction')) {
    function direction()
    {
        return request()->dir == 'rtl' ? 'rtl' : 'ltr';
    }
}
