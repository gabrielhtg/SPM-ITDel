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
        $tree = new RoleTree(null, null, null);

        // Bagian ini untuk mendapatkan user puncak
        foreach (RoleModel::all() as $e) {
            if ($e->atasan_id == null && $e->role !== "Admin") {
                $rolePuncak = $e;
                break;
            }
        }

        if (!empty($rolePuncak)) {
            $this->bentukTree($tree, $rolePuncak);
        }

        $data = [
            'tree' => stripslashes(json_encode($tree)),
            'active_sidebar' => [0, 0]
        ];

        return view('login-admin-dashboard', $data);
    }

    private function bentukTree(RoleTree $tree, $node)
    {
        if ($node != null) {
            $users = User::where('role', $node->id)->get();

            foreach ($users as $user) {
                $tree->setId($user->id);
                $tree->setData(new TreeData($user->profile_pict == null ? asset("src/img/default-profile-pict.png") : asset($user->profile_pict), $user->name));
            }

            $arrayRoleBawahan = explode(";", $node->bawahan);

            $tree->setChildren([]);

            if ($arrayRoleBawahan !== null) {
                foreach ($arrayRoleBawahan as $roleBawahan) {
                    if ($roleBawahan) {
                        if (count(User::where('role', $roleBawahan)->get())) {
                            $tree->addChild($this->bentukTree(new RoleTree(null, null, null), RoleModel::find($roleBawahan)));
                        }
                    }
                }
            }
        }

        return $tree;
    }

}
