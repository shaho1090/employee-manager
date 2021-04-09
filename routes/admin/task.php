<?php

use App\Http\Controllers\TasksController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {

    Route::get('/create-task', [TasksController::class, 'create'])
        ->name('admin.task.create')
        ->middleware('can:create,'.Task::class);

    Route::post('/task', [TasksController::class, 'store'])
        ->name('admin.task.store')
        ->middleware('can:create,'.Task::class);

     Route::get('/tasks', [TasksController::class, 'index'])
        ->name('admin.task.index')
        ->middleware('can:viewAny,'.Task::class);

     Route::get('/task/{task}', [TasksController::class, 'show'])
        ->name('admin.task.show')
        ->middleware('can:view,task');

    Route::get('/tasks/{task}', [TasksController::class, 'destroy'])
        ->name('admin.task.destroy')
        ->middleware('can:delete,task');

});
