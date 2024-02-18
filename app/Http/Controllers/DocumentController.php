<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use MongoDB\BSON\Document;
use Symfony\Component\HttpFoundation\File\Exception\IniSizeFileException;

class DocumentController extends Controller
{
    public function getDocumentManagementView () {
        $documents = DocumentModel::all();
        $roles = RoleModel::all();

        $data = [
            'roles' => $roles,
            'documents' => $documents
        ];

        return view('document-management', $data);
    }

    public function uploadFile (Request $request) {
//        $request->validate([
//            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Contoh: Hanya menerima file PDF, DOC, dan DOCX maksimal 2MB
//            'roles' => 'required|array', // Pastikan roles merupakan array
//            'roles.*' => 'integer|exists:roles,id', // Pastikan setiap role adalah integer dan ada di tabel roles
//        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        try {
            $file->move(public_path('/src/documents'), $filename);
        } catch (IniSizeFileException $e) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File too big. The maximum file upload limit is 30 MB!']);
        }

        $accessor = implode(';', $request->give_access_to);

        DocumentModel::create([
            'name' => $filename,
            'directory' => '/src/documents/' . $filename,
            'created_by' => auth()->user()->id,
            'created_at' => now(),
            'give_access_to' => $accessor
        ]);

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'File uploaded successfully!']);
    }

    public function removeDocument(Request $request) {
        DocumentModel::find($request->id)->delete();

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Document deleted successfully!']);
    }
}
