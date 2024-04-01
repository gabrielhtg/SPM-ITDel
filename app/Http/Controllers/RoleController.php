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
        $informableTo = null;
        $accountableTo = null;

        if ($request->informable_to !== null) {
            $informableTo = implode(';', $request->informable_to);
        }

        if ($request->accountable_to !== null) {
            $accountableTo = implode(';', $request->accountable_to);
        }

        try {
            RoleModel::create([
                'role' => $request->nama_role,
                'atasan_id' => $request->atasan_role,
                'responsible_to' => AllServices::getResponsibleTo($request->atasan_role),
                'informable_to' => $informableTo,
                'status' => true,
                'accountable_to' => $accountableTo
            ]);

            if ($request->atasan_role != null) {
                $atasan = RoleModel::find($request->atasan_role);

                if ($atasan->bawahan == null) {
                    $atasan->update([
                        'bawahan' => RoleModel::whereRole($request->nama_role)->first()->id
                    ]);
                } else {
                    $atasan->update([
                        'bawahan' => $atasan->bawahan . ';' . RoleModel::whereRole($request->nama_role)->first()->id
                    ]);
                }
            }
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

    public function updateStatus (Request $request) {
        $role = RoleModel::find($request->id);
        $users = User::all();

        foreach ($users as $user) {
            if (AllServices::isUserRole($user, $request->id)) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada user active dengan role tersebut!']);
            }
        }

        if ($role->bawahan !== null) {
            if (!AllServices::isAdaBawahanActive($role->bawahan)) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada role aktif yang menjadi anggota dari role ini!']);
            }
        }

        $currentRoleStatus = $role->status;

        $role->update([
            'status' => !$currentRoleStatus
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil mengganti status role!']);
    }

    public function editRole (Request $request){
        $role = RoleModel::find($request->id);

        $informableTo = null;
        $accountableTo = null;

        if ($request->informable_to !== null) {
            $informableTo = implode(';', $request->informable_to);
        }

        if ($request->accountable_to !== null) {
            $accountableTo = implode(';', $request->accountable_to);
        }

        $role->update([
            'role' => $request->nama_role,
            'atasan_id'=>$request->atasan_role,
            'accountable_to'=> $accountableTo,
            'informable_to' => $informableTo
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil memperbarui role!']);
    }
}
