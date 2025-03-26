<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasTranslations, Sluggable;

    protected $translatable = ['name'];

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
