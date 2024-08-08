<?php

namespace App\Traits;

use Spatie\Translatable\HasTranslations as SpatieHasTranslations;

trait HasTranslations
{
    use SpatieHasTranslations {
        getTranslatedLocales as spatieGetTranslatedLocales;
        locales as spatieLocales;
    }

    public function locales(): array
    {
        return $this?->locales ?? $this->spatieLocales();
    }

    public function getTranslatedLocales(string $key): array
    {
        return array_keys(array_filter($this->getTranslations($key)));
    }
}
