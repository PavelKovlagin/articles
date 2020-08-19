<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articles', 'ArticleController@showArticles');

Route::get('/articles/addArticle', function(){
    return view('articles.addArticle', [
        'authUser' => App\User::selectAuthUser()
    ]);
});

Route::get('/articles/{article_id}', 'ArticleController@showArticle');

Route::post('/addArticle', 'ArticleController@insertArticle');

Route::post('/updateArticle', 'ArticleController@updateArticle');
