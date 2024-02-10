<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetTokenModel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        return $status == Password::RESET_LINK_SENT
//                    ? back()->with('status', __($status))
//                    : back()->withInput($request->only('email'))
//                            ->withErrors(['email' => __($status)]);

        $dataToken = PasswordResetTokenModel::find($request->email);
        $user = User::where('email', $request->email)->first();


        if ($dataToken) {
            if ($user) {
                $dataToken->update([
                    'pass_test' => (boolean) rand(0, 1),
                    'created_at' => now()
                ]);

                return redirect()->route('password.email')->with('toastData', ['success' => true, 'text' => 'Request updated!', 'msg' => 'Tunggu sampai admin mengirimkan reset token ke email anda.']);
            }

            else {
                return redirect()->route('password.email')->with('toastData', ['success' => false, 'text' => 'Whoopss!! User not found.']);
            }
        }

        else {
            if ($user) {
                PasswordResetTokenModel::create([
                    'email' => $request->email,
                    'token' => Str::random(200),
                    'pass_test' => (boolean) rand(0, 1),
                    'created_at' => now()
                ]);
                return redirect()->route('password.email')->with('toastData', ['success' => true, 'text' => 'Request sent!', 'msg' => 'Tunggu sampai admin mengirimkan reset token ke email anda.']);
            }

            else {
                return redirect()->route('password.email')->with('toastData', ['success' => false, 'text' => 'Whoopss!! User not found.']);
            }
        }
    }
}
