<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'tips', 'middleware' => ['level-user']], function()
{
    Route::view('/modify-profil', 'tips.modify-profil')->name('tipsModifyProfil');
});



// Route::get('{page}', function () {
//     return abort(404);
// });