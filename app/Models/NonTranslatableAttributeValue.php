<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class NonTranslatableAttributeValue extends Model
{
    use Sluggable;

    protected $table = 'attribute_values';

    protected $casts = ['value' => 'array'];

    protected $useFallbackLocale = false;

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
