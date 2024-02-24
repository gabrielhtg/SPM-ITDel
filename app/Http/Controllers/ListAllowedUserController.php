<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListAllowedUserController extends Controller
{
    public function getListAllowedUser()
    {
        $allowedUser = AllowedUserModel::all();

        $data = [
            'allowedUser' => $allowedUser
        ];

        return view('list-user-allowed', $data);
    }

    public function uploadListAllowedUser(Request $request)
    {
        // Mendapatkan file yang diunggah
        $file = $request->file('file-excel');

        $spreadsheet = IOFactory::load($file);
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

        // Lakukan sesuatu dengan kolom pertama
//        dump($firstColumn);
//        sleep(10);
        array_shift($firstColumn);
        foreach ($firstColumn as $e) {
            if ($e !== null) {
                try {
                    AllowedUserModel::create([
                        'email' => $e,
                        'created_at' => now(),
                        'created_by' => auth()->user()->username
                    ]);
                } catch (\Exception $e) {

                }
;g
            }
        }

        return redirect()->route("list-allowed-user");
    }

    public function removeFromList (Request $request) {
        AllowedUserModel::find($request->id)->delete();

        return redirect()->route("list-allowed-user");
    }
}
