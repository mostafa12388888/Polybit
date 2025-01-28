<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Glide\Urls\UrlBuilderFactory;

class CuratorMedia extends Media
{
    protected $table = 'curator_media';

    public function generate_png_from_svg()
    {
        $svg = Storage::disk($this->disk)->read($this->path);

        $im = new \Imagick;
        $im->readImageBlob($svg);
        $im->setImageFormat('png24');

        Storage::disk($this->disk)->write($this->path.'.png', $im->getimageblob());

        $im->clear();
        $im->destroy();
    }

    public function delete_png_conversion()
    {
        if (stripos($this->type, 'svg') !== false && Storage::disk($this->disk)->exists($this->path.'.png')) {
            Storage::disk($this->disk)->delete($this->path.'.png');
        }
    }

    public function getSignedUrl(array $params = [], bool $force = false): string
    {
        if (! $force) {
            if (
                ! $this->resizable ||
                in_array($this->disk, config('curator.cloud_disks')) ||
                ! Storage::disk($this->disk)->exists($this->path)
            ) {
                return $this->url;
            }
        }

        $image = clone $this;

        if (stripos($image->type, 'svg') !== false) {
            if (! Storage::disk($image->disk)->exists($image->path.'.png')) {
                $this->generate_png_from_svg();
            }

            $image->path = $image->path.'.png';
            $image->type = 'image/png';
            $image->ext = 'png';
        }

        $routeBasePath = Str::of(config('curator.glide.route_path', 'curator'))
            ->trim('/')
            ->prepend('/')
            ->append('/')
            ->toString();

        $urlBuilder = UrlBuilderFactory::create($routeBasePath, config('app.key'));

        return $urlBuilder->getUrl($image->path, $params);
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(fn ($image) => $image->delete_png_conversion());

        static::deleting(fn ($image) => $image->delete_png_conversion());

        static::deleted(fn () => Artisan::call('cache:clear'));
    }
}
