<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\RoleModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployeePage (): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = [
            'employees' => Employee::all(),
            'roles' => RoleModel::all(),
            'active_sidebar' => [4, 3]
        ];

        return view('employee', $data);
    }
}
