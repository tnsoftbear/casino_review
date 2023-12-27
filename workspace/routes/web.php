<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CasinoController as AdminCasinoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CasinoController;
use App\Http\Middleware\CheckAdminPrivilege;

\Illuminate\Support\Facades\URL::forceScheme('https');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article/{slug?}', [ArticleController::class, 'index']);
Route::get('/casino', [CasinoController::class, 'list']);

Route::group(['middleware' => CheckAdminPrivilege::class], function () {
    Route::resource('/admin/casino', AdminCasinoController::class, ['parameters' => ['casino' => 'id']]);
    Route::resource('/admin/article', AdminArticleController::class);
    Route::resource('/admin/user', \App\Http\Controllers\Admin\UserController::class);
});

Route::fallback(function () {
    abort(404, 'Oops, page not found.');
});