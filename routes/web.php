<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Users
// Projects

// TODO: BlogCategories
// TODO: Posts

// TODO: StoreCategories
// TODO: Attributes
// TODO: Options
// TODO: OptionValues
// TODO: Products

// TODO: Orders

// TODO: Contact Messages

// Pages

// FAQ

// TODO: Localization
// TODO: Settings

Route::view('/', 'home.index')->name('home');
Route::view('/search', 'home.index')->name('search');

Route::view('/products', 'products.index')->name('products.index');
Route::view('/products/{product}', 'products.show')->name('products.show');
Route::view('/cart', 'products.cart')->name('cart');
Route::view('/request-quote', 'products.request-quote')->name('request-quote');

Route::view('/posts', 'posts.index')->name('posts.index');
Route::view('/posts/{post}', 'posts.show')->name('posts.show');

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
