<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterInvitationMail;
use App\Models\AllowedUserModel;
use App\Models\Employee;
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
    public function getHalamanLogin(): View
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = AllowedUserModel::where('email', $request->email)->first();
        $user = User::where('username', $request->username)->first();


        if ($data !== null) {
            if (!$user) {
                try {
                    $userId = User::create([
                        'name' => $request->name,
                        'username' => $request->username,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'verified' => true,
                        'status' =>true,
                        'password' => Hash::make($request->password),
                        'role' => $request->role
                    ])->id;

                    Employee::create([
                        'user_id' => $userId,
                        'name' => $request->name,
                        'role' => $request->id
                    ]);
                    return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => 'Berhasil menambahkan user!']);
                }
                catch (QueryException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Gagal. User sudah terdaftar sebelumnya.']);
                    }
                }

            }

            else {
                return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Gagal. User sudah terdaftar sebelumnya.']);
            }
        }

        return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Menambahkan user ' . $request->name . ' tidak diizinkan']);
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
                return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'Undangan telah dikirim ulang']);
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

            return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => "Undangan terkirim!"]);
        }
        catch (QueryException $e) {
            return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => "Terjadi kesalahan."]);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     *
     * Method ini berfungsi sebagai method yang digunakan untuk menyimpan data saat user register dari halaman register
     */
    public function registerSelfUser(Request $request)
    {
        $data = AllowedUserModel::where('email', $request->email)->first();

        if ($data !== null) {
            try {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:20'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'verified' => false,
                    'status' => false,
                    'password' => Hash::make($request->password),
                    'pending_roles' => $request->role
                ]);

                return redirect()->route('login')->with('data', ['failed' => false, 'text' => 'Permintaan Register Terkirim']);
            }
            catch (QueryException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return redirect()->route('login')->with('data', ['failed' => true, 'text' => 'Gagal. User sudah terdaftar sebelumnya.']);
                }
            }
        }

        else {
            return redirect()->route('login')->with('data', ['failed' => true, 'text' => 'Permintaan Pendaftaran Tidak Diizinkan']);
        }
    }

    public function deleteInvitation(Request $request) {
        $data = RegisterInvitationModel::find($request->id);

        if ($data) {
            $data->delete();
            return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus tautan undangan.']);
        }

        else {
            return redirect()->route('user-settings')->with('toastData', ['success' => false, 'text' => 'Gagal menghapus tautan undangan. Tautan undangan tidak ditemukan!']);
        }
    }

    public function clearInvitation () {
        RegisterInvitationModel::truncate();

        return redirect()->route('user-settings')->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus semua data!']);
    }

    public function acceptRegisterRequest(Request $request) {
        $resetObject = User::find($request->id);

        if ($resetObject) {
            $resetObject->update([
                'verified' => true,
                'role' => $resetObject->pending_roles,
                'status' => true,
                'pending_roles' => null,
                'created_at' => now()
            ]);
            return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => "Berhasil menerima permintaan!"]);
        }
        else {
            return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => "Gagal menerima permintaan! Email tidak ditemukan!"]);
        }


    }

    public function deleteRegisterRequest(Request $request) {
        $data = User::find($request->id);

        if ($data && $data->status == false) {
            $data->delete();

            return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus!']);
        }

        else if ($data && $data->status != null) {
            $data->update([
                'verified' => true,
                'pending_roles' => null
            ]);

            return redirect()->route('user-settings-active')->with('toastData', ['success' => true, 'text' => 'Berhasil menghapus!']);
        }

        else {
            return redirect()->route('user-settings-active')->with('toastData', ['success' => false, 'text' => 'Gagal menghapus!']);
        }
    }
}
