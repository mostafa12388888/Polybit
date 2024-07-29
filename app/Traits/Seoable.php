<?php

namespace App\Traits;

use App\Models\Metadatum;

trait Seoable
{
    use HasCuratorMedia;

    protected $_metadata;

    public function metadatum($key)
    {
        $default_metadata = method_exists($this, 'getDefaultMetadata') ? $this->getDefaultMetadata() : [];

        if ($key == 'og-image') {
            $image = $this->media()->where('media_items.type', 'og-image')->latest()->first();

            // TODO: Add Default og image here
            // $image = $image ?: $default;

            return $image ? asset($image->getSignedUrl(['w' => 1200, 'h' => 630, 'fit' => 'crop', 'fm' => 'webp'])) : null;
        }

        $this->loadMissing('metadata');

        return $this->metadata->where('key', $key)->first()?->value ?: optional($default_metadata)['$key'];
    }

    public function metadata()
    {
        return $this->morphMany(Metadatum::class, 'seoable');
    }

    protected static function bootSeoable()
    {
        static::retrieved(function (self $seoable) {
            $seoable->loadMissing('metadata');

            foreach (['title', 'description', 'keywords'] as $key) {
                $datum = $seoable->metadata->where('key', $key)->first()?->value;

                try {
                    $datum = json_decode($datum, true);
                } catch (\Throwable $th) {
                    //
                }

                if (in_array($key, ['keywords'])) {
                    if (! is_array($datum)) {
                        $datum = ['ar' => [], 'en' => []];
                    }
                }

                $seoable->{'meta_'.$key} = $datum;
            }
        });

        static::saving(function (self $seoable) {
            foreach (['title', 'description', 'keywords'] as $key) {
                if (isset($seoable->attributes['meta_'.$key])) {
                    $metadata[$key] = $seoable->attributes['meta_'.$key];
                    unset($seoable->attributes['meta_'.$key]);
                }
            }

            $seoable->_metadata = $metadata ?? [];
        });

        static::saved(function (self $seoable) {
            foreach ($seoable->_metadata as $key => $value) {
                $seoable->metadata()->updateOrCreate(['key' => $key], ['value' => $value]);
            }
        });
    }
}
