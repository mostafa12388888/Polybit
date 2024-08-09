<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

// TODO: Dashboard Stats

// TODO: Sitemap

// TODO: dynamicData
// TODO: products
// TODO: product
// TODO: pages
// TODO: contact

// TODO: Localization
// TODO: cart
// TODO: checkout
// TODO: search
// TODO: Contact Messages
// TODO: Orders
// TODO: Schema

Livewire::setUpdateRoute(function ($handle) {
    if (in_array(request()->segment(1), array_keys(locales()))) {
        if (! (collect(locales(false))->where('code', request()->segment(1))->first()['default'] ?? false)) {
            $prefix = request()->segment(1);
        }
    }

    return Route::post(($prefix ?? null).'/livewire/update', $handle);
});

Route::view('/', 'home.index')->name('home');
Route::view('/search', 'home.index')->name('search');

Route::view('/products', 'products.index')->name('products.index');
Route::view('/products/{product}', 'products.show')->name('products.show');
Route::view('/cart', 'products.cart')->name('cart');
Route::view('/request-quote', 'products.request-quote')->name('request-quote');
Route::view('/store-categories/{store_category}', 'products.index')->name('store-categories.show');

Route::resource('posts', PostController::class)->only('index', 'show');
Route::get('/blog-categories/{category}', [PostController::class, 'category_posts'])->name('blog-categories.show');

Route::resource('projects', ProjectController::class)->only('index', 'show');

Route::view('/pages/{page}', 'pages.show')->name('pages.show');

Route::view('/contact-us', 'pages.contact-us')->name('contact-us');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::get('/user', function () {
    \Illuminate\Support\Facades\Auth::loginUsingId(1);

    return redirect()->route('profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
