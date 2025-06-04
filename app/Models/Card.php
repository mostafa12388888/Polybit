<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasCuratorMedia, HasFactory,HasLocales, HasTranslations, Searchable, Seoable;

    protected $fillable = ['is_video', 'image_or_video', 'link', 'title', 'description', 'external_videos'];

    public $translatable = ['title', 'description'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'external_videos' => 'array',
    ];

    public $searchable = [
        'columns' => [
            'cards.title' => 10,
            'cards.description' => 3,
        ],
    ];


    public function media_file(): BelongsTo
    {
        return $this->belongsTo(CuratorMedia::class, 'image_or_video');
    }

    public function hasExternalVideos(): bool
    {
        return $this->is_video == 3 && is_array($this->external_videos) && count($this->external_videos);
    }
}
