<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterInvitationMail;
use App\Models\RegisterInvitationModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
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
    public function create($token): View
    {
        $data = RegisterInvitationModel::where('token', $token)->first();

        if ($data) {
            return view('auth.register', $data);
        }
        else {
            abort(404);
        }

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
            'status' => false,
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
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        try {
            $reqToken = Uuid::uuid1()->toString();
            RegisterInvitationModel::create([
                'email' => $request->email,
                'role' => $request->role,
                'token' => $reqToken
            ]);

            Mail::to($request->email)->send(new RegisterInvitationMail($request->pesan, $request->role, $reqToken));

            $dataToast = [
                'success' => true,
                'text' => "Invitation sent!"
            ];

            return redirect()->route('user-settings')->with($dataToast);
        } catch (\Exception $e) {
            $dataToast = [
                'success' => false,
                'text' => "Email sudah pernah diundang!"
            ];
            return redirect()->route('user-settings')->with($dataToast);
        }

    }

    public function storeFromInvitationLink(Request $request)
    {
        $data = RegisterInvitationModel::where('token', $request->token)->first();

        if ($data) {
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

}
