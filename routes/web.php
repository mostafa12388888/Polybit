<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Livewire\Cart;
use App\Livewire\ContactUs;
use App\Livewire\RequestQuote;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

// TODO: Search
// TODO: Schema json/ld

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

Route::resource('products', ProductController::class)->only('index', 'show');
Route::get('/store-categories/{category}', [ProductController::class, 'category_products'])->name('store-categories.show');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/request-quote', RequestQuote::class)->name('request-quote');

Route::resource('posts', PostController::class)->only('index', 'show');
Route::get('/blog-categories/{category}', [PostController::class, 'category_posts'])->name('blog-categories.show');

Route::resource('projects', ProjectController::class)->only('index', 'show');

Route::resource('/pages', PageController::class)->only('show');

Route::get('/contact-us', ContactUs::class)->name('contact-us');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
