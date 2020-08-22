<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes: Forum
|--------------------------------------------------------------------------
*/


Route::group(['middleware' => ['level-admin']], function()
{
    Route::get('/create', 'ForumController@create')->name('createForum');
    Route::post('/', 'ForumController@store')->name('storeForum');
    Route::get('{forum}/edit', 'ForumController@edit')->name('editForum');
    Route::patch('{forum}', 'ForumController@update')->name('updateForum');
    Route::delete('{forum}', 'ForumController@destroy')->name('destroyForum');
});

Route::get('/', 'ForumController@index')->name('forums');
Route::get('{forum}', 'ForumController@show')->name('showForum');
