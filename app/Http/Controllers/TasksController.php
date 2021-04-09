<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::all();

        return view('admin.task.index',[
            'tasks' => $tasks
        ]);
    }

    public function show(Task $task)
    {
        return view('admin.task.show',[
            'task' => $task,
        ]);
    }

    public function create()
    {
        return view('admin.task.create');
    }

    /**
     * @throws \Exception
     */
    public function store(TaskStoreRequest $request): RedirectResponse
    {
        (new Task())->createNew($request->toArray());

        Session::flash('success', "Success!");
        return Redirect::back();
    }

    /**
     * @throws \Exception
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return Redirect::back();
    }

}
