<?php

namespace App\Traits;

use App\Models\CuratorMedia;
use App\Models\MediaItem;

trait HasCuratorMedia
{
    public function media()
    {
        return $this
            ->belongsToMany(CuratorMedia::class, app(MediaItem::class)->getTable(), 'mediable_id', 'media_id')
            ->where('mediable_type', $this->getMorphClass())
            ->withPivot('order')
            ->orderBy('order');
    }

    public function first_media()
    {
        return $this->hasOneThrough(CuratorMedia::class, MediaItem::class, 'mediable_id', 'id', 'id', 'media_id')
            ->where('mediable_type', $this->getMorphClass())
            ->orderBy('order');
    }

    public function media_items()
    {
        return $this->morphMany(MediaItem::class, 'mediable')->orderBy('order');
    }
}
