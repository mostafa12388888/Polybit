<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValueProductVariant extends Model
{
    use SoftDeletes;

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
