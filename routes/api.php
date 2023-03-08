<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* AUTH */
Route::namespace('App\Http\Controllers\Auth')->group(function() {
    Route::prefix('auth')->name('auth.')->group(function() {
        Route::post('token', 'AuthController@token');
        Route::post('password/changed', 'NewPasswordController')->middleware('auth:api');;
        Route::get('logout', 'AuthController@logout')->middleware('auth:api');
    });
});

/* USERS */
Route::namespace('App\Http\Controllers\User')->group(function() {
    Route::prefix('users')->name('users.')->group(function() {
        Route::post('preference/{user}', 'UserController@updatePreference');
        Route::post('/', 'UserController@getData')->name('getData');
    });
});

Route::namespace('App\Http\Controllers\Datatable')->group(function() {
    Route::prefix('datatables')->name('datatables.')->group(function() {
        Route::post('{type}', 'DatatableController')->name('getUsers');
    });
    Route::apiResource('users', UserController::class);
});

Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
