<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin as Admin;
// use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
// use App\Http\Controllers\Admin\CasinoController as AdminCasinoController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\CasinoController;
use App\Http\Middleware\CheckAuth;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

\Illuminate\Support\Facades\URL::forceScheme('https');

Route::get('/', [ArticleController::class, 'feed'])->name('/');
Route::get('/article/feed', [ArticleController::class, 'feed'])->name('public.article.feed');
Route::get('/article/{slug?}', [ArticleController::class, 'index'])->name('public.article.show');

Route::get('/casino', [CasinoController::class, 'list']);

Route::get('/admin', [AdminAuthController::class, 'index']);
Route::get('/admin/auth', [AdminAuthController::class, 'index']);
Route::get('/admin/auth/login', [AdminAuthController::class, 'index']);
Route::get('/admin/auth/index', [AdminAuthController::class, 'index'])->name('admin.auth.index');
Route::post('/admin/auth/login', [AdminAuthController::class, 'login'])->name('admin.auth.login');
Route::get('/admin/auth/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');

Route::group(['middleware' => CheckAuth::class/*, 'prefix' => 'admin' , 'namespace' => 'Admin' */], function () {
    Route::resource('/admin/casino', \App\Http\Controllers\Admin\CasinoController::class, ['parameters' => ['casino' => 'id']]);
    Route::resource('/admin/user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('/admin/article', \App\Http\Controllers\Admin\ArticleController::class);
});

Route::fallback(function () {
    abort(404, 'Oops, page not found.');
});
