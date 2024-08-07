<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// TODO: Dashboard Stats

// TODO: Sitemap

// TODO: dynamicData
// TODO: header
// TODO: footer
// TODO: home
// TODO: products
// TODO: product
// TODO: posts
// TODO: post
// TODO: projects
// TODO: project
// TODO: faqs
// TODO: pages
// TODO: contact

// TODO: Localization
// TODO: cart
// TODO: checkout
// TODO: search
// TODO: Contact Messages
// TODO: Orders
// TODO: Schema

Route::view('/', 'home.index')->name('home');
Route::view('/search', 'home.index')->name('search');

Route::view('/products', 'products.index')->name('products.index');
Route::view('/products/{product}', 'products.show')->name('products.show');
Route::view('/cart', 'products.cart')->name('cart');
Route::view('/request-quote', 'products.request-quote')->name('request-quote');
Route::view('/store-categories/{store_category}', 'products.index')->name('store-categories.show');

Route::view('/posts', 'posts.index')->name('posts.index');
Route::view('/posts/{post}', 'posts.show')->name('posts.show');
Route::view('/blog-categories/{blog_catgeory}', 'posts.index')->name('blog-categories.show');

Route::view('/projects', 'projects.index')->name('projects.index');
Route::view('/projects/{post}', 'projects.show')->name('projects.show');

Route::view('/pages/{page}', 'pages.show')->name('pages.show');

Route::view('/contact-us', 'pages.contact-us')->name('contact-us');

Route::view('/faq', 'faqs.index')->name('faq');

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
