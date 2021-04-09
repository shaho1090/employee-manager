<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeTasksController extends Controller
{
    public function index()
    {
        return view('employee.task.index',[
            'tasks' => auth()->user()->tasks()->get()
        ]);
    }

    public function update(Task $task): RedirectResponse
    {
        $task->update([
            'status_id' => TaskStatus::done()->id
        ]);

        $task->refresh();

        return redirect()->back();
    }
}
