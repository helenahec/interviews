<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplicationController;

Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
Route::get('/job-applications/create', [JobApplicationController::class, 'create'])->name('job-applications.create');
Route::post('/job-applications/store', [JobApplicationController::class, 'store'])->name('job-applications.store');
Route::get('/job-applications/{id}/edit', [JobApplicationController::class, 'edit'])->name('job-applications.edit');
Route::delete('/job-applications/{id}', [JobApplicationController::class, 'destroy'])->name('job-applications.destroy');
Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
Route::get('/job-applications/export', [JobApplicationController::class, 'export'])->name('job-applications.export');
Route::put('job-applications/{id}/update', [JobApplicationController::class, 'update'])->name('job-applications.update');
