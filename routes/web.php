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

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin') //cartella controller
    ->prefix('admin') //prefisso uri
    ->name('admin.') //name rotte
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/categories', 'CategoryController@index')->name('categories.index');
        Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
        Route::get('/myposts', 'PostController@indexUser')->name('posts.indexUser');
        Route::resource('posts', 'PostController');
    });

Route::get('{any?}', function ($name = null) {
    return view('guest.home');
})->where('any', '.*');
