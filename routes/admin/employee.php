<?php

use App\Http\Controllers\EmployeesController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {

     Route::get('/employees', [EmployeesController::class, 'index'])
        ->name('admin.employee.index')
        ->middleware('can:view-employees,'.User::class);

     Route::get('/employee/{employee}', [EmployeesController::class, 'show'])
        ->name('admin.employee.show')
        ->middleware('can:view-employees,'.User::class);
});
