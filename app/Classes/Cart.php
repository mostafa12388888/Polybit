<?php

namespace App\Classes;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;

class Cart
{
    public $items = [];

    public function __construct()
    {
        $this->items = self::get_cart_items();
    }

    public function get_cart_items()
    {
        $cart = request()->cookie('cart');
        $cart = json_decode($cart, true);

        return is_array($cart) ? $cart : [];
    }

    public function add($product, $variant = null, $quantity = 1)
    {
        $item = collect($this->items)->where('product', $product)->where('variant', $variant);

        if ($item->count()) {
            $index = $item->keys()->first();
            $item = $item->first();
            $item['quantity'] = $item['quantity'] + 1;

            $this->items[$index] = $item;
        } else {
            $this->items[] = compact('product', 'variant', 'quantity');
        }

        Cookie::queue('cart', json_encode($this->items), 30 * 24 * 60);
    }

    public function remove($index)
    {
        unset($this->items[$index]);

        Cookie::queue('cart', json_encode($this->items), 30 * 24 * 60);
    }

    public function clear()
    {
        $this->items = [];

        Cookie::queue('cart', '[]', 30 * 24 * 60);
    }

    public function update_quantity($index, int $quantity)
    {
        if ($this->items[$index] ?? null) {
            if ($quantity > 0) {
                $this->items[$index]['quantity'] = $quantity;
            } else {
                unset($this->items[$index]);
            }
        }

        Cookie::queue('cart', json_encode($this->items), 30 * 24 * 60);
    }

    public function items()
    {
        $products = Product::with('image')->whereIn('id', collect($this->items)->pluck('product')->toArray())->get();
        $variants = ProductVariant::with('attribute_values')->whereIn('id', collect($this->items)->pluck('variant')->toArray())->get();

        $items = collect($this->items)->mapWithKeys(function ($item, $index) use ($products, $variants) {
            $product = $products->where('id', $item['product'])->first();
            $variant = $variants->where('id', $item['variant'])->first();

            if ($product) {
                $product = clone $product;
                $product->quantity = $item['quantity'];
                $product->index = $index;
            }

            if ($product && $variant) {
                $variant = clone $variant;
                $product->setRelation('variant', $variant);
            }

            return [$index => $product];
        })->filter();

        return $items;
    }

    public function items_count()
    {
        return count($this->items);
    }
}
