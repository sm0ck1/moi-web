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

Route::get('/{page}', [PageController::class, 'show'])->whereIn('page', ['terms', 'privacy', 'contact', 'about'])->name('page.show');

