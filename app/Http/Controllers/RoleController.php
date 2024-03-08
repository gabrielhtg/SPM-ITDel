<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
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
        RoleModel::create([
            'role' => $request->role
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Role ' . $request->role . ' berhasil ditambahkan!']);
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
        RoleModel::find($request->id)->delete();

        USer

        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus role!']);
    }
}
