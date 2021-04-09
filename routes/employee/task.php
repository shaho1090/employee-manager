<?php

use App\Http\Controllers\EmployeeTasksController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {

    Route::get('/employee/tasks', [EmployeeTasksController::class, 'index'])
        ->name('employee.task.index');

    Route::patch('/employee/task/{task}', [EmployeeTasksController::class, 'update'])
        ->name('employee.task.update')
        ->middleware('can:update,task');
});
