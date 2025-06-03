<?php

namespace App\Models;

use App\Traits\HasTranslations;

class AttributeValue extends NonTranslatableAttributeValue
{
    use HasTranslations;

    protected $translatable = ['value', 'title'];

    public function product_variants()
    {
        return $this->belongsToMany(ProductVariant::class, 'attribute_value_product_variant');
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $attribute_value) {
            $value = $attribute_value->value;
            $title = $attribute_value->title;

            if ($attribute_value->isDirty('value') && is_array($value)) {
                $attribute_value->setAttribute('value', $value);
            }

            if ($attribute_value->isDirty('title') && is_array($title)) {
                $attribute_value->setAttribute('title', $title);
            }
        });

        static::deleting(function (self $value) {
            $value->product_variants->each->delete();
        });
    }
}
