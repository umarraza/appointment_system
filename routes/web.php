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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/clear', function () {
//     Artisan::call('cache:clear');
//     Artisan::call('config:clear');
//     Artisan::call('config:cache');
//     Artisan::call('view:clear');
//     Artisan::call('route:clear');
//     return "Cleared!";
// });

Auth::routes();
Route::get('doctor/appointments', 'DoctorController@appointments')->name('doctor.appointments');
Route::get('doctor/b/appointments', 'DoctorController@bookedappointments')->name('doctor.appointments.booked');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('doctor/dashboard', 'HomeController@doctorDashboard')->name('doctor.dashboard');
Route::get('patient/dashboard', 'HomeController@patientDashboard')->name('patient.dashboard');

Route::get('time_slots/create', 'TimeSlotController@create')->name('time_slots.create');
Route::post('time_slots', 'TimeSlotController@store')->name('time_slots.store');
Route::get('time_slots', 'TimeSlotController@index')->name('time_slots.index');
Route::post('search', 'DoctorController@search')->name('doctors.search');
Route::get('doctor/{user}', 'DoctorController@show')->name('doctor.show');
Route::post('book/slot', 'DoctorController@bookSlot')->name('doctor.slot.book');


Route::post('booking/slot/accept', 'DoctorController@acceptBooking')->name('doctor.slot.booking.confirm');
Route::post('booking/slot/reject', 'DoctorController@rejectBooking')->name('doctor.slot.booking.reject');