<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class StoreCategory extends Model
{
    use HasCuratorMedia, HasTranslations, Searchable, Seoable, Sluggable;

    protected $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['description' => 'json'];

    protected $guarded = [];

    public $searchable = [
        'columns' => [
            'store_categories.name' => 4,
            'store_categories.slug' => 2,
            'store_categories.description' => 1,
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

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function sub_categories_products()
    {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'category_id');
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
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('store_categories'));

        static::deleted(fn () => Cache::forget('store_categories'));
    }
}
