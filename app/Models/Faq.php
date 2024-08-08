<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasTranslations;

    protected $translatable = ['question', 'answer'];

    protected $useFallbackLocale = false;

    protected $casts = ['answer' => 'json'];

    protected $guarded = [];
}
