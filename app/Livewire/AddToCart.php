<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AddToCart extends Component
{
    public Product $product;

    /**
     * Product's variants with it's values
     */
    #[Locked]
    public array $variants = [];

    /**
     * Attributes and values Used in the product variants
     * any attributes or values that are not used in the variants are excluded
     */
    #[Locked]
    public array $attribute_values = [];

    /**
     * List of available attribute values for selection
     * This array gets updated every time the user select an attribute value
     * to give a list of the values that are avaiable with the selected attribute values
     * Any attribute value that dowsn't exist in this list should be disabled in the ui so user can't choose it
     * unless he updated his other selections which will make this array change
     */
    #[Locked]
    public array $available_attribute_values = [];

    public array $selected_attribute_values = [];

    public $added_to_cart;

    public function mount()
    {
        $variants = $this->product->variants;

        $this->variants = $variants->pluck('attribute_values', 'id')->map(fn ($variant_values) => $variant_values->pluck('id')->values()->toArray())->toArray();

        $this->attribute_values = $variants->pluck('attribute_values')->flatten()->groupBy('attribute_id')
            ->map(fn ($attribute_values) => $attribute_values->pluck('id')->unique()->values()->toArray())->toArray();

        $this->available_attribute_values = collect($this->attribute_values)->flatten()->toArray();
    }

    public function updatedSelectedAttributeValues($value)
    {
        $this->added_to_cart = null;

        $this->available_attribute_values = collect($this->attribute_values)->mapWithKeys(function ($values, $attribute) {
            $other_attributes_values = collect($this->selected_attribute_values)
                ->filter(fn ($selected_values, $selected_attribute) => $attribute != $selected_attribute)
                ->flatten()->map(fn ($value) => (int) $value)->filter()->toArray();

            // The variants that has other attributes values
            $variants = collect($this->variants)->filter(function ($variant) use ($other_attributes_values) {
                return ! array_diff($other_attributes_values, $variant);
            });

            $variants_attribute_values = $variants->flatten()->toArray();

            return [
                $attribute => collect($values)->filter(fn ($value) => in_array($value, $variants_attribute_values))->toArray(),
            ];
        })->flatten()->toArray();
    }

    public function add_to_cart()
    {
        $variant = $this->variants ? $this->get_variant() : null;

        if (! $this->product->is_available || ($this->variants && ! $variant)) {
            $this->addError('availability', __('Currently unavailable.'));

            return;
        }

        foreach ($this->available_attributes_with_values as $attribute) {
            if ($attribute->values->count() > 1 && ! isset($this->selected_attribute_values[$attribute->id])) {
                $this->addError('attribute_'.$attribute->id, __('You have to select :attribute to continue', ['attribute' => $attribute->name]));
            }
        }

        if ($this->getErrorBag()->count()) {
            return;
        }

        cart()->add($this->product->id, $variant);

        $this->added_to_cart = true;

        $this->dispatch('cart-updated');
    }

    public function get_variant()
    {
        $variants = collect($this->variants)->filter(function ($variant) {
            return ! array_diff(array_filter($this->selected_attribute_values), $variant);
        });

        return array_keys($variants->toArray())[0] ?? null;
    }

    public function getAvailableAttributesWithValuesProperty()
    {
        return $this->product->attributes_with_values->filter(function ($attribute) {
            return in_array($attribute->id, array_keys($this->attribute_values));
        })->map(function ($attribute) {
            $values = $attribute->values->filter(fn ($value) => in_array($value->id, optional($this->attribute_values)[$attribute->id] ?: []));
            $attribute->setRelation('values', $values);

            return $attribute;
        });
    }

    public function render()
    {
        return view('products.components.add-to-cart');
    }
}
