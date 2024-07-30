<?php

namespace App\Filament\Traits\CreateRecord;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable as ConcernsTranslatable;

trait Translatable
{
    use ConcernsTranslatable {
        updatedActiveLocale as spatieUpdatedActiveLocale;
    }

    public function updatedActiveLocale(string $newActiveLocale): void
    {
        $this->spatieUpdatedActiveLocale($newActiveLocale);

        foreach ($this->otherLocaleData[$this->oldActiveLocale] as $key => $value) {
            if (! isset($this->data[$key])) {
                $this->data[$key] = is_array($value) ? [] : null;
            }
        }
    }
}
