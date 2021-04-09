<?php

use App\Http\Controllers\TasksController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::post('/task', [TasksController::class, 'store'])
        ->name('task.store')
        ->middleware('can:create,'.Task::class);

});
