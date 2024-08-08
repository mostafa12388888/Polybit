<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasCuratorMedia, HasTranslations;

    protected $translatable = ['title', 'description'];

    protected $useFallbackLocale = false;

    protected $casts = ['description' => 'array'];

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
