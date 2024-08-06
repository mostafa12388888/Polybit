<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NonTranslatableAttributeValue extends Model
{
    use Sluggable, SoftDeletes;

    protected $table = 'attribute_values';

    protected $casts = ['value' => 'array'];

    protected $useFallbackLocale = false;

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
