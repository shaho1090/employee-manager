<?php

use App\Http\Controllers\AssignTaskController;
use App\Http\Controllers\TasksController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {

     Route::get('/tasks', [TasksController::class, 'index'])
        ->name('admin.task.index')
        ->middleware('can:viewAny,'.Task::class);

     Route::get('/task/{task}', [TasksController::class, 'show'])
        ->name('admin.task.show')
        ->middleware('can:view,task');

    Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])
        ->name('admin.task.destroy')
        ->middleware('can:delete,task');

    Route::post('/assign-task', [AssignTaskController::class, 'store'])
        ->name('assign-task.store')
        ->middleware('can:create,'.Task::class);

    Route::post('/unassign-task', [AssignTaskController::class, 'destroy'])
        ->name('assign-task.destroy')
        ->middleware('can:create,'.Task::class);

});
