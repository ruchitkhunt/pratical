<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
Route::view('/create','employee.create')->name('employee.create');
Route::post('/store',[EmployeeController::class, 'store'])->name('employee.store');
Route::get('/edit/{id}',[EmployeeController::class, 'show'])->name('employee.edit');
Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::get('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');
