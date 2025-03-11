<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Testimonial extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations;

    protected $translatable = ['name', 'job_title', 'body'];

    protected $guarded = [];

    protected $casts = ['locales' => 'array'];

    public function image()
    {
        return $this->first_media();
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('testimonials_'.$locale)));

        static::deleted(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('testimonials_'.$locale)));
    }
}
