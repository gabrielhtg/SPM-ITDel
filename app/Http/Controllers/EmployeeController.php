<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RoleModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    public function addEmployee (Request $request): RedirectResponse
    {

        Employee::create([
            'name' => $request->name,
            'role' => $request->role
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Employee ' . $request->nama_role . ' berhasil ditambahkan!']);
    }

    public function removeEmployee (Request $request): RedirectResponse
    {
        Employee::find($request->id)->delete();

        return back()->with('toastData', ['success' => true, 'text' => 'Employee ' . $request->nama_role . ' berhasil dihapus!']);
    }

    public function editEmployee (Request $request): RedirectResponse
    {
        Employee::find($request->id)->update([
            'name' => $request->name,
            'role' => $request->role
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Employee ' . $request->nama_role . ' berhasil diubah datanya!']);

    }
}
