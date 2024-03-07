<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function addRole (Request $request) {
        RoleModel::create([
            'role' => $request->role
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Role ' . $request->role . ' berhasil ditambahkan!']);
    }

    public function removeRole (Request $request) {
        RoleModel::find($request->id)->delete();

        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus role!']);
    }
}
