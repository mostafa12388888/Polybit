<?php

namespace App\Classes;

use Awcodes\Curator\Glide\GliderFallback;

class LogoGliderFallback extends GliderFallback
{
    public function getAlt(): string
    {
        return __(':app_name Logo', ['app_name' => config('app.name')]);
    }

    public function getKey(): string
    {
        return 'logo';
    }

    public function getSource(): string
    {
        $logo = setting('logo')?->getSignedUrl([
            'w' => 340,
            // 'h' => 300,
            'fit' => 'fill-max',
            'bg' => 'FFFFFF',
            'border' => '70,FFFFFF,expand',
            'fm' => 'webp',
            'q' => 70,
        ], true) ?: '/images/default.webp';

        return asset($logo);
    }

    public function getType(): string
    {
        return 'image/webp';
    }

    public function getWidth(): int
    {
        return 400;
    }

    public function getHeight(): int
    {
        return 640;
    }
}
