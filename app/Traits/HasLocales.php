<?php

namespace App\Traits;

trait HasLocales
{
    protected static function bootHasLocales()
    {
        static::saving(function (self $record) {
            $record->locales = $record?->locales ?? $record->locales();
        });
    }
}
