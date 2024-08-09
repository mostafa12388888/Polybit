<?php

namespace App\Traits;

trait HasLocales
{
    protected static function bootHasLocales()
    {
        static::saving(function (self $record) {
            $record->locales = $record?->active_locales ?? $record->spatieLocales();

            if (isset($record->attributes['active_locales'])) {
                unset($record->attributes['active_locales']);
            }
        });
    }
}
