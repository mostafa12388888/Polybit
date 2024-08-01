<?php

namespace App\Models;

use App\Enums\AttributeType;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations, Sluggable;

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
}
