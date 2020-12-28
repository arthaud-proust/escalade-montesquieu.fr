<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes: Blog
|--------------------------------------------------------------------------
*/




Route::group(['middleware' => ['level-admin']], function()
{
    Route::get('/create', 'BlogController@create')->name('createBlog');
    Route::post('/', 'BlogController@store')->name('storeBlog');
    Route::get('{blog}/edit', 'BlogController@edit')->name('editBlog');
    Route::patch('{blog}', 'BlogController@update')->name('updateBlog');
    Route::delete('{blog}', 'BlogController@destroy')->name('destroyBlog');
});

Route::get('/', 'BlogController@index')->name('blogs');
Route::get('{blog}', 'BlogController@show')->name('showBlog');

