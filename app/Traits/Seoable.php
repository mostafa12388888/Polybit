<?php

namespace App\Traits;

use App\Models\Metadatum;

trait Seoable
{
    use HasCuratorMedia;

    protected $_metadata;

    public function meta($key)
    {
        return $this->metadatum($key);
    }

    public function metadatum($key)
    {
        $default_metadata = method_exists($this, 'getDefaultMetadata') ? $this->getDefaultMetadata() : [];

        if ($key == 'og-image' || $key == 'image' || $key == 'image-alt') {
            if ($this->relationLoaded('media')) {
                $image = $this->media->filter(fn ($media) => $media->pivot->type == 'og-image')->first();
            } else {
                $image = $this->media()->where('media_items.type', 'og-image')->latest()->first();
            }

            if ($key == 'image-alt') {
                return $image?->alt ?: optional($default_metadata)['image-alt'];
            }

            $image = $image?->getSignedUrl(['w' => 1200, 'h' => 630, 'fit' => 'crop', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]);

            if (! $image) {
                $image = optional($default_metadata)['image'];
            }

            if (! $image && $image = setting('logo')) {
                $image = $image->getSignedUrl(['border' => '200,FFF,expand', 'w' => '800', 'h' => 230, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]);
            }

            return $image ? asset($image) : asset('images/default.webp');
        }

        $this->loadMissing('metadata');

        $metadatum = $this->metadata->where('key', $key)->first()?->value ?: optional($default_metadata)[$key];

        if ($key == 'keywords') {
            $metadatum = is_array($metadatum) ? implode(',', $metadatum) : $metadatum;
        }

        return $metadatum;
    }

    public function metadata()
    {
        return $this->morphMany(Metadatum::class, 'seoable');
    }

    public function loadMetadata()
    {
        $this->loadMissing('metadata');

        foreach (['title', 'description', 'keywords'] as $key) {
            $datum = $this->metadata->where('key', $key)->first();

            $datum = optional($datum?->getAttributes())['value'];

            try {
                $datum = json_decode($datum, true);
            } catch (\Throwable $th) {
                //
            }

            if (in_array($key, ['keywords'])) {
                if (! is_array($datum)) {
                    $datum = [];
                }

                foreach (array_keys(locales()) as $locale) {
                    $datum[$locale] = $datum[$locale] ?? [];
                }
            }

            $this->{'meta_'.$key} = $datum;
        }
    }

    protected static function bootSeoable()
    {
        static::saving(function (self $seoable) {
            foreach (['title', 'description', 'keywords'] as $key) {
                if (isset($seoable->attributes['meta_'.$key])) {
                    $metadata[$key] = $seoable->attributes['meta_'.$key];
                    $metadata[$key] = is_array($metadata[$key]) ? array_filter($metadata[$key]) : $metadata[$key];
                    unset($seoable->attributes['meta_'.$key]);
                }
            }

            $seoable->_metadata = $metadata ?? [];
        });

        static::saved(function (self $seoable) {
            foreach ($seoable->_metadata as $key => $value) {
                $seoable->metadata()->updateOrCreate(['key' => $key], ['value' => json_decode($value, true)]);
            }
        });
    }
}
