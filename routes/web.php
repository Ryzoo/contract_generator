<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', 'CommonController@defaultView')->where('any', '^(?!api|storage|docs|lang).*$|');

/**
 * This route exist there only for get route to password on frontend by name
 */
Route::get('/auth/resetPassword', 'CommonController@emptyFunction')->name('password.reset');
Route::get('/lang/{locale}', 'CommonController@changeLanguage');