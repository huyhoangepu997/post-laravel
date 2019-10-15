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

//use Illuminate\Routing\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/categories', 'CategoriesController');

Route::resource('/posts', 'PostsController');

Route::get('/trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
Route::put('/restore-posts/{post}', 'PostsController@restore')->name('restore-posts');




Route::resource('/units', 'UnitsController');

Route::resource('/units-type', 'UnitsTypeController');

Route::resource('/units-conversion', 'UnitsConversionController');

Route::post('ajaxCreate', 'UnitsConversionController@ajaxCreate')->name('ajaxCreate');

Route::post('ajaxEdit', 'UnitsConversionController@ajaxEdit')->name('ajaxEdit');

//Route::get('/{id}', 'UnitsConversionController@unitConversionAjax')->name('units-conversion.ajax');

//Route::post('/unitConversionAjax', 'UnitsConversionController@unitConversionAjax')->name('ajax.from_code');
