<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@loginUser');
    Route::post('/register', 'AuthController@registerUser');
    Route::post('/authorize', 'AuthController@authorizeLogedUser');
    Route::post('/passwordReset', 'AuthController@resetUserPassword');
});