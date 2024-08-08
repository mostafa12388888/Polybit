<?php

namespace App\Filament\Traits\EditRecord;

use Filament\Resources\Pages\EditRecord\Concerns\Translatable as ConcernsTranslatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

trait Translatable
{
    use ConcernsTranslatable {
        updatedActiveLocale as spatieUpdatedActiveLocale;
        handleRecordUpdate as spatieHandleRecordUpdate;
    }

    public function updatedActiveLocale(): void
    {
        $this->spatieUpdatedActiveLocale();

        foreach ($this->otherLocaleData[$this->oldActiveLocale] as $key => $value) {
            if (! isset($this->data[$key])) {
                $this->data[$key] = is_array($value) ? [] : null;
            }
        }
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $translatableAttributes = static::getResource()::getTranslatableAttributes();

        $record->fill(Arr::except($data, $translatableAttributes));

        foreach (Arr::only($data, $translatableAttributes) as $key => $value) {
            $record->setTranslation($key, $this->activeLocale, $value);
        }

        $originalData = $this->data;

        $existingLocales = null;

        foreach ($this->otherLocaleData as $locale => $localeData) {
            $filtered_locale_data = collect($localeData)
                ->map(fn ($datum) => is_array($datum) ? array_filter($datum) : $datum)->filter()->toArray();

            // if there is no translatable data for a locale then this means the record is not meant to be ion that locale
            // So skip it and don't validate its data
            if (! $filtered_locale_data) {
                foreach (Arr::only($localeData, $translatableAttributes) as $key => $value) {
                    $record->setTranslation($key, $locale, $value);
                }

                continue;
            }

            $existingLocales = array_keys(locales());

            $this->data = [
                ...$this->data,
                ...$localeData,
            ];

            try {
                $this->form->validate();
            } catch (ValidationException $exception) {
                if (! in_array($locale, $existingLocales)) {
                    continue;
                }

                $this->data = $originalData;

                $this->setActiveLocale($locale);

                throw $exception;
            }

            $localeData = $this->mutateFormDataBeforeSave($localeData);

            foreach (Arr::only($localeData, $translatableAttributes) as $key => $value) {
                $record->setTranslation($key, $locale, $value);
            }
        }

        $this->data = $originalData;

        $record->save();

        return $record;
    }
}
