<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Artisan;

class CuratorMedia extends Media
{
    protected $table = 'curator_media';

    protected static function boot()
    {
        parent::boot();

        static::deleted(fn () => Artisan::call('cache:clear'));
    }
}
