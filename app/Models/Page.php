<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations, Sluggable;

    protected $translatable = ['title', 'body'];

    protected $casts = ['body' => 'json'];

    protected $guarded = [];
}
