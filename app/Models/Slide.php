<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slide extends Model
{
    use HasCuratorMedia, HasTranslations;

    protected $translatable = ['title', 'description', 'actions'];

    protected $useFallbackLocale = false;

    protected $guarded = [];

    protected $casts = ['actions' => 'array'];
}
