<?php

namespace App\Traits;

use Filament\Facades\Filament;
use Spatie\Translatable\HasTranslations as SpatieHasTranslations;

trait HasTranslations
{
    use SpatieHasTranslations {
        getTranslatedLocales as spatieGetTranslatedLocales;
        locales as spatieLocales;
        useFallbackLocale as spatieUseFallbackLocale;
    }

    public function locales(): array
    {
        return $this->hasAttribute('locales') ? $this->locales : $this->spatieLocales();
    }

    public function getTranslatedLocales(string $key): array
    {
        return array_keys(array_filter($this->getTranslations($key)));
    }

    public function useFallbackLocale(): bool
    {
        $referer = trim(parse_url(request()->headers->get('referer'))['path'], '/');

        if (strpos($referer, Filament::getPanel()->getPath()) === 0) {
            return false;
        }

        if (strpos(request()->route()->getName(), 'filament.') === 0) {
            return false;
        }

        return true;
    }
}
