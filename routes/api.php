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

    Route::prefix('role')->group(function () {
        Route::get('/', 'RoleController@getCollection');
        Route::get('/permission', 'RoleController@getPermission');
        Route::get('/{id}', 'RoleController@get');

        Route::post('/', 'RoleController@add');

        Route::put('/{id}', 'RoleController@update');

        Route::delete('/{id}', 'RoleController@remove');
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
        Route::prefix('modules')->group(function () {
            Route::get('/', 'Contract\ContractModulesController@getAvailable');
            Route::get('/{contract}', 'Contract\ContractModulesController@getInformationFromContract');
        });

        Route::prefix('form')->group(function () {
            Route::get('/{contract}', 'Contract\ContractFormController@get');
        });

        Route::get('/{contract}', 'ContractController@get');
        Route::get('/', 'ContractController@getCollection');

        Route::post('/', 'ContractController@add');
        Route::post('/{contract}/render', 'ContractController@render');

        Route::put('/{contract}', 'ContractController@update');

        Route::delete('/{contract}', 'ContractController@remove');
        Route::delete('/', 'ContractController@removeCollection');
    });
});
