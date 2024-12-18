<?php

namespace App\Traits;

trait HasLocales
{
    public function translated($locale = null)
    {
        $locales = $this->locales() ?: [];

        return in_array($locale ?: app()->getLocale(), $locales);
    }

    protected static function bootHasLocales()
    {
        static::saving(function (self $record) {
            $record->locales = $record?->active_locales ?? $record->spatieLocales();

            try {
                unset($record->attributes['active_locales']);
            } catch (\Throwable $th) {
                //
            }
        });
    }
}
