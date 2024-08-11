<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasTranslations;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BlogCategory extends Model
{
    use HasCuratorMedia, HasTranslations, Seoable, Sluggable;

    protected $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['description' => 'json'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function sub_categories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function sub_categories_posts()
    {
        return $this->hasManyThrough(Post::class, self::class, 'parent_id', 'category_id');
    }

    public function image()
    {
        return $this->first_media()->where('media_items.type', 'category-image');
    }

    public function is_parent_category()
    {
        return ! $this->parent_id;
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeSubCategories($query)
    {
        return $query->where('parent_id', '!=', null);
    }

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->name)->limit(100),
            'description' => str($this->description)->limit(200),
            'keywords' => explode(' ', $this->name),
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('blog_categories'));

        static::deleted(fn () => Cache::forget('blog_categories'));
    }
}
