<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterInvitationMail;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetTokenModel;
use App\Models\RegisterInvitationModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

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

        $data = RegisterInvitationModel::where('email', $request->email)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => false,
            'password' => Hash::make($request->password),
            'role' => (int) $request->role
        ]);

//        event(new Registered($user));
//
//        Auth::login($user);

        if ($user !== null) {
            $text = "Successfully added user";

            $data?->delete();
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
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        try {
            $temp = RegisterInvitationModel::where('email', $request->email)->first();

            if ($temp) {
                $temp->update([
                    'role' => $request->role
                ]);
                Mail::to($request->email)->send(new RegisterInvitationMail($request->pesan, $request->role, $temp->token));
                return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'The invitation was resent']);
            }

            else {
                $reqToken = Uuid::uuid1()->toString();

                RegisterInvitationModel::create([
                    'email' => $request->email,
                    'role' => $request->role,
                    'token' => $reqToken
                ]);

                Mail::to($request->email)->send(new RegisterInvitationMail($request->pesan, $request->role, $reqToken));

            }

            return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => "Invitation sent!"]);
        }
        catch (QueryException $e) {
//            if ($e->errorInfo[1] == 1062) { // 1062 adalah kode untuk kesalahan duplikat kunci unik
//                return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => 'Duplicate Email']);
//            } else {
                return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => "An error occurred."]);
//            }
        }
    }

    public function storeFromInvitationLink(Request $request)
    {
        $data = RegisterInvitationModel::where('token', $request->token)->first();

        if ($data && ($data->email === $request->email) && ($data->role === (int)$request->role)) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'status' => false,
                'password' => Hash::make($request->password),
                'role' => (int) $request->role
            ]);

            $data->delete();

            return redirect()->route('login');
        }

        abort(401);
    }

    public function deleteInvitation(Request $request) {
        $data = RegisterInvitationModel::find($request->id);

        if ($data) {
            $data->delete();
            return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'Successfully deleted the invitation link.']);
        }

        else {
            return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => 'Failed to delete invitation link. Invitation link not found!']);
        }
    }

    public function clearInvitation () {
        RegisterInvitationModel::truncate();

        return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'Successfully deleted all data!']);
    }

    public function acceptResetRequest(Request $request) {
        $resetObject = PasswordResetTokenModel::where('email', $request->email)->first();

        if ($resetObject) {
            Mail::to($request->email)->send(new ResetPasswordMail($resetObject->token));
            return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => "Success to accept request. A password reset email has been sent to " . $resetObject->email]);
        }
        else {
            return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => "Failed to accept request. Email not found!"]);
        }


    }

    public function deleteResetRequest(Request $request) {
        $data = PasswordResetTokenModel::where('email', $request->email);

        if ($data) {
            $data->delete();

            return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'Successfully deleted!']);
        }

        else {
            return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => 'Failed to delete!']);
        }
    }
}
