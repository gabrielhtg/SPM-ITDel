<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetTokenModel;
use App\Models\RegisterInvitationModel;
use App\Models\RoleModel;
use App\Models\User;
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
    public function getUserSettings() {
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
        }

        else {
            return redirect()->route('dashboard');
        }
    }

    public function getUserSettingsInactive() {
        if (Auth::check()) {
            $users = User::where('status', false)->get();

            $data = [
                'users' => $users,
                'active_sidebar' => [4, 2]
            ];

            return view("user-settings-inactive", $data);
        }

        else {
            return redirect()->route('dashboard');
        }
    }

    public function removeUser(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->id);

            if ($user) {
                $user->update([
                    'status' => false,
                    'ends_on' => now(),
                ]);
                return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => "The account in " . $user->name . " name was successfully deactivated!"]);
            }

            else {
                return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => "Failed to deleted user!"]);
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
    public function getUserDetail (Request $request) {
        $user = User::find($request->user_id);
        $data = [
            'user' => $user,
            'active_sidebar' => [0, 0]
        ];

        return view('user-detail', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     *
     * Fungsi ini digunakan untuk mengembalikan akun user yang sudah tidak aktif lagi
     */
    public function restoreAccount (Request $request) : RedirectResponse {
        $user = User::find($request->id);

        $user->update([
            'status' => true,
            'ends_on' => null
        ]);

        return redirect()->route('user-settings-inactive')->with('toastData', ['success' => true, 'text' => 'Successfully activated User ' . $user->name]);
    }
}
