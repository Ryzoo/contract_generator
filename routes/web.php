<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function () {
    return view('default');
})->where('any', '^(?!api|storage|docs|telescope).*$|');

/**
 * This route exist there only for get route to password on frontend by name
 */
Route::get('/auth/resetPassword',function(){})->name('password.reset');
