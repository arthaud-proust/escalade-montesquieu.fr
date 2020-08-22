<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes : Post
|--------------------------------------------------------------------------
*/



Route::group(['middleware' => ['level-user']], function()
{
        
    Route::post('{post}/participate', 'PostController@available');
    Route::delete('{post}/participate', 'PostController@unavailable');
    
});

Route::group(['middleware' => ['level-modo']], function()
{
    Route::get('/create', 'PostController@create')->name('createPost');
    Route::post('/', 'PostController@store')->name('storePost');
    Route::get('{post}/edit', 'PostController@edit')->name('editPost');
    Route::patch('{post}', 'PostController@update')->name('updatePost');
    Route::delete('{post}', 'PostController@destroy')->name('destroyPost');
});