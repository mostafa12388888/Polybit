<?php

namespace App\Models;

use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasLocales, HasTranslations, Seoable, Sluggable;

    public $translatable = ['title', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['body' => 'array', 'locales' => 'array', 'is_editable' => 'boolean'];

    protected $guarded = [];

    public static $preset_pages = [
        'home' => 'Home',
        'products.index' => 'Products',
        'cart' => 'Shopping Cart',
        'wishlist' => 'Wishlist',
        'request-quote' => 'Request Quote',
        'posts.index' => 'Blog Posts',
        'projects.index' => 'Projects',
        'contact-us' => 'Contact Us',
        'faq' => 'Frequently asked questions',
        'register' => 'Register New Account',
        'login' => 'Login',
        'password.request' => 'Reset Password',
        'catalogs.index' => 'Catalogs',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->title)->limit(100),
            'description' => str(tiptap_converter()->asText($this->body ?: ['content' => '']))->limit(200),
            'keywords' => explode(' ', $this->title),
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('pages'));

        static::deleting(fn (self $page) => $page->is_editable);

        static::deleted(fn () => Cache::forget('pages'));
    }
}
