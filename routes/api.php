<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@loginUser');
    Route::post('/register', 'AuthController@registerUser');
    Route::post('/authorize', 'AuthController@authorizeLogedUser');
    Route::post('/resetPassword/sendToken', 'AuthController@sendResetUserPasswordToken');
    Route::post('/resetPassword', 'AuthController@resetUserPassword');
});

Route::prefix('elements')->group(function () {

    Route::prefix('blocks')->group(function () {
        Route::get('/', 'ElementsController@getAllBlockList');

    });

});

Route::prefix('user')->group(function () {
    Route::put('/{id}/basicData', 'UserController@updateUserBasicData');
    Route::post('/{id}/profileImage', 'UserController@updateUserProfileImage');
});