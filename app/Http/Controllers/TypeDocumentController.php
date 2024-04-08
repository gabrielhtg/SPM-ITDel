<?php

namespace App\Http\Controllers;
use App\Models\DocumentTypeModel;
use App\Models\LaporanTypeModel;
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
            'jenis_dokumen.unique' => "Tipe dokumen sudah digunakan.",
            'singkatan.unique' => "Singkatam sudah digunakan.",
        ]);

        if (!AllServices::isLoggedUserHasAdminAccess()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'You are not authorized to add document types.']);
        }

        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }

        DocumentTypeModel::create([
            'jenis_dokumen' => $request->jenis_dokumen,
            'singkatan' => $request->singkatan,
        ]);

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Tipe dokumen berhasil ditambahkan!']);
    }

    public function addLaporanType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_laporan' => 'required|unique:tipe_laporan',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'nama_laporan.unique' => "Tipe dokumen sudah digunakan.",
        ]);

        if (!AllServices::isLoggedUserHasAdminAccess()) {
            return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => false, 'text' => 'You are not authorized to add document types.']);
        }

        if ($validator->fails()) {
            return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }

        LaporanTypeModel::create([
            'nama_laporan' => $request->nama_laporan,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => true, 'text' => 'Tipe laporan berhasil ditambahkan!']);
    }

    public function editLaporanType(Request $request, $id)
    {
        // Validasi data yang diubah
        $validator = Validator::make($request->all(), [
            'nama_laporan' => 'required|unique:tipe_laporan,nama_laporan,'.$id,
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'nama_laporan.unique' => "Tipe dokumen sudah digunakan.",
        ]);

        // Cek apakah pengguna memiliki izin untuk mengedit tipe laporan
        if (!AllServices::isAdmin()) {
            return redirect()->route('LaporanManagement')->with('toastData', ['success' => false, 'text' => 'You are not authorized to edit document types.']);
        }

        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->route('editLaporanForm', $id)->withErrors($validator)->withInput();
        }

        // Perbarui data tipe laporan
        $laporan = LaporanTypeModel::find($id);
        $laporan->nama_laporan = $request->nama_laporan;
        $laporan->start_date = $request->start_date;
        $laporan->end_date = $request->end_date;
        $laporan->save();

        // Redirect kembali ke halaman manajemen tipe laporan dengan pesan sukses
        return redirect()->route('LaporanManagement')->with('toastData', ['success' => true, 'text' => 'Tipe laporan berhasil diperbarui!']);
    }



}
