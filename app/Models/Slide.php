<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Slide extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations;

    protected $translatable = ['title', 'description', 'actions'];

    protected $useFallbackLocale = false;

    protected $guarded = [];

    protected $casts = ['actions' => 'array', 'locales' => 'array'];

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('slides'));

        static::deleted(fn () => Cache::forget('slides'));
    }
}
