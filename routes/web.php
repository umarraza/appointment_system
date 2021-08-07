<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@welcome');

Auth::routes();

Route::group(['middleware' => ['auth', 'web']], function () {

    Route::get('/profile/{user}', 'ProfileController@index')->name('user.profile');
    Route::get('/profile/{user}/edit/', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile/{user}/update/', 'ProfileController@update')->name('profile.update');

    Route::get('doctor/appointments', 'DoctorController@appointments')->name('doctor.appointments');
    Route::get('doctor/b/appointments', 'DoctorController@bookedAppointments')->name('doctor.appointments.booked');
    Route::get('doctor/c/appointments', 'DoctorController@canceledAppointments')->name('doctor.appointments.cenceled');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('doctor/dashboard', 'HomeController@doctorDashboard')->name('doctor.dashboard');
    Route::get('patient/dashboard', 'HomeController@patientDashboard')->name('patient.dashboard');

    Route::get('time_slots/create', 'TimeSlotController@create')->name('time_slots.create');
    Route::post('time_slots', 'TimeSlotController@store')->name('time_slots.store');
    Route::get('time_slots', 'TimeSlotController@index')->name('time_slots.index');
    Route::post('search', 'DoctorController@search')->name('doctors.search');
    Route::get('doctor/{profile}', 'DoctorController@show')->name('doctor.show');
    Route::post('book/slot', 'DoctorController@bookSlot')->name('doctor.slot.book');
    Route::get('patients', 'DoctorController@patientsList')->name('doctor.patients');

    Route::get('patient/history', 'PatientController@history')->name('patient.visit_history');

    Route::post('booking/slot/accept', 'DoctorController@acceptBooking')->name('doctor.slot.booking.confirm');
    Route::post('booking/slot/reject', 'DoctorController@rejectBooking')->name('doctor.slot.booking.reject');

    Route::get('patient/summary/{patient}/create', 'PatientSummaryController@create')->name('patient.summary.create');
    Route::get('patient/summary/{booking}/edit', 'PatientSummaryController@edit')->name('patient.summary.edit');
    Route::get('patient/summary', 'PatientSummaryController@index')->name('patient.summary.index');
    Route::get('patient/summary/{booking}', 'PatientSummaryController@show')->name('patient.summary.show');
    Route::post('patient/summary/{patient}', 'PatientSummaryController@store')->name('patient.summary.store');
    Route::post('patient/summary/{booking}/update', 'PatientSummaryController@update')->name('patient.summary.update');
});

