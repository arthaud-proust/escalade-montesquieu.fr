<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix'=>'subscription'], function()
{
    Route::post('/all', 'SubscriptionController@all')->name('getAllSubscriptions');
    Route::post('/', 'SubscriptionController@add')->name('addSubscription');
    Route::delete('/', 'SubscriptionController@delete')->name('deleteSubscription');
});


Route::middleware('auth:api')->get('/user', function(Request $request) {    
    return $request->user();
});

Route::middleware('auth:api')->post('/sendmessage', 'MessageController@create')->name('sendMessage');
