<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * @throws \Exception
     */
    public function store(TaskStoreRequest $request)
    {
        (new Task())->createNew($request->toArray());
    }

}
