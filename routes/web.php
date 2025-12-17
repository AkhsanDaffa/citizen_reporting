<?php

use App\Http\Controllers\ReportController;

Route::get('/', [ReportController::class, 'index']);
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
Route::patch('/reports/{id}', [ReportController::class, 'updateStatus'])->name('reports.update');