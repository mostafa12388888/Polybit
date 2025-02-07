<?php

namespace App\Traits;

use App\Models\AttributeValue;
use App\Models\Metadatum;
use Filament\Facades\Filament;
use Spatie\Translatable\HasTranslations as SpatieHasTranslations;

trait HasTranslations
{
    use SpatieHasTranslations {
        getTranslatedLocales as spatieGetTranslatedLocales;
        locales as spatieLocales;
        useFallbackLocale as spatieUseFallbackLocale;
        getTranslations as spatieGetTranslations;
        setTranslations as spatieSetTranslations;
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

    // This code will allow overwriting the unassigned locales translation
    public function setTranslations(string $key, array $translations): self
    {
        $this->guardAgainstNonTranslatableAttribute($key);

        $this->attributes[$key] = $this->asJson([]);

        if (! empty($translations)) {
            foreach ($translations as $locale => $translation) {
                $this->setTranslation($key, $locale, $translation);
            }
        }

        return $this;
    }

    public function getTranslatedLocales(string $key): array
    {
        $translations = $this->getTranslations($key);

        return array_keys(array_filter(is_array($translations) ? $translations : []));
    }

    public function useFallbackLocale(): bool
    {
        if ($this instanceof AttributeValue) {
            return true;
        } elseif ($this instanceof Metadatum) {
            return false;
        }

        try {
            $referer = trim(parse_url(request()->headers->get('referer'))['path'], '/');

            if (request()->route()->getName() == 'livewire.update') {
                if (strpos($referer, Filament::getPanel()->getPath()) === 0) {
                    return false;
                }
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
