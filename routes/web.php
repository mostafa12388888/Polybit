<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/search', SearchController::class)->name('search');

Route::resource('products', ProductController::class)->only('index', 'show');
Route::get('/product-store-show/{product}', [ProductController::class,'showStore'])->name('products.show.store');
Route::get('/product-store', [ProductController::class,'productStore'])->name('product.store');
Route::get('/store-categories/{category}', [ProductController::class, 'category_products'])->name('store-categories.show');
Route::view('/cart', 'products.cart')->name('cart');
Route::view('/wishlist', 'products.wishlist')->name('wishlist');
Route::view('/request-quote', 'products.request-quote')->name('request-quote');

Route::resource('catalogs', CatalogController::class)->only('index', 'show');

Route::resource('posts', PostController::class)->only('index', 'show');
Route::get('/blog-categories/{category}', [PostController::class, 'category_posts'])->name('blog-categories.show');
Route::redirect('/user/{user}', '/posts')->name('users.show');

Route::resource('projects', ProjectController::class)->only('index', 'show');

Route::resource('/pages', PageController::class)->only('show');

Route::view('/contact-us', 'pages.contact-us')->name('contact-us');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/robots.txt', function () {
    return response(implode(PHP_EOL, [
        'User-agent: *',
        'Allow: /',
        '',
        'Sitemap: '.url('sitemap.xml'),
    ]), 200, ['Content-Type' => 'text/plain']);
});

require __DIR__.'/auth.php';
