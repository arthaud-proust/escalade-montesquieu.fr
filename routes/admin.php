<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['level-admin']], function()
{
    Route::get('/', 'AdminController@getPanel')->name('adminPanel');


    Route::get('/infos', 'AdminController@getInfos')->name('adminInfos');
    Route::post('/info', 'AdminController@addInfo')->name('adminAddInfo');
    Route::delete('/info/{id}', 'AdminController@destroyInfo')->name('adminDeleteInfo');
    Route::put('/info/{id}', 'AdminController@modifyInfo')->name('adminModifyInfo');
    
    Route::get('/members', 'AdminController@getMembers')->name('adminMembers');
    Route::post('/member', 'AdminController@addMember')->name('adminAddMember');
    Route::delete('/member/{name}', 'AdminController@destroyMember')->name('adminDeleteMember');
    
    Route::get('/users', 'AdminController@getUsers')->name('adminUsers');
    Route::put('/user/{uuid}', 'AdminController@modifyUser')->name('adminModifyUser');
    Route::delete('/user/{uuid}', 'AdminController@destroyUser')->name('adminDeleteUser');


    Route::get('/route/create', 'RouteController@create')->name('route.create');
    Route::post('/route/create', 'RouteController@store')->name('route.store');
    Route::get('/route/edit/{id}', 'RouteController@edit')->name('route.edit');
    Route::post('/route/edit/{id}', 'RouteController@update')->name('route.update');
    Route::delete('/route/edit/{id}', 'RouteController@delete')->name('route.delete');

});