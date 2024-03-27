<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\User;
use App\Services\AllServices;
use Couchbase\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getHalamanRoleManagement() {


        $data = [
            'active_sidebar' => [6, 0],
            'roles' => RoleModel::all()
        ];

        return view('role-management', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Method ini digunakan untuk menambahkan role baru
     */
    public function addRole(Request $request)
    {
        try {
            RoleModel::create([
                'role' => $request->nama_role,
                'atasan_id' => $request->atasan_role,
                'responsible_to' => AllServices::getResponsibleTo($request->atasan_role),
                'informable_to' => implode(';', $request->informable_to),
                'accountable_to' => implode(';', $request->accountable_to)
            ]);

            return back()->with('toastData', ['success' => true, 'text' => 'Role ' . $request->nama_role . ' added successfully!']);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->nama_role . ' gagal untuk ditambahkan! Role sudah pernah ditambahkan sebelumnya.']);
            }

            return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->nama_role . ' gagal untuk ditambahkan!']);
        }
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
        $newRole = "";

        foreach ($users as $e) {
            if (AllServices::isUserRole($e, $request->id)) {
                $roles = explode(";", $e->role);
                foreach ($roles as $role) {
                    if ($role == $request->id) {
                        continue;
                    }

                    else {
                        $newRole = $newRole . $role . ';';
                    }
                }

                $e->update([
                    'role' => substr($newRole, 0, -1)
                ]);

                $newRole = '';
            }
        }

        $localRole->delete();
        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus role!']);
    }
}
