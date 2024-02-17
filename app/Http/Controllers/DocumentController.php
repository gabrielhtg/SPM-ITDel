<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;

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

        // Simpan file yang diunggah ke dalam direktori penyimpanan yang diinginkan
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path(''), $filename);

        // Simpan informasi dokumen ke dalam database
        $document = new Document();
        $document->filename = $filename;
        $document->save();

        // Attach roles to document
        $document->roles()->attach($request->roles);

        return redirect()->route('document.index')->with('success', 'Document uploaded successfully.');
    }
}
