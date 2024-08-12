<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations, Seoable, Sluggable, SoftDeletes;

    protected $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['description' => 'array', 'attributes' => 'array', 'locales' => 'array'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function main_category()
    {
        return $this->belongsTo(StoreCategory::class, 'main_category_id');
    }

    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function specs()
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function images()
    {
        return $this->media()->where('media_items.type', 'product-image');
    }

    public function getImagesAttribute()
    {
        if ($this->relationLoaded('media')) {
            return $this->media->filter(fn ($media) => $media->pivot->type != 'og-image');
        }

        return $this->images()->get();
    }

    public function image()
    {
        return $this->first_media()->where('media_items.type', 'product-image');
    }

    public function getImageAttribute()
    {
        if ($this->relationLoaded('media')) {
            return $this->images->first();
        }

        return $this->image()->first();
    }

    public function getDefaultMetadata()
    {
        return [
            'title' => str($this->name)->limit(100),
            'description' => str(tiptap_converter()->asText($this->description ?: ['content' => '']))->limit(200),
            'keywords' => explode(' ', $this->name),
        ];
    }

    /**
     * Filter the attributes array that is saved in the database
     * and excludes the attributes and or values that has been deleted
     */
    public function getAttributesAttribute(): array
    {
        $attributes = $this->getAttributes()['attributes'];
        $attributes = json_decode($attributes, true) ?: [];

        $attributes_ids = Attribute::whereIn('id', collect($attributes)->pluck('attribute')->toArray())->pluck('id')->toArray();
        $values_ids = AttributeValue::whereIn('id', collect($attributes)->pluck('values')->flatten()->toArray())->pluck('id')->toArray();

        return collect($attributes)->filter(function ($attribute) use ($attributes_ids) {
            return in_array($attribute['attribute'] ?? [], $attributes_ids);
        })->map(function ($attribute) use ($values_ids) {
            $attribute['values'] = collect($attribute['values'] ?? [])->filter(function ($value) use ($values_ids) {
                return in_array($value, $values_ids);
            })->values()->toArray();

            return $attribute;
        })->filter(fn ($attribute) => count($attribute['values'] ?? []))->values()->toArray();
    }

    public function getAttributesWithValuesAttribute()
    {
        $attributes_with_values = $this->getAttributes()['attributes'];
        $attributes_with_values = json_decode($attributes_with_values, true) ?: [];

        $attributes = Attribute::whereIn('id', collect($attributes_with_values)->pluck('attribute')->toArray())->get();
        $values = AttributeValue::whereIn('id', collect($attributes_with_values)->pluck('values')->flatten()->toArray())->get();

        return collect($attributes_with_values)->filter(function ($attribute_with_values) use ($attributes) {
            return $attributes->where('id', $attribute_with_values['attribute'])->count();
        })->map(function ($attribute_with_values) use ($attributes, $values) {
            $attribute = $attributes->where('id', $attribute_with_values['attribute'])->first();
            $values = $values->whereIn('id', $attribute_with_values['values'])->map(function ($value) use ($attribute_with_values) {
                $value->order = array_search($value->id, $attribute_with_values['values']);

                return $value;
            })->sortBy('order');

            $attribute->setRelation('values', $values);

            return $attribute;
        })->filter(fn ($attribute) => $attribute->values->count());
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $product) {
            try {
                unset($product->attributes['main_category_id']);
            } catch (\Throwable $th) {
                //
            }
        });

        static::deleting(function (self $product) {
            $product->slug = str()->uuid();
            $product->save();
        });
    }
}
