<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations, Searchable, Seoable, Sluggable;

    protected $translatable = ['title', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['body' => 'array', 'locales' => 'array'];

    protected $guarded = [];

    public $searchable = [
        'columns' => [
            'posts.title' => 8,
            'posts.slug' => 6,
            'posts.body' => 2,
        ],
    ];

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
            'description' => str(tiptap_converter()->asText($this->body ?: ['content' => '']))->limit(200),
            'keywords' => explode(' ', $this->title),
            'image' => $this->image?->getSignedUrl(['w' => 1200, 'h' => 630, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]),
            'image-alt' => $this->image?->alt ?: str($this->title)->limit(100),
            'image-title' => $this->image?->title ?: str($this->title)->limit(100),
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
