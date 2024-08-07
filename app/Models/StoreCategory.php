<?php

namespace App\Models;

use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class StoreCategory extends Model
{
    use HasTranslations, Seoable, Sluggable;

    protected $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $useFallbackLocale = false;

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

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
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

        static::saved(fn () => Cache::forget('store_categories'));

        static::deleted(fn () => Cache::forget('store_categories'));
    }
}
