<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\User;
use App\Services\AllServices;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Method ini digunakan untuk menambahkan role baru
     */
    public function addRole(Request $request)
    {
        if (!AllServices::isRoleExist($request->role)) {
            RoleModel::create([
                'role' => $request->role
            ]);

            return back()->with('toastData', ['success' => true, 'text' => 'Role ' . $request->role . ' added successfully!']);
        }

        return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->role . ' failed to add. Already exist!']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Method ini digunakan untuk menghapus role.
     * Jika role yang akan dihapus masih ada user yang aktif dengan user tersebut, maka user harus dinonaktifkan terlebih dahulu
     */
    public function removeRole(Request $request)
    {
        $localRole = RoleModel::find($request->id);
        $users = User::all();

        foreach ($users as $e) {
            if (AllServices::isUserRole($e, $request->id)) {

            }
        }


        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus role!']);
    }
}
