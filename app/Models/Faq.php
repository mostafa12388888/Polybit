<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;

    protected $translatable = ['question', 'answer'];

    protected $casts = ['answer' => 'json'];

    protected $guarded = [];
}
