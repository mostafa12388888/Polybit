<?php

namespace App\Models;

use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations, Seoable, Sluggable;

    protected $translatable = ['title', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $useFallbackLocale = false;

    protected $casts = ['body' => 'json'];

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

        static::saving(function (self $post) {
            try {
                unset($post->attributes['main_category_id']);
            } catch (\Throwable $th) {
                //
            }
        });
    }
}
