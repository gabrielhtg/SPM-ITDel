<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $data = [
            'active_sidebar' => [0,0],
            'roles' => RoleModel::all()
        ];
        return view('profile.edit', $data);
    }

    public function editProfile(Request $request)
    {
        $user = User::find($request->id);
        $roles = implode(';', $request->roles);

        if ($user->role == $roles) {
            try {
                $user->update([
                    'username' => $request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

                return redirect()->route('profile')->with('toastData', ['success' => true, "text" => 'Success. Profile changed!']);
            }

            catch (QueryException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return redirect()->route('profile')->with('toastData', ['success' => false, "text" => 'Username sudah pernah digunakan sebelumnya!']);
                }
            }
        }

        else {
            $user->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'pending_roles' => $roles,
                'verified' => false
            ]);

            return \redirect()->route('profile')->with('toastData', ['success' => true, "text" => 'Success. Wait for the admin to approve your changes!']);
        }


    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function changeProfilePict(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return \view('profile.change-profile-pict');
    }

    public function uploadProfilePict(Request $request): void
    {
        if ($request->hasFile('croppedImage')) {
            $user = User::where('email', \auth()->user()->email)->first();

            // Simpan file yang diunggah ke direktori yang ditentukan
            $image = $request->file('croppedImage');
            $imageName = explode("@", $user->email)[0] . '.png';
            $image->move(public_path('src/img/profile_pict/'), $imageName);

            $user->update([
                'profile_pict' => 'src/img/profile_pict/' . $imageName
            ]);
        }
    }

    public function changePassword(Request $request) {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (Hash::check($request->current_password, \auth()->user()->password)) {
            \auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
            return \redirect()->route('profile')->with('toastData', ['success' => true, 'text' => "Successfully changed password!"]);
        }

        else {
            return \redirect()->route('profile')->with('toastData', ['success' => false, 'text' => "Failed to change password!"]);
        }

    }
}
