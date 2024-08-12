<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Project extends Model
{
    use HasCuratorMedia, HasFactory, HasLocales, HasTranslations, Searchable, Seoable, Sluggable;

    protected $translatable = ['title', 'subtitle', 'description', 'attributes', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['description' => 'array', 'attributes' => 'array', 'locales' => 'array'];

    protected $guarded = [];

    public $searchable = [
        'columns' => [
            'projects.title' => 6,
            'projects.slug' => 4,
            'projects.subtitle' => 2,
            'projects.description' => 1,
        ],
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->media()->where('media_items.type', 'project-image');
    }

    public function getImagesAttribute()
    {
        if ($this->relationLoaded('media')) {
            return $this->media->filter(fn ($media) => $media->pivot->type != 'og-image');
        }

        return $this->images()->get();
    }

    public function image()
    {
        return $this->first_media()->where('media_items.type', 'project-image');
    }

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->title)->limit(100),
            'description' => str($this->subtitle)->limit(200),
            'keywords' => explode(' ', $this->title),
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('projects_'.$locale)));

        static::deleted(fn () => collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('projects_'.$locale)));
    }
}
