<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterInvitationMail;
use App\Models\AllowedUserModel;
use App\Models\RegisterInvitationModel;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $data = [
            'roles' => RoleModel::all()
        ];

        return view('auth.register', $data);
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
            'username' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = AllowedUserModel::where('email', $request->email)->first();
        $user = User::where('username', $request->username)->first();

        if ($data !== null) {
            if (!$user) {
                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => true,
                    'verified' => true,
                    'password' => Hash::make($request->password),
                    'role' => $request->role
                ]);
                return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => 'Successfully created user!']);
            }

            else {
                return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Failed. User exist!']);
            }
        }

        return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Creating user ' . $request->name . ' is not permitted']);
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
            return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => "An error occurred."]);
        }
    }

    public function registerSelfUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = AllowedUserModel::where('email', $request->email)->first();
        $user = User::where('username', $request->username)->first();

        if ($data !== null) {
            if (!$user) {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:20'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'verified' => false,
                    'password' => Hash::make($request->password),
                    'role' => $request->role
                ]);
                return redirect()->route('login')->with('data', ['failed' => false, 'text' => 'Register Request Sent']);
            }

            else {
                return redirect()->route('login')->with('data', ['failed' => true, 'text' => 'Register Request has been sent previously!']);
            }


        }

        return redirect()->route('login')->with('data', ['failed' => true, 'text' => 'Register Request Not Allowed']);
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

    public function acceptRegisterRequest(Request $request) {
        $resetObject = User::find($request->id);

        if ($resetObject) {
            $resetObject->update([
                'verified' => true,
                'status' => true,
                'created_at' => now()
            ]);
            return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => "Success to accept request!"]);
        }
        else {
            return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => "Failed to accept request! Email not found!"]);
        }


    }

    public function deleteRegisterRequest(Request $request) {
        $data = User::find($request->id);

        if ($data) {
            $data->delete();

            return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => 'Successfully deleted!']);
        }

        else {
            return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Failed to delete!']);
        }
    }
}
