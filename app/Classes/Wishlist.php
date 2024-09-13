<?php

namespace App\Classes;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class Wishlist
{
    public $items = [];

    public function __construct()
    {
        $this->items = self::get_wishlist_items();
    }

    public function get_wishlist_items()
    {
        $wishlist = request()->cookie('wishlist');
        $wishlist = json_decode($wishlist, true);

        return is_array($wishlist) ? $wishlist : [];
    }

    public function add($product)
    {
        $item = collect($this->items)->where('product', $product);

        if ($item->count()) {
            $index = $item->keys()->first();
            $item = $item->first();

            $this->items[$index] = $item;
        } else {
            $this->items[] = compact('product');
        }

        Cookie::queue('wishlist', json_encode($this->items), 30 * 24 * 60);
    }

    public function remove($index)
    {
        unset($this->items[$index]);

        Cookie::queue('wishlist', json_encode($this->items), 30 * 24 * 60);
    }

    public function clear()
    {
        $this->items = [];

        Cookie::queue('wishlist', '[]', 30 * 24 * 60);
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

        Cookie::queue('wishlist', json_encode($this->items), 30 * 24 * 60);
    }

    public function update_items()
    {
        $this->items = $this->items()->map(function ($product) {
            return [
                'product' => $product->id,
            ];
        })->toArray();

        Cookie::queue('wishlist', json_encode($this->items), 30 * 24 * 60);
    }

    public function items()
    {
        $products = Product::with('image')->whereIn('id', collect($this->items)->pluck('product')->toArray())->get();

        $items = collect($this->items)->mapWithKeys(function ($item, $index) use ($products) {
            $product = $products->where('id', $item['product'])->first();

            if ($product) {
                $product = clone $product;
                $product->index = $index;
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
