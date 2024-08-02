<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class AttributeValue extends NonTranslatableAttributeValue
{
    use HasTranslations;

    protected $translatable = ['value', 'title'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $attribute_value) {
            $value = $attribute_value->value;

            if ($attribute_value->isDirty('value') && is_array($value)) {
                $attribute_value->setAttribute('value', $value);
            }
        });
    }
}
