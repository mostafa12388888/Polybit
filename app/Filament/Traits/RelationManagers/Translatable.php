<?php

namespace App\Filament\Traits\RelationManagers;

use App\Filament\Classes\LaravelTranslatableContentDriver;
use Filament\Resources\RelationManagers\Concerns\Translatable as ConcernsTranslatable;

trait Translatable
{
    use ConcernsTranslatable {
        getFilamentTranslatableContentDriver as spatieGetFilamentTranslatableContentDriver;
    }

    public function getFilamentTranslatableContentDriver(): ?string
    {
        return LaravelTranslatableContentDriver::class;
    }
}
