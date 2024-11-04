<?php

namespace App\Traits;

trait HasLocales
{
    public function translated($locale = null)
    {
        $locales = $this->locales() ?: [];

        return in_array($locale ?: app()->getLocale(), $locales);
    }

    protected static function initializeHasLocales()
    {
        static::saving(function (self $record) {
            $record->locales = $record?->locales ?? $record->spatieLocales();
        });
    }
}
