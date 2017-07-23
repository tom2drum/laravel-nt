<?php

use Illuminate\Support\Facades\Route;

/**************************************
 *
 * Client side routes
 *
 **************************************/



// namespace . controller name . method

//  ARTICLES
Route::get('/article/{slug}', 'ArticleController@showArticle')
    ->name('client.article.show')
    ->where('slug', '[\:0-9A-Za-z\-]+');
Route::post('/article/{slug}', 'ArticleController@processComment')
    ->name('client.article.show')
    ->where('slug', '[\:0-9A-Za-z\-]+');

//  TAGS
Route::name('client.client.listByTag')
    ->get('/tag/{tag}', 'ClientController@listByTag')
    ->where('tag', '[A-Za-z\-]+');


Route::get('/about', 'ClientController@showAbout')
    ->name('client.about.show');



Route::get('/contact', 'ClientController@showContact')
    ->name('client.contact.show');
Route::post('/contact', 'ClientController@sendFeedback');

Route::get('/404', 'ClientController@show404');


//  LOGIN / SIGNUP / LOGOUT

Route::get('/signup', 'AuthController@signup')
    ->name('client.auth.signup');
Route::post('/signup', 'AuthController@signupPost')
    ->name('client.auth.signupPost');

Route::get('/login', 'AuthController@login')
    ->name('client.auth.login');
Route::post('/login', 'AuthController@loginPost')
    ->name('client.auth.loginPost');

Route::get('/logout', 'AuthController@logout')
    ->name('client.auth.logout');

//  SOCIAL MEDIA LOGIN
Route::get('login/facebook', 'AuthController@redirectToProvider')
    ->name('client.auth.facebook');
Route::get('login/facebook/callback', 'AuthController@handleProviderCallback');


//  INDEX
Route::get('/', 'ClientController@index')
    ->name('client.client.index');

