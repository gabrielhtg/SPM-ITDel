<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\RoleModel;
use App\Models\RoleTree;
use App\Models\TreeData;
use App\Models\User;
use Illuminate\Http\Request;

class RoleTreeController extends Controller
{
    public function indexlogindashboard(Request $request)
    {
        $user = User::all();
        $roles = RoleModel::all();
        $child = [];

        // Inisialisasi $roleAtasanPuncak dengan null
        $roleAtasanPuncak = null;

        foreach ($roles as $e) {
            if($e->atasan_id == null && $e->role !== "Admin") {
                $roleAtasanPuncak = $e;
                break;
            }
        }
        

        // Pastikan $roleAtasanPuncak tidak null sebelum digunakan
        if (!empty($roleAtasanPuncak)) {
            try {
                $atasanPuncak = User::where('role', strval($roleAtasanPuncak->id))->firstOrFail();
            } catch (ModelNotFoundException $exception) {
                // Tindakan jika user dengan role yang diharapkan tidak ditemukan
                return view('error-page', ['error' => 'User with specified role not found.']);
            }
            
            $atasanPuncak = User::where('role', strval($roleAtasanPuncak->id))->first();
            
            foreach ($roles as $e) {
                if($atasanPuncak->profile_pict == null) {
                    $RoleTreeData = new TreeData(asset('src/img/default-profile-pict.png'), $atasanPuncak->name, $roleAtasanPuncak-> role);
                } else {
                    $RoleTreeData = new TreeData(asset($atasanPuncak->profile_pict), $atasanPuncak->name, $roleAtasanPuncak -> role);
                }
            }

            foreach (explode(";", $roleAtasanPuncak->bawahan) as $e) {
                if ($e != "") {
                    $userTemp = User::where('role', $e)->get();

                    foreach ($userTemp as $user) {
                        foreach ($roles as $e){
                            if($user->profile_pict == null) {
                                $tempTreeData = new TreeData(asset('src/img/default-profile-pict.png'), $user->name, $e -> role);
                            } else {
                                $tempTreeData = new TreeData(asset($user->profile_pict), $user->name, $e -> role);
                            }
                        }

                        $child[] = new RoleTree($user->id, $tempTreeData, []);
                    }
                }
            }

            $data = [
                'tree' => stripslashes(json_encode(new RoleTree($atasanPuncak->id, $RoleTreeData, $child))),
                'active_sidebar' => [0, 0]
            ];

            return view('login-admin-dashboard', $data);
        } else {
            // Tindakan jika $roleAtasanPuncak masih null, misalnya mengembalikan error atau view khusus
            return view('error-page');
        }
    }
}