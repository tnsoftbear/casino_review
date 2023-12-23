<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CasinoController as AdminCasinoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CasinoController;

\Illuminate\Support\Facades\URL::forceScheme('https');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article/{slug?}', [ArticleController::class, 'index']);
Route::get('/casino', [CasinoController::class, 'list']);

//Route::redirect('/admin/article', '/admin/article/list', 301);
//Route::get('/admin/article/list', [AdminArticleController::class, 'list']);
Route::resource('/admin/casino', AdminCasinoController::class, ['parameters' => ['casino' => 'id']]);
Route::resource('/admin/article', AdminArticleController::class, ['parameters' => ['article' => 'id']]);

// Route::get('/article/{slug?}', function (string $slug = "") {
//    if (is_numeric($slug)) {
//        return "Article id: $slug";
//    }
//    return "Article slug: $slug"; 
// })->where(['slug' => '[A-Za-z0-9]+']);

Route::fallback(function () {
    abort(404, 'Oops, page not found.');
});