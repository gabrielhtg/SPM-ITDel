<?php

namespace App\Http\Controllers;

use App\Models\BawahanModel;
use App\Models\RoleModel;
use App\Models\RoleTree;
use App\Models\TreeData;
use App\Models\User;
use App\Services\AllServices;
use Illuminate\Http\Request;

class RoleTreeController extends Controller
{
    public function indexlogindashboard(Request $request)
    {
        $tree = new RoleTree(null, null, null);
        $allService = new AllServices();

        // Bagian ini untuk mendapatkan user puncak
        foreach (RoleModel::all() as $e) {
            if ($e->atasan_id == null && $e->role !== "Admin") {
                $rolePuncak = $e;
                break;
            }
        }

        $arrayResponsibleTo = [];

        if (!empty($rolePuncak)) {
            $this->bentukTree($tree, $rolePuncak, $arrayResponsibleTo);
        }

        
        $data = [
            'tree' => stripslashes(json_encode($tree)),
            'active_sidebar' => [0, 0],
            'arrayResponsibleTo' => $arrayResponsibleTo
        ];

        return view('login-admin-dashboard', $data);
    }

    private function bentukTree(RoleTree $tree, $node, $arrayResponsibleTo)
    {
        if ($node != null) {            
            $users = User::where('role', $node->id)->get();
            
            foreach ($users as $user) {
                $tree->setId($user->id);
                $arrayResponsibleTo = AllServices::convertRole($user->role);
                // dd($arrayResponsibleTo);
                $tree->setData(new TreeData($user->profile_pict == null ? asset("src/img/default-profile-pict.png") : asset($user->profile_pict), $user->name, $arrayResponsibleTo));
            }

            $arrayRoleBawahan = BawahanModel::where("role", $node->id)->get();

            $tree->setChildren([]);

            if ($arrayRoleBawahan !== null) {
                foreach ($arrayRoleBawahan as $roleBawahan) {
                    if ($roleBawahan) {
                        if (count(User::where('role', $roleBawahan->bawahan)->get())) {
                            $tree->addChild($this->bentukTree(new RoleTree(null, null, null), RoleModel::find($roleBawahan->bawahan),$arrayResponsibleTo));
                        }
                    }
                }
            }
        }

        return $tree;
    }

}
