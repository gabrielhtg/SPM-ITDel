<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetTokenModel;
use App\Models\RegisterInvitationModel;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function getUserSettings() {
        if (Auth::check()) {
            $users = User::where('status', true)->get();
            $roles = RoleModel::all();
            $passwordResetReq = User::where('verified', false)->orderBy('created_at', 'desc')->get();

            $data = [
                'roles' => $roles,
                'users' => $users,
                'pass_reset' => $passwordResetReq
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
            $user = User::where('id', $request->user_id)->first();

            $user->update([
                'status' => false,
                'ends_on' => now()
            ]);

            $data = [
                'success' => isset($user),
                'text' => "Berhasil menghapus user"
            ];

            return redirect()->route('user-settings-active')->with('toastData', $data);
        }

        return redirect()->route('login');
    }

    public function getUserDetail (Request $request) {
        $user = User::find($request->user_id);
        $data = [
            'user' => $user,
        ];

        return view('user-detail', $data);
    }

    public function restoreAccount (Request $request) {
        $user = User::find($request->id);

        $user->update([
            'status' => true,
            'ends_on' => null
        ]);

        return redirect()->route('user-settings-inactive')->with('toastData', ['success' => true, 'text' => 'Successfully activated User ' . $user->name]);
    }
}
