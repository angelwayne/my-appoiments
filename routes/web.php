<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SpecialtyController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
// Specialty
    Route::get('/specialities','SpecialtyController@index');
    Route::get('/specialities/crate','SpecialtyController@create'); // form registerd
    Route::get('/specialities/{specialty}/edit','SpecialtyController@edit');

    Route::POST('/specialities/storeSpecialty','SpecialtyController@store');// sending form
    Route::put('/specialities/{specialty}','SpecialtyController@update');
    Route::delete('/specialities/{specialty}', 'SpecialtyController@destroy');

    // Doctors
    Route::Resource('doctors','DoctorContorller');

    // Patients
    Route::Resource('patients','PatientController');

    // Charts
    Route::get('/charts/appointsments/line','ChartController@appointmentsLine');
    Route::get('/charts/doctors/column','ChartController@doctorsColum');

    //Api consumo interno ->doctorsColumn.js
    Route::get('/charts/doctors/column/data','ChartController@doctorJson');

});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
    Route::get('/schedule','ScheduleController@edit');
    Route::POST('/schedule','ScheduleController@store');

    });

Route::middleware(['auth'])->group(function () {

    Route::get('/appointments/create','AppointmentController@create');
    Route::POST('/appointments','AppointmentController@store');

    /*
    /appointment -> Verificar
    -> Que variable pasar a la vista
    -> 1  unico blade (Condiciones )
    */
    Route::get('/appointments','AppointmentController@index');
    Route::get('/appointments/{appointment}','AppointmentController@show');

    Route::get('/appointments/{appointment}/cancel','AppointmentController@showCancelForm');
    Route::post('/appointments/{appointment}/cancel','AppointmentController@cancel');

    Route::post('/appointments/{appointment}/confirm','AppointmentController@confirm');




});


