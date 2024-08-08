<?php

namespace App\Models;

use App\Enums\AttributeType;
use App\Traits\HasTranslations;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasTranslations, Sluggable, SoftDeletes;

    protected $translatable = ['name'];

    protected $useFallbackLocale = false;

    protected $casts = [
        'type' => AttributeType::class,
    ];

    protected $guarded = [];

    public function attribute_values()
    {
        return $this->hasMany(NonTranslatableAttributeValue::class);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function attribute_values_product_variant()
    {
        return $this->hasManyThrough(AttributeValueProductVariant::class, AttributeValue::class);
    }

    public function product_variants()
    {
        return $this->hasManyThrough(ProductVariant::class, AttributeValue::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $attribute) {
            $product_variants_ids = $attribute->attribute_values_product_variant()->pluck('product_variant_id')->toArray();

            // If the attribute is deleted
            // Then just delete all it's values attached to a variant
            // That will make duplicate variants,
            $attribute->attribute_values_product_variant()->delete();

            $attribute->values()->delete();

            if (! $product_variants_ids) {
                return;
            }

            ProductVariant::whereIn('id', $product_variants_ids)->doesntHave('attribute_values_product_variant')->delete();

            // delete duplicate product variants
            foreach (ProductVariant::whereIn('id', $product_variants_ids)->with('attribute_values')->oldest('id')->get() as $product_variant) {
                $attribute_values = [];

                foreach ($product_variant->attribute_values as $attribute_value) {
                    $attribute_values[] = $attribute_value->id;
                }

                sort($attribute_values);

                $products_variants[$product_variant->id] = $attribute_values;
            }

            $unique_variant_values = [];

            foreach ($products_variants ?? [] as $id => $values) {
                foreach ($unique_variant_values as $varint_values) {
                    if ($values == $varint_values) {
                        $to_be_deleted_variants[] = $id;

                        continue;
                    }
                }

                $unique_variant_values[] = $values;
            }

            if ($to_be_deleted_variants ?? []) {
                ProductVariant::whereIn('id', $to_be_deleted_variants ?? [])->delete();

                AttributeValueProductVariant::whereIn('product_variant_id', $to_be_deleted_variants ?? [])->delete();
            }
        });
    }
}
