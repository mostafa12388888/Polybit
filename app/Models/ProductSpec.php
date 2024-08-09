<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasCuratorMedia, HasTranslations;

    protected $translatable = ['title', 'description'];

    protected $casts = ['description' => 'array'];

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $spec) {
            $title = $spec->title;
            $description = $spec->description;

            if ($spec->isDirty('title') && is_array($title)) {
                $spec->setAttribute('title', $title);
            }

            if ($spec->isDirty('description') && is_array($description)) {
                if (! array_diff(array_keys($description), array_keys(locales()))) {
                    $spec->setAttribute('description', $description);
                }
            }
        });
    }
}
