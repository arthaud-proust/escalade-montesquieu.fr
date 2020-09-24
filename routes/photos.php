<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Photos Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'photos', 'middleware' => ['level-admin']], function()
{
    Route::post('/gallery', 'GalleryController@store')->name('storeGallery');

    Route::get('/gallery/create', 'GalleryController@create')->name('createGallery');

    Route::patch('/gallery/create/{gallery}', 'GalleryController@update')->name('updateGallery');

    Route::delete('/gallery/create/{gallery}', 'GalleryController@destroy')->name('destroyGallery');

    Route::get('/gallery/create/{gallery}/edit', 'GalleryController@edit')->name('editGallery');



    Route::post('/photo', 'PhotoController@store')->name('storePhoto');

    Route::get('/photo/create', 'PhotoController@create')->name('createPhoto');

    Route::patch('/photo/create/{photo}', 'PhotoController@update')->name('updatePhoto');

    Route::delete('/photo/create/{photo}', 'PhotoController@destroy')->name('destroyPhoto');

    Route::get('/photo/create/{photo}/edit', 'PhotoController@edit')->name('editPhoto');
});

Route::group(['prefix' => 'photos', 'middleware' => ['level-user']], function()
{
    Route::get('/', 'GalleryController@index')->name('galleries');

    Route::get('/photo/{photo}', 'PhotoController@show')->name('showPhoto');

    Route::get('/{slug}', 'GalleryController@show')->name('showGallery');
});




