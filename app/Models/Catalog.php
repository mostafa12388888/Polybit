<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations, Seoable, Sluggable;

    protected $translatable = ['title', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['description' => 'array', 'locales' => 'array'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function requests()
    {
        return $this->hasMany(CatalogRequest::class);
    }

    public function image()
    {
        return $this->first_media()->where('media_items.type', 'catalog-image');
    }

    public function document()
    {
        return $this->first_media()->where('media_items.type', 'catalog-document');
    }

    public function getImageAttribute()
    {
        if ($this->relationLoaded('media')) {
            return $this->media->where('pivot.type', 'catalog-image')->first();
        }

        return $this->image()->first();
    }

    public function getDocumentAttribute()
    {
        if ($this->relationLoaded('media')) {
            return $this->media->where('type', 'catalog-document')->first();
        }

        return $this->document()->first();
    }

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->title)->limit(100),
            'description' => str(tiptap_converter()->asText($this->description ?: ['content' => '']))->limit(200),
            'keywords' => explode(' ', $this->title),
            'image' => $this->image?->getSignedUrl(['w' => 1200, 'h' => 630, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]),
            'image-alt' => $this->image?->alt ?: str($this->title)->limit(100),
            'image-title' => $this->image?->title ?: str($this->title)->limit(100),
        ];
    }
}
