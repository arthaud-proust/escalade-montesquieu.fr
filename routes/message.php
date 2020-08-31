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
    Route::get('/sendtest', 'MessageController@test')->name('sendTestMessage');
    Route::get('/showtest/{last_message_id}', 'MessageController@testShowMessages')->name('showTestMessage');
});