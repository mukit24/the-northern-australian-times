<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $articles = Article::with('user')->latest()->take(5)->get();
    return view('layouts.home', ['articles' => $articles]);
});

Route::get('/register', function () {
    return view('layouts.register');
});
Route::get('/login', function () {
    return view('layouts.login');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/articles', [ArticleController::class, 'articleList'])->name('articleList');
Route::get('/articles/{id}', [ArticleController::class, 'articleDetails'])->name('articleDetails');
Route::get('/create-article-page', [ArticleController::class, 'displayCreateArticle']);
Route::post('/create-article', [ArticleController::class, 'createArticle']);
Route::get('/edit-article/{id}', [ArticleController::class, 'displayEdit'])->name('displayEdit');
Route::put('/edit-article/{id}', [ArticleController::class, 'editArticle']);
Route::delete('/delete-article/{id}', [ArticleController::class, 'deleteArticle'])->name('deleteArticle');

Route::post('/create-comment/{id}', [ArticleController::class, 'createComment'])->name('createComment');
Route::delete('/delete-comment/{article_id}/{comment_id}', [ArticleController::class, 'deleteComment'])->name('deleteComment');