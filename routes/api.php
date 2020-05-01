<?php

use Illuminate\Support\Facades\Route;

if((bool)env('APP_DEBUG')){
  Route::prefix('debug')->group(static function () {
    Route::get('/render/{contractFormComplete}', 'ContractController@forceRender');
  });
}

Route::prefix('auth')->group(static function () {
  Route::post('/login', 'Auth\LoginController@login');
  Route::post('/register', 'Auth\RegisterController@register');
  Route::post('/authorize', 'Auth\AuthController@authorizeLoggedUser');
  Route::post('/resetPassword/sendToken', 'Auth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/resetPassword', 'Auth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth:token'], static function () {
  Route::prefix('elements')->group(static function () {
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

  Route::prefix('role')->group(static function () {
    Route::get('/', 'RoleController@getCollection');
    Route::get('/permission', 'RoleController@getPermission');
    Route::get('/{id}', 'RoleController@get');

    Route::post('/', 'RoleController@add');

    Route::put('/{id}', 'RoleController@update');

    Route::delete('/{id}', 'RoleController@remove');
  });

  Route::prefix('user')->group(static function () {
    Route::get('/', 'UserController@getCollection');
    Route::get('/{id}', 'UserController@get');

    Route::post('/', 'UserController@add');
    Route::post('/{id}/profileImage', 'UserController@updateImage');

    Route::put('/{id}', 'UserController@update');
    Route::put('/{id}/change-password', 'UserController@changePassword');

    Route::delete('/{id}', 'UserController@remove');
  });

  Route::prefix('statistic')->group(static function () {
    Route::get('/{type}', 'StatisticController@getStatistic');
  });

  Route::prefix('notifications')->group(static function () {
    Route::get('/', 'NotificationController@getUserNotifications');
    Route::get('/unread', 'NotificationController@getUserUnreadNotifications');
    Route::post('/asRead', 'NotificationController@setAsRead');
  });

  Route::prefix('library')->group(static function () {
    Route::prefix('variables')->group(static function () {
      Route::get('/', 'VariableDraftController@get');
      Route::post('/', 'VariableDraftController@add');
      Route::put('/{draft}', 'VariableDraftController@update');
      Route::delete('/{draft}', 'VariableDraftController@delete');
    });
  });
});

Route::prefix('categories')->group(static function () {
  Route::get('/', 'Contract\CategoryController@index');
  Route::get('/{category}', 'Contract\CategoryController@show')
    ->middleware(['middleware' => 'auth:token']);

  Route::post('/', 'Contract\CategoryController@store')
    ->middleware(['middleware' => 'auth:token']);

  Route::put('/{category}', 'Contract\CategoryController@update')
    ->middleware(['middleware' => 'auth:token']);

  Route::delete('/{category}', 'Contract\CategoryController@destroy')
    ->middleware(['middleware' => 'auth:token']);
});

Route::prefix('contract')->group(static function () {
  Route::prefix('modules')->group(static function () {
    Route::get('/', 'Contract\ContractModulesController@getAvailable');
    Route::get('/{contract}', 'Contract\ContractModulesController@getInformationFromContract');
  });

  Route::prefix('form')->group(static function () {
    Route::get('/{contract}', 'Contract\ContractFormController@get');
  });

  Route::get('/submissions', 'ContractController@submissions');
  Route::get('/{contract}', 'ContractController@get')
    ->middleware(['middleware' => 'auth:token']);
  Route::get('/', 'ContractController@getCollection');


  Route::post('/', 'ContractController@add')
    ->middleware(['middleware' => 'auth:token']);
  Route::post('/{contract}/render', 'ContractController@render');
  Route::post('/{contract}/retry', 'ContractController@retry');

  Route::put('/{contract}/status/online', 'ContractController@makeOnline');
  Route::put('/{contract}/status/offline', 'ContractController@makeOffline');

  Route::put('/{contract}', 'ContractController@update')
    ->middleware(['middleware' => 'auth:token']);

  Route::delete('/{contract}', 'ContractController@remove')
    ->middleware(['middleware' => 'auth:token']);
  Route::delete('/', 'ContractController@removeCollection')
    ->middleware(['middleware' => 'auth:token']);
});
