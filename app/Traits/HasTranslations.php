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
        getTranslations as spatieGetTranslations;
    }

    public function locales(): array
    {
        return $this->hasAttribute('locales') ? $this->locales : $this->spatieLocales();
    }

    public function getTranslations(?string $key = null, ?array $allowedLocales = null): array
    {
        if ($key !== null) {
            $this->guardAgainstNonTranslatableAttribute($key);

            $value = json_decode($this->getAttributes()[$key] ?? '' ?: '{}', true);

            return array_filter(
                is_array($value) ? $value : [app()->getLocale() => $value],
                fn ($value, $locale) => $this->filterTranslations($value, $locale, $allowedLocales),
                ARRAY_FILTER_USE_BOTH,
            );
        }

        return array_reduce($this->getTranslatableAttributes(), function ($result, $item) use ($allowedLocales) {
            $result[$item] = $this->getTranslations($item, $allowedLocales);

            return $result;
        });
    }

    public function getTranslatedLocales(string $key): array
    {
        $translations = $this->getTranslations($key);

        return array_keys(array_filter(is_array($translations) ? $translations : []));
    }

    public function useFallbackLocale(): bool
    {
        try {
            $referer = trim(parse_url(request()->headers->get('referer'))['path'], '/');

            if (strpos($referer, Filament::getPanel()->getPath()) === 0) {
                return false;
            }

            if (strpos(request()->route()->getName(), 'filament.') === 0) {
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return true;
    }
}
