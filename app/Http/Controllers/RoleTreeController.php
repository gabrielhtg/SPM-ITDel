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

        // dd($tree);

        $data = [
            'tree' => stripslashes(json_encode($tree)),
            'active_sidebar' => [0, 0],
            'arrayResponsibleTo' => $arrayResponsibleTo
        ];

        return view('login-admin-dashboard', $data);
    }

    private function bentukTree(RoleTree $tree, $node, &$arrayResponsibleTo): RoleTree
    {
        if ($node != null) {
            // Fetching users with the specific role
            $users = User::where('role', $node->id)->get();

            // Initialize AllServices class
            $allService = new AllServices();

            // Determine the responsible, accountable, and informable relationships
            $roleId = $allService->convertRole($node->id);
            $responsibleId = $allService->getAllResponsible($node->id);
            $accountableId = $allService->getAllAccountableTo($node->id);
            $informableId = $allService->getAllInformable($node->id);

            // Set the node data with the provided information
            $tree->setId($node->id);
            $tree->setData(new TreeData(
                asset('src/img/default-profile-pict.png'),
                $node->role,
                $roleId,
                $responsibleId,
                $accountableId,
                $informableId
            ));

            // If there are users assigned to this role, include them
            if ($users->isNotEmpty()) {
                foreach ($users as $user) {
                    $tree->setData(new TreeData(
                        $user->profile_pict ? asset($user->profile_pict) : asset("src/img/default-profile-pict.png"),
                        $user->name,
                        $roleId,
                        $responsibleId,
                        $accountableId,
                        $informableId
                    ));
                }
            }

            // Fetching subroles (bawahan)
            $arrayRoleBawahan = BawahanModel::where('role', $node->id)->get();

            // Initialize children
            $tree->setChildren([]);

            // Recursive function to handle child roles
            if ($arrayRoleBawahan !== null) {
                foreach ($arrayRoleBawahan as $roleBawahan) {
                    if ($roleBawahan) {
                        // Recursively create child nodes
                        $tree->addChild($this->bentukTree(new RoleTree(null, null, null), RoleModel::find($roleBawahan->bawahan), $arrayResponsibleTo));
                    }
                }
            }
        }

        return $tree;
    }


}
