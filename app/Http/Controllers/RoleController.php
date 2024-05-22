<?php

namespace App\Http\Controllers;

use App\Models\AccountableModel;
use App\Models\BawahanModel;
use App\Models\InformableModel;
use App\Models\JenisLaporan;
use App\Models\ResponsibleModel;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\User;
use App\Services\AllServices;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\LogLaporan;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function getHalamanRoleManagement()
    {
        $data = [
            'active_sidebar' => [8, 0],
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
    public function addRole(Request $request): \Illuminate\Http\RedirectResponse
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

            $arrayAccountableTo = AllServices::getAccountableTo($request->atasan_role);

            if (count($arrayAccountableTo) > 0) {
                foreach ($arrayAccountableTo as $e) {
                    AccountableModel::create([
                        'role' => $newRole->id,
                        'accountable_to' => $e
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

            if ($request->responsible_to !== null) {
                foreach ($request->responsible_to as $e) {
                    ResponsibleModel::create([
                        'role' => $newRole->id,
                        'responsible_to' => $e
                    ]);
                }
            }

            if ($request->atasan_role != null) {
                BawahanModel::create([
                    'role' => $request->atasan_role,
                    'bawahan' => $newRole->id
                ]);
            }

            AllServices::addLog(sprintf("Menambahkan role %s", $request->nama_role));
            return back()->with('toastData', ['success' => true, 'text' => 'Role ' . $request->nama_role . ' berhasil ditambahkan!']);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->nama_role . ' gagal untuk ditambahkan! Role sudah pernah ditambahkan sebelumnya.']);
            }

            return back()->with('toastData', ['success' => false, 'text' => 'Role ' . $request->nama_role . ' gagal untuk ditambahkan!']);
        }
    }

    public function updateStatus(Request $request)
    {
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

        foreach (ResponsibleModel::where('responsible_to', $request->id)->get() as $e) {
            if (RoleModel::find($e->role)->status) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada role yang responsible to role ini!']);
            }
        }

        foreach (InformableModel::where('informable_to', $request->id)->get() as $e) {
            if (RoleModel::find($e->role)->status) {
                return back()->with('toastData', ['success' => false, 'text' => 'Gagal menggati status role. Pastikan tidak ada role yang inform to role ini!']);
            }
        }

        $currentRoleStatus = $role->status;

        $role->update([
            'status' => !$currentRoleStatus
        ]);

        AllServices::addLog(sprintf("%s status role %s", $role->status ? 'Mengaktifkan' : 'Menonaktifkan', $role->role));
        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil mengganti status role!']);
    }

    public function editRole(Request $request)
    {
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

        if ($request->responsible_to !== null) {
            AllServices::clearResponsibleTo($role->id);

            foreach ($request->responsible_to as $e) {
                if ($e != -1) {
                    ResponsibleModel::create([
                        'role' => $role->id,
                        'responsible_to' => $e
                    ]);
                }
            }
        }

        if ($request->wajib_melaporkan !== null) {
            $laporan = implode(";", $request->wajib_melaporkan);
    
            $role->update([
                'required_to_submit_document' => $laporan
            ]);
    
            $roleId = $role->id;
            $users = User::where(DB::raw("CONCAT(';', role, ';')"), 'LIKE', "%;$roleId;%")
                ->pluck('id')
                ->toArray();
    
            // Memisahkan laporan menjadi array untuk digunakan dalam query
            $laporanArray = explode(";", $laporan);
    
            $jenis_laporans = JenisLaporan::whereIn('id_tipelaporan', $laporanArray)->get();
    
            foreach ($users as $userId) {
                foreach ($jenis_laporans as $jenis_laporan) {
                    $log = LogLaporan::where('upload_by', $userId)
                        ->where('id_jenis_laporan', $jenis_laporan->id)
                        ->first();
    
                    // Membuat log jika belum ada
                    if ($log === null) {
                        LogLaporan::create([
                            'id_jenis_laporan' => $jenis_laporan->id,
                            'id_tipe_laporan' => $jenis_laporan->id_tipelaporan,
                            'upload_by' => $userId,
                            'created_at' => now(), 
                            'approve_at' => null,
                            'end_date' => $jenis_laporan->end_date,
                        ]);
                    }
                }
            }
        }

        if ($request->atasan_role != null) {


            $temp = BawahanModel::where("bawahan", $request->id)->first();

            if ($temp !== null) {
                $temp->delete();
            }

            BawahanModel::create([
                'role' => $request->atasan_role,
                'bawahan' => $request->id
            ]);
        }

        if ($role->atasan_id !== $request->atasan_role) {
            AllServices::clearAccountableTo($request->id);

            $arrayAccountableTo = AllServices::getAccountableTo($request->atasan_role);

            if (count($arrayAccountableTo) > 0) {
                foreach ($arrayAccountableTo as $e) {
                    AccountableModel::create([
                        'role' => $request->id,
                        'accountable_to' => $e
                    ]);
                }
            }
        }

        $role->update([
            'role' => $request->nama_role,
            'atasan_id' => $request->atasan_role,
            'is_admin' => $request->is_admin,
        ]);

        AllServices::addLog(sprintf("Mengedit role %s", $role->role));
        return back()->with('toastData', ['success' => true, 'text' => 'Berhasil memperbarui role!']);
    }
}
