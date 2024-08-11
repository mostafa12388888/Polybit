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

    protected $guarded = [];

    protected $casts = ['actions' => 'array', 'locales' => 'array'];

    public function image()
    {
        return $this->first_media();
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('slides_'.$locale)));

        static::deleted(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('slides_'.$locale)));
    }
}
