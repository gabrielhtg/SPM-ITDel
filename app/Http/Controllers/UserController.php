<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetTokenModel;
use App\Models\RegisterInvitationModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserSettings() {
        if (Auth::check()) {
            $users = User::all();
            $invitationPending = RegisterInvitationModel::all();
            $passwortResetReq = PasswordResetTokenModel::orderBy('created_at', 'desc')->get();

            $data = [
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
            $user->delete();

            $data = [
                'success' => isset($user),
                'text' => "Berhasil menghapus user"
            ];

            return redirect()->route('user-settings')->with('toastData', $data);
        }
    }
}
