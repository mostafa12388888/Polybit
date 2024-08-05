<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueProductVariant extends Model
{
    protected $table = 'attribute_value_product_variant';

    protected $guarded = [];

    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class);
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
