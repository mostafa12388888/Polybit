<?php

namespace App\Models;

use App\Traits\HasCuratorMedia;
use App\Traits\HasLocales;
use App\Traits\HasTranslations;
use App\Traits\Searchable;
use App\Traits\Seoable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasCuratorMedia, HasLocales, HasTranslations, Searchable, Seoable, Sluggable, SoftDeletes;

    protected $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'videos'];

    protected $casts = ['description' => 'array', 'attributes' => 'array', 'locales' => 'array', 'embeded_urls' => 'array', 'videos' => 'array'];

    protected $guarded = [];

    public $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.slug' => 7,
            'products.sku' => 7,
            'products.description' => 3,
        ],
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->orderByPivot('product_tag.created_at');
    }

    public function categories()
    {
        return $this->belongsToMany(StoreCategory::class, 'product_store_category')->orderByPivot('product_store_category.created_at');
    }

    public function category()
    {
        return $this->categories()->limit(1);
    }

    public function getCategoryAttribute()
    {
        return $this->category()->first();
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function variantsStatusOn()
    {
        return $this->variants()->where('product_variants.status', 'on');
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
        if ($this->relationLoaded('media') || $this->relationLoaded('images')) {
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
            'image' => $this->image?->getSignedUrl(['w' => 1200, 'h' => 630, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]),
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

    public function ratings_count()
    {
        // Set a fixed seed for consistent results
        mt_srand($this->id);

        // Calculate base ratings count
        $baseRatings = (int) ($this->rate * 53);

        // Introduce variability
        $variability = (int) ($baseRatings * 0.9);

        // Generate fake ratings count
        $fakeRatingsCount = max(0, mt_rand($baseRatings - $variability, $baseRatings + $variability));

        return $fakeRatingsCount;
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('products'));

        static::deleted(fn () => Cache::forget('products'));

        static::deleting(function (self $product) {
            $product->slug = str()->uuid();
            $product->save();
        });
    }
}
