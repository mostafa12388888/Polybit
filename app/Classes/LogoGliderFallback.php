<?php

namespace App\Classes;

use Awcodes\Curator\Glide\GliderFallback;

class LogoGliderFallback extends GliderFallback
{
    public function getAlt(): string
    {
        return config('app.name');
    }

    public function getHeight(): int
    {
        return 640;
    }

    public function getKey(): string
    {
        return 'logo';
    }

    public function getSource(): string
    {
        $logo = setting('logo')?->getSignedUrl([
            'w' => 200,
            'h' => 200,
            'fit' => 'fill-max',
            'bg' => 'F5F5F5',
            'border' => '100,F5F5F5,expand',
            'fm' => 'webp',
        ]) ?: '/images/default.webp';

        return asset($logo);
    }

    public function getType(): string
    {
        return 'image/webp';
    }

    public function getWidth(): int
    {
        return 420;
    }
}
