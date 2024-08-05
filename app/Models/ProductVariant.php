<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute_values_product_variant()
    {
        return $this->hasMany(AttributeValueProductVariant::class);
    }

    public function attribute_values()
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
