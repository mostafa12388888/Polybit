<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Awcodes\Curator\Models\Media;

class Card extends Model
{
    use HasFactory, HasCuratorMedia,HasLocales, HasTranslations, Searchable, Seoable;


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

    /**
     * علاقة مباشرة مع جدول media
     * mediaFile تعني ملف الصورة أو الفيديو المرتبط بـ card
     */
    public function mediaFile(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_or_video');
    }

    /**
     * جلب الصور المرتبطة بهذا الكارد (لو كنت تستخدم النوع داخل pivot)
     */
    public function images()
    {
        return $this->media()->where('media_items.type', 'card-image');
    }


    /**
     * جلب أول صورة من الصور المرتبطة (Image only)
     */
    public function getImageAttribute()
    {
        return $this->images()->first();
    }

    /**
     * جلب صورة الفيديو (لو النوع مختلف مثلاً card-video)
     */
    public function video()
    {
        return $this->media()->where('media_items.type', 'card-video');
    }

    /**
     * تحديد هل الكارد يحتوي على فيديو داخلي (is_video = 2)
     */
    public function hasInternalVideo(): bool
    {
        return $this->is_video == 2 && $this->mediaFile;
    }

    /**
     * تحديد هل الكارد يحتوي على فيديو خارجي (is_video = 3)
     */
    public function hasExternalVideos(): bool
    {
        return $this->is_video == 3 && is_array($this->external_videos) && count($this->external_videos);
    }
}
