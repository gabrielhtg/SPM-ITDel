<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Symfony\Component\HttpFoundation\File\Exception\IniSizeFileException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    public function getDocumentManagementView() {
        if (Auth::check()) {
            $documents = DocumentModel::all();
        } else {
            $documents = DocumentModel::where('give_access_to', 0)->get();
        }
    
        // Ambil data pengguna yang mengunggah
        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
    
        $roles = RoleModel::all();
    
        $data = [
            'roles' => $roles,
            'documents' => $documents,
            'uploadedUsers' => $uploadedUsers, // Menambahkan data pengguna yang diunggah
        ];
    
        return view('document-management', $data);
    }
    

    public function uploadFile(Request $request) {
        // Validasi file yang diunggah
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720', // Maksimum 30 MB
            'nomor_dokumen' => 'required|unique:documents,nomor_dokumen', // Nomor dokumen harus unik di tabel documents
        ], [
            'nomor_dokumen.unique' => 'The document number is already in use.',
        ]);
        
        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }
    
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
    
        try {
            $file->move(public_path('/src/documents'), $filename);
        } catch (IniSizeFileException $e) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File too big. The maximum file upload limit is 30 MB!']);
        }
    
        $accessor = implode(';', $request->give_access_to);
    
        $expried_date = $request->expried_date;
        $status = now()->isBefore($expried_date) ? 'Berlaku' : 'Tidak Berlaku';
    
        DocumentModel::create([
            'name' => $request->name,
            'nama_dokumen' => $filename, // Menggunakan nama asli file
            'nomor_dokumen' => $request->nomor_dokumen,
            'directory' => '/src/documents/' . $filename,
            'created_by' => auth()->user()->id,
            'status' => $status,
            'year' => $request->year,
            'tipe_dokumen' => $request->tipe_dokumen,
            'expried_date' => $expried_date,
            'give_access_to' => $accessor
        ]);
    
        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'File uploaded successfully!']);
    }
    
    
    
    public function removeDocument(Request $request) {
        $document = DocumentModel::find($request->id);
        File::delete(public_path($document->directory));
        $document->delete();

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Document deleted successfully!']);
    }

    public function updateDocument(Request $request) {
        // Validasi file yang diunggah (jika ada)
        if ($request->hasFile('file')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720', // Maksimum 30 MB
            ]);
    
            // Jika validasi gagal, kembalikan pesan kesalahan
            if ($validator->fails()) {
                return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
            }
        }
    
        // Validasi nomor dokumen yang diinput
        $validator = Validator::make($request->all(), [
            'nomor_dokumen' => [
                'required',
                Rule::unique('documents', 'nomor_dokumen')->ignore($request->id), // Nomor dokumen harus unik kecuali untuk dokumen dengan ID yang sama
            ],
        ], [
            'nomor_dokumen.unique' => 'The document number is already in use.',
        ]);
    
        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }
    
        $document = DocumentModel::find($request->id);
        
        // Periksa apakah dokumen ditemukan sebelum melanjutkan pembaruan
        if ($document) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada perubahan file
                if ($document->directory) {
                    File::delete(public_path($document->directory));
                }
                
                // Proses upload file baru
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                
                try {
                    $file->move(public_path('/src/documents'), $filename);
                    $document->directory = '/src/documents/' . $filename;
                    $document->nama_dokumen = $filename; // Menggunakan nama asli file
                } catch (IniSizeFileException $e) {
                    return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File too big. The maximum file upload limit is 30 MB!']);
                }
            }
            
            // Update data dokumen hanya untuk field yang diubah
            $document->name = $request->name;
            $document->nomor_dokumen = $request->nomor_dokumen;
            $document->status = $request->status; // Perbarui status menggunakan nilai yang dikirimkan melalui formulir
            $document->year = $request->year;
            $document->tipe_dokumen = $request->tipe_dokumen;
            $document->expried_date = $request->expried_date;
            $document->give_access_to = implode(';', $request->give_access_to);
            $document->save();
    
            return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Document updated successfully!']);
        } else {
            // Dokumen tidak ditemukan, kembalikan ke halaman manajemen dokumen dengan pesan kesalahan
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Document not found!']);
        }
    }
        
    public function getDocument() {
        // Mendapatkan semua dokumen
        $documents = DocumentModel::all();
    
        // Ambil data pengguna yang mengunggah
        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
    
        // Kirim data dokumen dan pengguna yang mengunggah ke view document-view
        return view('document-view', ['documents' => $documents, 'uploadedUsers' => $uploadedUsers]);
    }
    
    public function getDocumentDetail($id) {
        // Temukan dokumen berdasarkan ID
        $document = DocumentModel::find($id);
    
        // Periksa apakah dokumen ditemukan
        if (!$document) {
            // Jika dokumen tidak ditemukan, kembalikan respons dengan pesan kesalahan
            return redirect()->route('viewdocument')->with('error', 'Document not found!');
        }
    
        // Ambil tipe dokumen dari dokumen yang sedang ditampilkan
        $requestedType = $document->tipe_dokumen;
    
        // Ambil status dokumen yang sedang ditampilkan
        $requestedStatus = $document->status;
    
        // Ambil dokumen-dokumen lain yang memiliki tipe dokumen dan status yang sama dengan dokumen yang sedang ditampilkan
        $similarDocuments = DocumentModel::where('tipe_dokumen', $requestedType)
                                          ->where('status', $requestedStatus)
                                          ->where('id', '!=', $id) // Exclude the current document from the similar documents
                                          ->get();
    
        // Cek nilai $similarDocuments sebelum dilewatkan ke view
        
    
        // Ambil data pengguna yang mengunggah
        $uploadedUser = User::find($document->created_by);
    
        // Kirim data dokumen, dokumen serupa, dan pengguna yang mengunggah ke view document-detail
        return view('document-detail', ['document' => $document, 'uploadedUser' => $uploadedUser, 'similarDocuments' => $similarDocuments]);
    }
    
    
    
}