<?php

namespace App\Http\Controllers;

use App\Models\AccountableModel;
use App\Models\BawahanModel;
use App\Models\InformableModel;
use App\Models\ResponsibleModel;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\User;
use App\Services\AllServices;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getHalamanRoleManagement() {


        $data = [
            'active_sidebar' => [7, 0],
            'roles' => RoleModel::all(),
            'tipe_dokumen' => TipeLaporan::all()
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
        $laporan = null;

        if ($request->wajib_melaporkan !== null) {
            $laporan = implode(";", $request->wajib_melaporkan);
        }
        try {
            $newRole = RoleModel::create([
                'role' => $request->nama_role,
                'atasan_id' => $request->atasan_role,
                'status' => true,
                'is_admin' => $request->is_admin,
                'required_to_submit_document' => $laporan
            ]);

            $arrayResponsibleTo = AllServices::getResponsibleTo($request->atasan_role);

            if (count($arrayResponsibleTo) > 0) {
                foreach ($arrayResponsibleTo as $e) {
                    ResponsibleModel::create([
                        'role' => $newRole->id,
                        'responsible_to' => $e
                    ]);
                }
            }

            if ($request->informable_to !== null) {
                foreach ($request->informable_to as $e) {
                    InformableModel::create([
                        'role' => $newRole->id,
                        'informable_to' => $e
                    ]);
                }
            }

            if ($request->accountable_to !== null) {
                foreach ($request->accountable_to as $e) {
                    AccountableModel::create([
                        'role' => $newRole->id,
                        'accountable_to' => $e
                    ]);
                }
            }

            if ($request->atasan_role != null) {
                BawahanModel::create([
                    'role' => $request->atasan_role,
                    'bawahan' => $newRole->id
                ]);
            }
            return back()->with('toastData', ['success' => true, 'text' => 'Role ' . $request->nama_role . ' berhasil ditambahkan!']);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->nama_role . ' gagal untuk ditambahkan! Role sudah pernah ditambahkan sebelumnya.']);
            }

            return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->nama_role . ' gagal untuk ditambahkan!']);
        }
    }

    public function updateStatus (Request $request) {
        $role = RoleModel::find($request->id);
        $users = User::all();

        foreach ($users as $user) {
            if (AllServices::isUserRole($user, $request->id)) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada user active dengan role tersebut!']);
            }
        }

        if (count(BawahanModel::where('role', $request->id)->get()) !== 0) {
            if (!AllServices::isAdaBawahanActive($request->id)) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada role aktif yang menjadi anggota dari role ini!']);
            }
        }

        if ($role->atasan_id !== null) {
            if (!RoleModel::find($role->atasan_id)->status) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan role atasan aktif!']);
            }
        }

        foreach (AccountableModel::where('accountable_to', $request->id)->get() as $e) {
            if (RoleModel::find($e->role)->status) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada role yang accountable to role ini!']);
            }
        }

        foreach (InformableModel::where('informable_to', $request->id)->get() as $e) {
            if (RoleModel::find($e->role)->status) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada role yang informable to role ini!']);
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

        if ($request->informable_to !== null) {
            AllServices::clearInformableTo($role->id);

            foreach ($request->informable_to as $e) {
                if ($e != -1) {
                    InformableModel::create([
                        'role' => $role->id,
                        'informable_to' => $e
                    ]);
                }
            }
        }

        if ($request->accountable_to !== null) {
            AllServices::clearAccountableTo($role->id);

            foreach ($request->accountable_to as $e) {
                if ($e != -1) {
                    AccountableModel::create([
                        'role' => $role->id,
                        'accountable_to' => $e
                    ]);
                }
            }
        }

        if ($request->wajib_melaporkan !== null) {
            $laporan = implode(";", $request->wajib_melaporkan);

            $role->update([
                'required_to_submit_document' => $laporan
            ]);
        }

        if ($request->atasan_role != null) {

            BawahanModel::where("bawahan", $request->id)->first()->delete();

            BawahanModel::create([
                'role' => $request->atasan_role,
                'bawahan' => $request->id
            ]);
        }

        if ($role->atasan_id !== $request->atasan_role) {
            AllServices::clearResponsibleTo($request->id);

            $arrayResponsibleTo = AllServices::getResponsibleTo($request->atasan_role);

            if (count($arrayResponsibleTo) > 0) {
                foreach ($arrayResponsibleTo as $e) {
                    ResponsibleModel::create([
                        'role' => $request->id,
                        'responsible_to' => $e
                    ]);
                }
            }
        }

        $role->update([
            'role' => $request->nama_role,
            'atasan_id'=>$request->atasan_role,
            'is_admin' => $request->is_admin,
        ]);

        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil memperbarui role!']);
    }
}
