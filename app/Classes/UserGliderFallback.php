<?php

namespace App\Classes;

use Awcodes\Curator\Glide\GliderFallback;

class UserGliderFallback extends GliderFallback
{
    public function getAlt(): string
    {
        return __('Default user image');
    }

    public function getKey(): string
    {
        return 'user';
    }

    public function getSource(): string
    {
        return asset('images/default-user.webp');
    }

    public function getType(): string
    {
        return 'image/webp';
    }

    public function getWidth(): int
    {
        return 64;
    }

    public function getHeight(): int
    {
        return 64;
    }
}
