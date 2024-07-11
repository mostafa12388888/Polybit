<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');
Route::view('/search', 'home.index')->name('search');

Route::view('/products', 'products.index')->name('products.index');
Route::view('/products/{product}', 'products.show')->name('products.show');

Route::view('/posts', 'posts.index')->name('posts.index');
Route::view('/posts/{post}', 'posts.show')->name('posts.show');

Route::view('/projects', 'projects.index')->name('projects.index');
Route::view('/projects/{post}', 'projects.show')->name('projects.show');

Route::view('/pages/{page}', 'pages.show')->name('pages.show');

Route::view('/faq', 'faqs.index')->name('faq');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
