<?php

namespace App\Models;

use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasLocales, HasTranslations, Seoable, Sluggable;

    public $translatable = ['title', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $useFallbackLocale = false;

    protected $casts = ['body' => 'array', 'locales' => 'array'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('pages'));

        static::deleted(fn () => Cache::forget('pages'));
    }
}
