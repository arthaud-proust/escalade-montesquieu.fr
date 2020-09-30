<?php

use Illuminate\Support\Facades\Route;


Route::get('{page}', function () {
    return abort(404);
});