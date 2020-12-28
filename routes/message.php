<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes: Message
|--------------------------------------------------------------------------
*/


// Route::group(['middleware' => ['level-user']], function()
// {
// });
// Route::middleware('auth:api')->post('/send', 'MessageController@create')->name('sendMessage');
Route::get('/latests', 'MessageController@latests')->name('latestsMessages');