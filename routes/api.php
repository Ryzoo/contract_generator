<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/authorize', 'Auth\AuthController@authorizeLoggedUser');
    Route::post('/resetPassword/sendToken', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/resetPassword', 'Auth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth:token'], function(){
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
        Route::get('/', 'UserController@getCollection');
        Route::get('/{id}', 'UserController@get');

        Route::post('/', 'UserController@add');
        Route::post('/{id}/profileImage', 'UserController@updateImage');

        Route::put('/{id}', 'UserController@update');

        Route::delete('/{id}', 'UserController@remove');
    });

    Route::prefix('contract')->group(function () {
        Route::get('/', 'ContractController@getContractList');
        Route::get('/modules', 'ContractController@getAvailableModules');
        Route::post('/', 'ContractController@addNewContract');
        Route::get('/{id}/form', 'ContractController@getContractForm');
        Route::post('/{id}/render', 'ContractController@renderContractForm');
        Route::get('/{id}/modules', 'ContractController@getInformationAboutContractModules');
        Route::get('/{id}', 'ContractController@getContract');
        Route::put('/{id}', 'ContractController@updateContract');
        Route::delete('/{id}', 'ContractController@removeContract');
        Route::delete('/', 'ContractController@removeMultiContract');
    });
});
