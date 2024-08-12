<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Metadatum extends Model
{
    use HasTranslations;

    protected $translatable = ['value'];

    protected $guarded = [];
}
