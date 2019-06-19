<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@loginUser');
    Route::post('/register', 'AuthController@registerUser');
    // TODO remove role from there - only client
    // TODO add password validation for register user
    // TODO add test for password validation

    Route::post('/authorize', 'AuthController@authorizeLogedUser');
    // TODO add test
    
    // TODO add reset password endpoint
});