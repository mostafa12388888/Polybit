<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BlogCategory extends Model
{
    use HasCuratorMedia, HasTranslations, Searchable, Seoable, Sluggable;

    protected $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['description' => 'json'];

    protected $guarded = [];

    public $searchable = [
        'columns' => [
            'blog_categories.name' => 4,
            'blog_categories.slug' => 2,
            'blog_categories.description' => 1,
        ],
    ];

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
            'description' => str(tiptap_converter()->asText($this->description ?: ['content' => '']))->limit(200),
            'keywords' => explode(' ', $this->name),
            'image' => $this->image?->getSignedUrl(['w' => 1200, 'h' => 630, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]),
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('blog_categories'));

        static::deleted(fn () => Cache::forget('blog_categories'));
    }
}
