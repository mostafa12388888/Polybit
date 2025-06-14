<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StoreCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->with('image', 'category', 'tags')->paginate(12);

        return view('products.index', compact('products'));
    }

    /**
     * productStore
     *
     * @return void
     */
    public function productStore()
    {
        $products = Product::whereHas('variantsStatusOn')->latest()->with('image', 'category', 'tags')->paginate(12);

        return view('products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->loadMissing('media', 'specs.media', 'variants.attribute_values', 'category', 'tags');

        $related_products = collect();

        if ($product->category) {
            $categories = $product->category->parent->sub_categories()->pluck('id')->toArray();

            $related_products = Product::whereHas('categories', function ($query) use ($categories) {
                return $query->whereIn('store_categories.id', $categories);
            })->where('products.id', '!=', $product->id)->limit(6)->inRandomOrder()->get();
        }

        return view('products.show', compact('product', 'related_products'));
    }

    public function showStore(Product $product)
    {
        $product = Product::whereHas('variantsStatusOn')->with('media', 'specs.media', 'variantsStatusOn.attribute_values.attribute', 'category', 'tags')->find($product->id);
        // $product->loadMissing('media', 'specs.media', 'variantsStatusOn.attribute_values.attribute', 'category', 'tags');

        $related_products = collect();

        if ($product->category) {
            $categories = $product->category->parent->sub_categories()->pluck('id')->toArray();

            $related_products = Product::whereHas('variantsStatusOn')->whereHas('categories', function ($query) use ($categories) {
                return $query->whereIn('store_categories.id', $categories);
            })->where('products.id', '!=', $product->id)->limit(6)->inRandomOrder()->get();
        }
        // return $product->variantsStatusOn[0]->attribute_values[0]->attribute;

        return view('products.show', compact('product', 'related_products'));
    }

    public function category_products(StoreCategory $category)
    {
        $category->loadMissing('image');

        $products = $category->is_parent_category() ? $category->sub_categories_products() : $category->products();

        $products = $products->latest()->with('image')->paginate(12);

        return view('products.index', compact('products', 'category'));
    }
}
