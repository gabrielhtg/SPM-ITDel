<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AllowedUserModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $userAllowed = User::where('username', $request->username)->first();

        if ($userAllowed !== null && $userAllowed->verified) {
            $request->authenticate();

            $request->session()->regenerate();
            $user = auth()->user();

            $user->update([
                'ip_address' => $request->ip(),
                'last_login_at' => now(),
                'online' => true
            ]);

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        else {
            return redirect()->route('login')->with('data', ['failed' => true, 'text' => 'Kredensial Tidak Ditemukan!']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $user = auth()->user();

        $user->update([
            'last_login_at' => now(),
            'online' => false
        ]);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
