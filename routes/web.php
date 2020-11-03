<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['before' =>  'auth', 'namespace' => 'Auth'], function(){
    Route::get('secret/login', 'LoginController@showLoginForm')->name('secret.login');
    Route::match(['get', 'post'], 'login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::get('/', 'PageController@index')->name('page.home');
Route::get('/read/{slug}', 'PageController@read')->name('page.read');

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    // Dashboard
    Route::get('/secret/dashboard', 'DashboardController@index')->name('secret.dashboard');

    // Articles
    Route::get('/secret/articles', 'ArticleController@index')->name('secret.articles');
    Route::match(['get','post'], '/secret/add-new-article', 'ArticleController@add')->name('secret.addArticle');
    Route::match(['get', 'post'], '/secret/edit-article/{id}', 'ArticleController@edit')->name('secret.editArticle');
    Route::delete('/secret/delete-article/{id}', 'ArticleController@delete')->name('secret.deleteArticle');
});