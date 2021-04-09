<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Role::employee()->first()->users()->get();

        return view('admin.employee.index',[
            'employees' => $employees
        ]);
    }

    public function show(User $employee)
    {
        return view('admin.employee.show',[
            'employee' => $employee,
            'tasks' => $employee->tasks()->get()
        ]);
    }
}
