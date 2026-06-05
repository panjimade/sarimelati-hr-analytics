<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['division', 'position'])
            ->orderBy('employee_code')
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }
}