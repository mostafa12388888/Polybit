<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations, Seoable, Sluggable;

    protected $translatable = ['title', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $useFallbackLocale = false;

    protected $casts = ['body' => 'array', 'locales' => 'array'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function main_category()
    {
        return $this->belongsTo(BlogCategory::class, 'main_category_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->first_media()->where('media_items.type', 'post-image');
    }

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->title)->limit(100),
            'description' => str(tiptap_converter()->asText($this->body))->limit(200),
            'keywords' => explode(' ', $this->title),
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('posts_'.$locale)));

        static::deleted(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('posts_'.$locale)));

        static::saving(function (self $post) {
            if (! $post->user_id) {
                $post->user()->associate(auth()->user());
            }

            try {
                unset($post->attributes['main_category_id']);
            } catch (\Throwable $th) {
                //
            }
        });
    }
}
