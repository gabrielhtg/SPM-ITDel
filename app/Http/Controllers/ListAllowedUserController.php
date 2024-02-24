<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserModel;
use Illuminate\Http\Request;

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

// Membaca file Excel menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($file);

// Memilih sheet pertama
        $sheet = $spreadsheet->getActiveSheet();

// Mengambil data dari setiap baris
        foreach ($sheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            // Lakukan sesuatu dengan data $rowData
        }
    }
}
