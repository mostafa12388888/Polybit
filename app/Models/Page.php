<?php

namespace App\Models;

use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations, Seoable, Sluggable;

    public $translatable = ['title', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['body' => 'json'];

    protected $guarded = [];
}
