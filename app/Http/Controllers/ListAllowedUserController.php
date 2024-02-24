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
                    // do nothing
                }
            }
        }

        return redirect()->route("list-allowed-user")->with('toastData', ['success' => true, 'text' => 'Successfully added allowed user from excel file!']);
    }

    public function removeFromList (Request $request) {
        AllowedUserModel::find($request->id)->delete();

        return redirect()->route("list-allowed-user")->with('toastData', ['success' => true, 'text' => 'Successfully removed data!']);
    }

    public function addAllowedUser (Request $request) {
        AllowedUserModel::create([
            'email' => $request->email,
            'created_at' => now(),
            'created_by' => auth()->user()->username
        ]);

        return redirect()->route("list-allowed-user")->with('toastData', ['success' => true, 'text' => 'Successfully added new allowed user!']);

    }
}
