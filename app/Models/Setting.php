<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasTranslations;

    protected $translatable = ['value'];

    protected $fillable = ['key', 'value', 'user_id'];

    public static $allowed_settings = [
        'app_name' => [
            'translatable' => true,
            'use_fallback_locale_translation' => true,
            'type' => 'string',
            'default' => null,
        ],
        'app_description' => [
            'translatable' => true,
            'use_fallback_locale_translation' => true,
            'type' => 'string',
            'default' => null,
        ],
        'logo' => [
            'translatable' => true,
            'use_fallback_locale_translation' => true,
            'type' => 'media',
            'default' => null,
        ],
        'darkmode_logo' => [
            'translatable' => true,
            'use_fallback_locale_translation' => true,
            'type' => 'media',
            'default' => null,
        ],
        'favicon' => [
            'translatable' => false,
            'type' => 'media',
            'default' => null,
        ],
        'header_banner' => [
            'translatable' => false,
            'type' => 'media',
            'default' => null,
        ],
        'darkmode_header_banner' => [
            'translatable' => false,
            'type' => 'media',
            'default' => null,
        ],
        'addresses' => [
            'translatable' => true,
            'use_fallback_locale_translation' => false,
            'type' => 'array',
            'default' => [],
        ],
        'emails' => [
            'translatable' => false,
            'type' => 'array',
            'default' => [],
        ],
        'phones' => [
            'translatable' => false,
            'type' => 'array',
            'default' => [],
        ],
        'social_links' => [
            'translatable' => false,
            'type' => 'array',
            'default' => [],
        ],
        'location' => [
            'translatable' => false,
            'type' => 'string',
            'default' => null,
        ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function format($wants_translation = true)
    {
        $setting = $this;
        $allowed_settings = self::$allowed_settings;
        $type = optional($allowed_settings[$setting->key] ?? [])['type'] ?? null;
        $translatable = optional($allowed_settings[$setting->key] ?? [])['translatable'] ?? false;
        $use_fallback_locale_translation = optional($allowed_settings[$setting->key] ?? [])['use_fallback_locale_translation'] ?? false;

        $data = $setting->only('key', 'value');

        if (($translatable && ! $wants_translation) || ($translatable && ! $use_fallback_locale_translation) || ! $translatable) {
            $data['value'] = $setting->getAttributes()['value'];
        }

        if ($translatable && ! $wants_translation) {
            try {
                $data['value'] = is_null($data['value'] ?? null) ? [] : json_decode($data['value'], true);
            } catch (\Throwable $th) {
                //
            }

            foreach ($data['value'] as $locale => $value) {
                $data['value'][$locale] = $this->get_value_in_the_right_type($value, $type);
            }
        } elseif ($translatable && ! $use_fallback_locale_translation) {
            $data['value'] = $this->get_value_in_the_right_type($data['value'] ?? null, $type);
            $data['value'] = $data['value'][app()->getLocale()] ?? null;
        } else {
            $data['value'] = $this->get_value_in_the_right_type($data['value'], $type);
        }

        return $data;
    }

    public function get_value_in_the_right_type($value, $type)
    {
        if ($type == 'boolean') {
            $value = (bool) $value;
        } elseif ($type == 'array') {
            try {
                $value = is_null($value ?? null) ? [] : json_decode($value, true);
                $value = array_filter($value);
            } catch (\Throwable $th) {
                //
            }
        } elseif ($type == 'media') {
            $value = $this->media;
        }

        return $value;
    }

    public function media()
    {
        return $this->belongsTo(CuratorMedia::class, 'value');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $setting) {
            $setting->value = is_array($setting->value) ? json_encode($setting->value) : $setting->value;
            Cache::forget('settings');
        });

        static::saved(fn () => Cache::forget('settings'));
    }
}
