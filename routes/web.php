<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
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


Route::resource('articles', 'ArticleController');

Route::resource('events', 'EventController');

Route::resource('courses', 'CourseController');


Route::get('/search/{type?}', 'PageController@search')->name('search');

Route::get('ad/{advertisement_banner}', 'AdvertisementController')->name('ad');

Route::get('/companies', 'PageController@companies')->name('companies');

Route::get('/companies/{slug}', 'PageController@company')->name('company');

Route::get('/login', 'AdminController@login')->name('login');
