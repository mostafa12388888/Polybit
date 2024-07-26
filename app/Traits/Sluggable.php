<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait Sluggable
{
    protected static $table_columns;

    protected static function slugFrom()
    {
        if (defined('self::SLUG_FROM')) {
            return self::SLUG_FROM;
        }

        foreach (['title', 'name'] as $column) {
            if (in_array($column, self::$table_columns)) {
                return $column;
            }
        }
    }

    protected static function slugTo()
    {
        if (defined('self::SLUG_TO')) {
            return self::SLUG_TO;
        }

        foreach (['slug', 'uid'] as $column) {
            if (in_array($column, self::$table_columns)) {
                return $column;
            }
        }
    }

    protected static function slugUniqueFor()
    {
        return defined('Self::SLUG_UNIQUE_FOR') ? self::SLUG_UNIQUE_FOR : [];
    }

    protected function is_unique_slug($slug)
    {
        $record_with_the_same_slug = in_array(SoftDeletes::class, class_uses_recursive(self::class)) ?
            self::withTrashed() : self::newQuery();

        $record_with_the_same_slug = $record_with_the_same_slug->where(self::slugTo(), $slug);

        foreach (self::slugUniqueFor() as $field) {
            $record_with_the_same_slug = $record_with_the_same_slug->where($field, $this->{$field});
        }

        $record_with_the_same_slug = $record_with_the_same_slug->first();

        if ($record_with_the_same_slug && (! $this->id || $this->id != $record_with_the_same_slug->id)) {
            return false;
        }

        return true;
    }

    protected function is_valid_slug($slug)
    {
        if (! $slug) {
            return false;
        }

        if ((! defined('Self::SLUG_UNIQUE') || self::SLUG_UNIQUE) && ! $this->is_unique_slug($slug)) {
            return false;
        }

        return true;
    }

    protected function generate_slug()
    {
        $string = request()->slug ?: optional($this)->{self::slugFrom()};
        $string = ! $this->id && $this->slug ? $this->slug : $string;

        if (! $string) {
            return uniqid();
        }

        // This will make sure only arabic and english characters are allowed

        if ((defined('Self::SLUG_ARABIC_ALLOWED') && self::SLUG_ARABIC_ALLOWED)) {
            $string = mb_strtolower($string, 'UTF-8');
            $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", ' ', $string);

            // convert multiple spaces and dashes to one space
            $string = preg_replace("/[\s-]+/", ' ', $string);

            // Convert spaces to dash
            return preg_replace("/[\s_]/", '-', trim($string));
        } elseif ((defined('Self::SLUG_ALL_LANGUAGES_ALLOWED') && self::SLUG_ALL_LANGUAGES_ALLOWED)) {
            return Str::slug($string, '-', null);
        } else {
            return Str::slug($string);
        }
    }

    protected function tweak_slug($slug)
    {
        return $slug.'-'.strtolower(Str::random(3));
    }

    protected function assign_slug()
    {
        $slug = $this->generate_slug();

        if (! $this->is_valid_slug($slug)) {
            $slug = $this->tweak_slug($slug);
        }

        $this->{self::slugTo()} = $slug;
    }

    protected static function bootSluggable()
    {
        static::saving(function ($sluggable) {
            if (! defined('self::SLUG_FROM') || ! defined('self::SLUG_TO')) {
                self::$table_columns = Cache::remember((new self)->getTable().'_columns', 24 * 60 * 60, function () {
                    return Schema::getColumnListing((new self)->getTable());
                });
            }

            if (request()->has('slug') || ! $sluggable->{self::slugTo()} || $sluggable->isDirty(self::slugFrom())) {
                $sluggable->assign_slug();
            }
        });
    }
}
