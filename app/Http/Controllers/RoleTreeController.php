<?php

namespace App\Http\Controllers;

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

        foreach ($roles as $e) {
            if($e->atasan_id == null && $e->role !== "Admin") {
                $roleAtasanPuncak = $e;
                break;
            }
        }

        if (!empty($roleAtasanPuncak)) {
            $atasanPuncak = User::where('role', strval($roleAtasanPuncak->id))->first();

        }

        if($atasanPuncak->profile_pict == null) {
            $RoleTreeData = new TreeData(asset('src/img/default-profile-pict.png'), $atasanPuncak->name);
        } else {
            $RoleTreeData = new TreeData(asset($atasanPuncak->profile_pict), $atasanPuncak->name);
        }

        foreach (explode(";", $roleAtasanPuncak->bawahan) as $e) {
            if ($e != "") {
                $userTemp = User::where('role', $e)->get();

                foreach ($userTemp as $user) {
                    if($user->profile_pict == null) {
                        $tempTreeData = new TreeData(asset('src/img/default-profile-pict.png'), $user->name);
                    } else {
                        $tempTreeData = new TreeData(asset($user->profile_pict), $user->name);
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
    }

}
