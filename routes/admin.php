<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\AppointmentController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {
    /**
     * Companies
     */
    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('admin.companies');
        Route::get('/create', [CompanyController::class, 'create'])->name('admin.companiesCreate');
        Route::post('/', [CompanyController::class, 'store'])->name('admin.companiesStore');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('admin.companiesEdit');
        Route::get('/{company}/edit-patients', [CompanyController::class, 'editPatients'])->name('admin.companiesEditPatients');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('admin.companiesUpdate');
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('admin.companiesDestroy');
    });

    /**
     * Patients
     */
    Route::prefix('patients')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('admin.patients');
        Route::get('/create', [PatientController::class, 'create'])->name('admin.patientsCreate');
        Route::post('/', [PatientController::class, 'store'])->name('admin.patientsStore');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('admin.patientsEdit');
        Route::put('/{patient}', [PatientController::class, 'update'])->name('admin.patientsUpdate');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('admin.patientsDestroy');
    });

    /**
     * Appointments
     */
    Route::prefix('appointments')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('admin.appointments');
        Route::get('/create', [AppointmentController::class, 'create'])->name('admin.appointmentsCreate');
        Route::post('/available-start-times', [AppointmentController::class, 'getAvailableStartTimes'])->name('admin.getAvailableStartTimes');
        Route::post('/', [AppointmentController::class, 'store'])->name('admin.appointmentsStore');
        Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('admin.appointmentsEdit');
        Route::put('/{appointment}', [AppointmentController::class, 'update'])->name('admin.appointmentsUpdate');
        Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointmentsDestroy');
    });
});

