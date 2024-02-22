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
            $users = User::all();
            $roles = RoleModel::all();
            $invitationPending = RegisterInvitationModel::all();
            $passwortResetReq = PasswordResetTokenModel::orderBy('created_at', 'desc')->get();

            $data = [
                'roles' => $roles,
                'users' => $users,
                'invitation' => $invitationPending,
                'pass_reset' => $passwortResetReq
            ];

            return view("user-settings", $data);
        }

        else {
            return redirect()->route('dashboard');
        }
    }

    public function removeUser(Request $request)
    {
        if (Auth::check()) {
            $user = User::where('id', $request->user_id)->first();
            if ($user->profile_pict != null) {
                File::delete(public_path($user->profile_pict));
            }
            $user->delete();

            $data = [
                'success' => isset($user),
                'text' => "Berhasil menghapus user"
            ];

            return redirect()->route('user-settings')->with('toastData', $data);
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
}
