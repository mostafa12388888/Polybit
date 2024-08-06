<?php

namespace App\Filament\Traits\ListRecords;

use App\Filament\Classes\LaravelTranslatableContentDriver;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable as ConcernsTranslatable;

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
