<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AssignTaskController extends Controller
{
    /**
     * @param AssignTaskRequest $request
     * @return RedirectResponse
     */
    public function store(AssignTaskRequest $request): RedirectResponse
    {
        Task::find($request->get('task_id'))->assignTo(
            User::find($request->get('employee_id'))
        );

        return redirect()->back();
    }

    public function destroy(AssignTaskRequest $request): RedirectResponse
    {
        Task::find($request->get('task_id'))->unassignFrom(
            User::find($request->get('employee_id'))
        );

        return redirect()->back();
    }
}
