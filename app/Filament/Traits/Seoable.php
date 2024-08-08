<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Model;

trait Seoable
{
    protected function resolveRecord(int|string $key): Model
    {
        $record = parent::resolveRecord($key);

        $record?->loadMetadata();

        return $record;
    }
}
