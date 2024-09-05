<?php

use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SystemCalendarController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', [ HomeController::class , 'index'])->name('home');
    // Permissions
  
    // Users
    Route::delete('/users/destroy', [ UsersController::class , 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class  );

    // Services
    Route::delete('/services/destroy', [ ServicesController::class , 'massDestroy'])->name('services.massDestroy');
    Route::resource('/services', ServicesController::class  );

   
    // Appointments
    Route::delete('/appointments/destroy', [ AppointmentsController::class , 'massDestroy'])->name('appointments.massDestroy');
    Route::resource('/appointments', AppointmentsController::class );

    Route::get('/system-calendar', [ SystemCalendarController::class , 'index'])->name('systemCalendar');
});

Route::get('/share/{email}/{id}', [ HomeController::class , 'sharEventLink']);
Route::post('/available-slot', [ HomeController::class , 'availableSlot'])->name('available-slot');
Route::post('/submit-schedule', [ HomeController::class , 'submitScheduleDetail'])->name('submit-schedule-detail');
Route::get('/schedule-detail/{Metting}', [ HomeController::class , 'scheduleDetail'])->name('schedule-detail');


