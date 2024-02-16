<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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

    public function changeProfilePict() {
        return \view('profile.change-profile-pict');
    }

    public function uploadProfilePict(Request $request) {
        if ($request->hasFile('croppedImage')) {
            $user = User::where('email', \auth()->user()->email)->first();

            // Simpan file yang diunggah ke direktori yang ditentukan
            $image = $request->file('croppedImage');
            $imageName = explode("@", $user->email)[0] . '.png';
            $image->move(public_path('src/img/profile_pict/'), $imageName);

            $user->update([
                'profile_pict' => 'src/img/profile_pict/' . $imageName
            ]);

            return \redirect()->route('user-settings');
        } else {
            // Jika tidak ada file yang diunggah dengan nama "croppedImage"
            abort(400);
        }
    }
}
