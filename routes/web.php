<?php
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
