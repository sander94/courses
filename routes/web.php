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


Route::resource('articles', 'ArticleController');

Route::resource('events', 'EventController');

Route::resource('courses', 'CourseController');

Route::post('contact', 'ContactController')->name('contact');

Route::get('/', 'PageController@home')->name('home');

Route::get('/contact', 'PageController@contact')->name('contact');

Route::get('/search/{type?}', 'PageController@search')->name('search');

Route::get('ad/{advertisement_banner}', 'AdvertisementController')->name('ad');

Route::get('/companies', 'PageController@companies')->name('companies');

Route::get('/rooms', 'PageController@rooms')->name('rooms');

Route::get('/companies/{company}', 'PageController@company')->name('company');

Route::prefix('company')->group(function () {


    Route::get('login', 'CompanyController@login')->middleware('guest')->name('login');
    Route::post('login', 'CompanyController@authenticate')->middleware('guest')->name('authenticate');

    Route::middleware('auth:company')->group(function () {
        Route::get('profile', 'CompanyController@profile')->name('profile');
        Route::post('profile', 'CompanyController@update')->name('company.update');
        Route::get('statistics', 'CompanyController@statistics')->name('statistics');
        Route::get('courses', 'CompanyController@mycourses')->name('mycourses');
        Route::get('description', 'CompanyController@description')->name('description');

        Route::get('logout', 'CompanyController@logout')->name('logout');
    });

});
