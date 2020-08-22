<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes: Message
|--------------------------------------------------------------------------
*/


Route::group(['middleware' => ['level-user']], function()
{
    Route::post('/send', 'MessageController@create')->name('sendMessage');
});