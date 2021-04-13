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


Route::resource('article', ArticleController::class);

Route::resource('event', EventController::class);

Route::resource('course', CourseController::class);


Route::get('/search', 'PageController@search')->name('search');

Route::get('/articles', 'PageController@articles')->name('articles');

Route::get('/courses', 'PageController@courses')->name('courses');
