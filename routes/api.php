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
    Route::prefix('attributes')->group(function () {
        Route::get('/', 'ElementsController@getAllAttributesList');
    });
    Route::prefix('conditional')->group(function () {
        Route::get('/', 'ElementsController@getAllConditionalList');
    });
});

Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@getUserList');
    Route::post('/', 'UserController@addNewUser');
    Route::get('/{id}', 'UserController@getUserByID');
    Route::put('/{id}', 'UserController@updateUser');
    Route::delete('/{id}', 'UserController@removeUserAccount');
    Route::put('/{id}/basicData', 'UserController@updateUserBasicData');
    Route::post('/{id}/profileImage', 'UserController@updateUserProfileImage');
});

Route::prefix('contract')->group(function () {
    Route::get('/', 'ContractController@getContractList');
    Route::post('/', 'ContractController@addNewContract');
    Route::get('/{id}/form', 'ContractController@getContractForm');
});
