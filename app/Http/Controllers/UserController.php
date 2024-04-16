<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\User;
use App\Models\UserInactiveModel;
use App\Services\AllServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     *
     * Mendapatkan halaman user settings yang active usernya
     */
    public function getUserSettings()
    {
        if (Auth::check()) {
            $users = User::where('status', true)->get();
            $roles = RoleModel::all();
            $passwordResetReq = User::where('verified', false)->orderBy('created_at', 'desc')->get();

            $data = [
                'roles' => $roles,
                'users' => $users,
                'pending_action' => $passwordResetReq,
                'active_sidebar' => [4, 1]
            ];

            return view("user-settings", $data);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function getUserSettingsInactive()
    {
        if (AllServices::isLoggedUserHasAdminAccess()) {
            $users_inactive = UserInactiveModel::all();

            $data = [
                'users' => $users_inactive,
                'active_sidebar' => [4, 2]
            ];

            return view("user-settings-inactive", $data);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function removeUser(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->id);

            if ($user) {
                $temp = UserInactiveModel::create(
                    [
                        'name' => $user->name,
                        'username' => $user->username,
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'ends_on' => now(),
                        'role' => $user->role,
                        'profile_pict' => $user->profile_pict
                    ]
                );



                $user->delete();

                return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => "Akun dengan nama pengguna " . $user->name . " berhasil dinonaktifkan!"]);
            } else {
                return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => "Gagal untuk menghapus pengguna!"]);
            }
        }

        return redirect()->route('login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     * Fungsi ini digunakan untuk mendapatkan detail user melalui page user-detail
     */
    public function getUserDetail(Request $request)
    {
        $user = User::find($request->user_id);
        $data = [
            'user' => $user,
            'active_sidebar' => [0, 0]
        ];

        return view('user-detail', $data);
    }

    public function getUserDetailInactive(Request $request)
    {
        $user = UserInactiveModel::find($request->user_id);
        $data = [
            'user' => $user,
            'active_sidebar' => [0, 0]
        ];

        return view('user-detail-inactive', $data);
    }

    //    public function indexlogindashboard(Request $request)
//    {
//        $user = User::find($request->user_id);
//        $roles = RoleModel::find(2);
//        $data = [
//            'roles' => $roles,
//            'user' => $user ,
//            'active_sidebar' => [0, 0]
//        ];
//
//        return view('login-admin-dashboard', $data);
//    }


    /**
     * @param Request $request
     * @return RedirectResponse
     *
     * Fungsi ini digunakan untuk mengembalikan akun user yang sudah tidak aktif lagi
     */
    public function restoreAccount(Request $request): RedirectResponse
    {
        $user = User::find($request->id);

        $user->update([
            'status' => true,
            'ends_on' => null
        ]);

        return redirect()->route('user-settings-inactive')->with('toastData', ['success' => true, 'text' => 'Berhasil mengaktifkan pengguna ' . $user->name]);
    }
}
