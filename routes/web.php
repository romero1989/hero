<?php

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

Route::get('/home', 'SiteController@index');
Route::get('/site/negado', 'SiteController@negado');
Route::get('/download', 'SiteController@download');
Route::get('/donate', 'SiteController@donate');
Route::get('/screenshots', 'SiteController@screenshots');
Route::get('/forum', 'SiteController@forum');
Route::get('/regras', 'SiteController@regras');

Route::group(['middleware' => ['admin']], function () {


});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/site', 'SiteController@index');
    Route::get('/site/home', 'SiteController@index');
    Route::get('/site/usuario', 'SiteController@index');
    Route::get('/site/admin', 'SiteController@index');
    Route::get('/site/conta', 'SiteController@conta');
    Route::get('/site/guild', 'SiteController@guild');
    Route::get('/site/suporte', 'SiteController@suporte');
    Route::get('/site/suporte/novo', 'SiteController@suporte_novo');
});




//Auth::routes();

//Route::get('/home', 'SiteController@index');
