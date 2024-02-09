<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterInvitationMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => (int) $request->role
        ]);

//        event(new Registered($user));
//
//        Auth::login($user);

        $text = null;

        if ($user !== null) {
            $text = "Successfully added user";
        }

        else {
            $text = "Failed to add user";
        }

        $dataToast = [
            'success' => isset($user),
            'text' => $text
        ];

        return redirect()->route('user-settings')->with('toastData', $dataToast);
    }

    public function sendRegisterInvitationLink(Request $request)
    {
        Mail::to($request->email)->send(new RegisterInvitationMail($request->pesan, $request->role, $request->email));

        return redirect()->route('user-settings');
    }
}
