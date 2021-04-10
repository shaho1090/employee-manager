<?php

use App\Http\Controllers\AssignTaskController;
use App\Http\Controllers\TasksController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {

    Route::get('/create-task', [TasksController::class, 'create'])
        ->name('task.create');
//        ->middleware('can:create,'.Task::class);

    Route::post('/task', [TasksController::class, 'store'])
        ->name('task.store');
//        ->middleware('can:create,'.Task::class);
});
