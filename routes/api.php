<?php

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
        Route::post('password/send-link', 'ResetPasswordController@sendResetLinkEmail');
        Route::middleware('token_reset_password_validate')->post('password/reset', 'ResetPasswordController@resetPassword');
        Route::middleware('auth:api')->group(function () {
            Route::post('update-password', 'NewPasswordController');
            Route::get('logout', 'AuthController@logout');
        });
    });
});

/* USERS */
Route::namespace('App\Http\Controllers\User')->group(function() {
    Route::prefix('users')->name('users.')->group(function() {
        Route::post('preferences', 'UserController@updatePreferences');
        Route::post('/', 'UserController@getData')->name('getData');
    });
    Route::apiResource('users', 'UserController');
});

/* COMPANIES */
Route::middleware('auth:api')->namespace('App\Http\Controllers\Company')->group(function() {
    Route::prefix('companies')->name('companies.')->group(function() {

    });
    Route::apiResource('companies', 'CompanyController')
        ->only(['store']);
});

/* DATATABLES */
Route::middleware('auth:api')->namespace('App\Http\Controllers\Datatable')->group(function() {
    Route::prefix('datatables')->name('datatables.')->group(function() {
        Route::post('{type}', 'DatatableController')->name('getUsers');
    });
});

Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
