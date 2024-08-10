<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NonTranslatableAttributeValue extends Model
{
    use SoftDeletes;

    protected $table = 'attribute_values';

    protected $casts = ['value' => 'array'];

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
