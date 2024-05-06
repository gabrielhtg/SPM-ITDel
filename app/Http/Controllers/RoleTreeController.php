<?php

namespace App\Http\Controllers;

use App\Models\BawahanModel;
use App\Models\RoleModel;
use App\Models\RoleTree;
use App\Models\TreeData;
use App\Models\User;
use App\Models\Employee;
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

        if (!empty($rolePuncak)) {
            $this->bentukTree($tree, $rolePuncak);
        }

        // dd($tree);

        $data = [
            'tree' => stripslashes(json_encode($tree)),
            'active_sidebar' => [0, 0]
        ];

        return view('login-admin-dashboard', $data);
    }

    private function bentukTree(RoleTree $tree, $node)
    {
        if ($node != null) {
            $employees = Employee::where('role', $node->id)->get();

            $allService = new AllServices();

            foreach ($employees as $employee) {
                $roleId = $allService::convertRole($employee->role);
                $responsibleId = $allService::getAllResponsible($employee->role);
                $accountableId = $allService::getAllAccountableTo($employee->role);
                $informableId = $allService::getAllInformable($employee->role);

                $tree->setId($employee->id);
                $tree->setData(
                    new TreeData(
                        $employee->profile_pict == null ? asset("src/img/default-profile-pict.png") : asset($employee->profile_pict), 
                        $employee->name, 
                        $roleId,
                        $responsibleId,
                        $accountableId,
                        $informableId
                    )
                );
            }

            $arrayRoleBawahan = BawahanModel::where("role", $node->id)->get();

            $tree->setChildren([]);

            if ($arrayRoleBawahan !== null) {
                foreach ($arrayRoleBawahan as $roleBawahan) {
                    if ($roleBawahan) {
                        if (count(Employee::where('role', $roleBawahan->bawahan)->get())) {
                            $tree->addChild($this->bentukTree(new RoleTree(null, null, null), RoleModel::find($roleBawahan->bawahan)));
                        }
                    }
                }
            }
        }

        return $tree;
    }

}