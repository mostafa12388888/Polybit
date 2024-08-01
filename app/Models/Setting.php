<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasCuratorMedia, HasTranslations;

    protected $translatable = ['value'];

    protected $fillable = ['key', 'value', 'user_id'];

    public static $allowed_settings = [
        'app_name' => [
            'translatable' => true,
            'type' => 'string',
            'default' => null,
        ],
        'logo' => [
            'translatable' => true,
            'type' => 'media',
            'default' => null,
        ],
        'darkmode_logo' => [
            'translatable' => true,
            'type' => 'media',
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
        $type = optional($allowed_settings[$setting->key])['type'];
        $translatable = optional($allowed_settings[$setting->key])['translatable'];

        $data = $setting->only('key', 'value');

        if ($translatable && ! $wants_translation) {
            $data['value'] = $setting->getAttributes()['value'];

            try {
                $data['value'] = is_null($data['value'] ?? null) ? [] : json_decode($data['value'], true);
            } catch (\Throwable $th) {
                //
            }

            foreach ($data['value'] as $locale => $value) {
                $data['value'][$locale] = $this->get_value_in_the_right_type($value, $type);
            }
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
            } catch (\Throwable $th) {
                //
            }
        } elseif ($type == 'media') {
            $value = CuratorMedia::find($value);
        }

        return $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $setting) {
            $setting->value = is_array($setting->value) ? json_encode($setting->value) : $setting->value;
            Cache::clear('settings');
        });

        static::saved(fn () => Cache::clear('settings'));
    }
}
