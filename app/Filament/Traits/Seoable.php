<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Model;

trait Seoable
{
    public static function resolveRecordRouteBinding(int|string $key): ?Model
    {
        $record = parent::resolveRecordRouteBinding($key);

        $record?->loadMetadata();

        return $record;
    }
}
