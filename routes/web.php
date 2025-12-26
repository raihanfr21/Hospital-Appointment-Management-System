<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');


// Rute untuk janji temu
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');


use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

Route::get('register/doctor', [DoctorController::class, 'showRegisterForm'])->name('register.doctor.form');
Route::post('register/doctor', [DoctorController::class, 'register'])->name('register.doctor');
Route::get('dashboard/doctor', [DoctorController::class, 'dashboard'])->name('dashboard.doctor');
Route::get('logout', [DoctorController::class, 'logout'])->name('logout');

Route::get('register/patient', [PatientController::class, 'showRegisterForm'])->name('register.patient.form');
Route::post('register/patient', [PatientController::class, 'register'])->name('register.patient');
Route::get('dashboard/patient', [PatientController::class, 'dashboard'])->name('dashboard.patient');
Route::get('logout', [PatientController::class, 'logout'])->name('logout');