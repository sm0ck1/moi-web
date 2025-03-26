<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/{slug}/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/sitemap.xml', [SitemapController::class, 'generate']);
Route::get('/robots.txt', [SitemapController::class, 'robots']);
Route::get('/get-all-posts', [PostController::class, 'getAllPosts']);
//
//Route::get('/terms', [PageController::class, 'show'])->name('terms');
//Route::get('/privacy', [PageController::class, 'show'])->name('privacy');
//Route::get('/contact', [PageController::class, 'show'])->name('contact');
//Route::get('/about', [PageController::class, 'show'])->name('about');
Route::get('/{page}', [PageController::class, 'show'])->whereIn('page', ['terms', 'privacy', 'contact', 'about'])->name('page.show');

