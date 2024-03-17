<?php

namespace App\Http\Controllers;
use App\Models\DocumentTypeModel;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\AllServices;
use Illuminate\Support\Facades\Validator;

class TypeDocumentController extends Controller
{
    public function getDocumentType()
    {
        if (Auth::check()) {
            $documentTypes = DocumentTypeModel::all();
        } else {
            $documentTypes = DocumentTypeModel::where('give_access_to', 0)->get();
        }

        $roles = RoleModel::all();

        $data = [
            'roles' => $roles,
            'documenttype' => $documentTypes,
        ];

        return view('document-management', $data);
    }

    public function addDocumentType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_dokumen' => 'required|unique:document_types',
            'singkatan' => 'required|unique:document_types',
        ], [
            'jenis_dokumen.unique' => "The Document Type is already in use.",
            'singkatan.unique' => "The abbreviation is already in use.",
        ]);
    
        if (!AllServices::isAdmin()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'You are not authorized to add document types.']);
        }
    
        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }
    
        DocumentTypeModel::create([
            'jenis_dokumen' => $request->jenis_dokumen,
            'singkatan' => $request->singkatan,
        ]);
    
        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Document Type uploaded successfully!']);
    }
    

}
