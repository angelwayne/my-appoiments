<?php

use Illuminate\Http\Request;

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
 // Login
Route::POST('/login','AuthController@login');

// Public resources ->JSON
Route::get('/specialties','SpecialtyContorller@index');
Route::get('/specialties/{specialty}/doctors','SpecialtyContorller@doctors');
Route::get('/schedule/hours','ScheduleController@hours');

// Protected routes
Route::middleware('auth:api')->group(function () {

    Route::GET('/user', 'UserController@show');
    Route::POST('/logout','AuthController@logout');

});

