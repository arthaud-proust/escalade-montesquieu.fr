<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'HomeController@index')->name('home');
Route::view('/informations', 'about.informations')->name('informations');
Route::view('/mentions-legales', 'about.mentions')->name('mentionsLegales');
Route::view('/politique-rgpd', 'about.rgpd')->name('politiqueRgpd');
Route::view('/conditions-utilisation', 'about.conditions')->name('conditionsUtilisation');
Route::get('/la-salle', 'RouteController@room')->name('room');


Route::get('/session', 'ProfileController@bySession')->name('session');



Auth::routes();
Route::group(['middleware' => ['level-user']], function()
{
    
    Route::get('profil', 'ProfileController@index')->name('showProfile');
    Route::get('profil/edit', 'ProfileController@edit')->name('editProfile');
    Route::patch('profil', 'ProfileController@update')->name('updateProfile');
    Route::get('profil/change-password', 'ProfileController@changePassword')->name('changePassword');
    Route::post('profil/img', 'ProfileController@changeImg')->name('changeImgProfile');
    Route::post('profil/change-password', 'ProfileController@updatePassword')->name('updatePassword');
    Route::get('profil/{user_uuid}', 'ProfileController@show')->name('userProfile');
    Route::get('profil/{user_uuid}/img', 'ProfileController@img')->name('imgProfile');
    
    
    Route::post('post/{post}/participate', 'PostController@available');
    Route::delete('post/{post}/participate', 'PostController@unavailable');
    
});

