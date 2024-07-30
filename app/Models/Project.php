<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasCuratorMedia, HasFactory, HasTranslations, Seoable, Sluggable;

    protected $translatable = ['title', 'subtitle', 'description', 'attributes', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $useFallbackLocale = false;

    protected $casts = ['description' => 'array', 'attributes' => 'array'];

    protected $guarded = [];

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->title)->limit(100),
            'description' => str($this->subtitle)->limit(200),
            'keywords' => explode(' ', $this->title),
        ];
    }
}
