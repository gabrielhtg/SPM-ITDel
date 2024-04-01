<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPUnit\Exception;

class ListAllowedUserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     * Method ini berfungsi untuk mendapatkan halaman allowed user
     */
    public function getListAllowedUser()
    {
        $allowedUser = AllowedUserModel::all();

        $data = [
            'allowedUser' => $allowedUser,
            'active_sidebar' => [0, 0]
        ];

        return view('list-user-allowed', $data);
    }

    public function uploadListAllowedUser(Request $request)
    {
        $file = $request->file('file-excel');

        try {
            $spreadsheet = IOFactory::load($file);
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            return redirect()->route("list-allowed-user")->with('toastData', ['success' => false, 'text' => 'File tidak didukung!']);
        }
        $worksheet = $spreadsheet->getActiveSheet();

        $firstColumn = [];
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $firstColumn[] = $cell->getValue();
                break;
            }
        }

        array_shift($firstColumn);
        foreach ($firstColumn as $e) {
            if ($e !== null && str_contains($e, '@')) {
                try {
                    AllowedUserModel::create([
                        'email' => $e,
                        'created_at' => now(),
                        'created_by' => auth()->user()->username
                    ]);
                } catch (\Exception $e) {
                    // do nothing
                }
            }
        }

        return redirect()->route("list-allowed-user")->with('toastData', ['success' => true, 'text' => 'Berhasil menambahkan pengguna yang diizinkan dari file excel!']);
    }

    public function removeFromList (Request $request) {
        AllowedUserModel::find($request->id)->delete();

        return redirect()->route("list-allowed-user")->with('toastData', ['success' => true, 'text' => 'Data berhasil dihapus!']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Fungsi ini berfungsi untuk menambahkan email allowed user satu persatu
     */
    public function addAllowedUser (Request $request) {
        try {
            AllowedUserModel::create([
                'email' => $request->email,
                'created_at' => now(),
                'created_by' => auth()->user()->username
            ]);

            return redirect()->route("list-allowed-user")->with('toastData', ['success' => true, 'text' => 'Berhasil menambahkan pengguna baru yang diizinkan!']);
        } catch (QueryException $e) {
            return redirect()->route("list-allowed-user")->with('toastData', ['success' => false, 'text' => 'Gagal menambahkan pengguna baru yang diizinkan. Email sudah ditambahkan!']);

        }
    }
}
