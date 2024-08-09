<?php

namespace App\Models;

use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasLocales, HasTranslations;

    protected $translatable = ['question', 'answer'];

    protected $useFallbackLocale = false;

    protected $casts = ['answer' => 'array', 'locales' => 'array'];

    protected $guarded = [];
}
