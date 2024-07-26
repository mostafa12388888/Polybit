<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasCuratorMedia, HasFactory, HasTranslations, Sluggable;

    protected $translatable = ['title', 'subtitle', 'description', 'attributes'];

    protected $casts = ['description' => 'json', 'attributes' => 'array'];

    protected $guarded = [];
}
