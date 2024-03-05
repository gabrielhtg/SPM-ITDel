<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\DocumentTypeModel;
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
            $jenis_dokumen = DocumentTypeModel::all();
        } else {
            $documents = DocumentModel::where('give_access_to', 0)->get();
        }
    
        // Ambil data pengguna yang mengunggah
        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
    
        // Ambil semua jenis dokumen
        $jenis_dokumen = DocumentTypeModel::all();
        // dd($jenis_dokumen);
        $roles = RoleModel::all();
    
        $data = [
            'roles' => $roles,
            'documents' => $documents,
            'uploadedUsers' => $uploadedUsers, // Menambahkan data pengguna yang diunggah
            'jenis_dokumen' => $jenis_dokumen, // Menambahkan data jenis dokumen
        ];
    
        return view('document-management', $data);
    }
    

    public function uploadFile(Request $request)
    {
        // Validasi file yang diunggah
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720', // Maksimum 30 MB
            'nomor_dokumen' => 'required|unique:documents,nomor_dokumen', // Nomor dokumen harus unik di tabel documents
            'status' => 'required|in:Berlaku,Tidak Berlaku', // Status harus salah satu dari "Berlaku" atau "Tidak Berlaku"
            'expried_date' => 'nullable|date', // Tanggal kadaluarsa opsional dan harus dalam format tanggal
            'menggantikan_dokumen' => 'nullable', // Dokumen yang digantikan opsional
            'start_date' => 'nullable|date', // Tanggal mulai berlakunya dokumen opsional dan harus dalam format tanggal
            'end_date' => 'nullable|date', // Tanggal berakhirnya dokumen opsional dan harus dalam format tanggal
            'deskripsi' => 'nullable', // Deskripsi opsional
            'tipe_dokumen' => 'required', // Tipe dokumen harus diisi
            'can_see_by' => 'required|in:Public,Private', // Pengecekan apakah isi dokumen bisa dilihat atau tidak
        ], [
            'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
            'status.in' => 'Nilai status tidak valid.',
            'expried_date.date' => 'Format tanggal kadaluarsa tidak valid.',
            'start_date.date' => 'Format tanggal mulai tidak valid.',
            'end_date.date' => 'Format tanggal akhir tidak valid.',
            'tipe_dokumen.required' => 'Tipe dokumen harus diisi.',
            'can_see_by.required' => 'Pilihan untuk dapat dilihat atau tidak harus dipilih.',
            'can_see_by.in' => 'Nilai pilihan dapat dilihat harus salah satu dari "Public" atau "Private".',
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
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File terlalu besar. Batas unggah file maksimum adalah 30 MB!']);
        }

        $accessor = implode(';', $request->give_access_to);

        $document = DocumentModel::create([
            'name' => $request->name,
            'nama_dokumen' => $filename,
            'nomor_dokumen' => $request->nomor_dokumen,
            'deskripsi' => $request->deskripsi,
            'directory' => '/src/documents/' . $filename,
            'created_by' => auth()->user()->id,
            'status' => $request->status,
            'menggantikan_dokumen' => $request->menggantikan_dokumen,
            'year' => $request->year,
            'tipe_dokumen' => $request->tipe_dokumen,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expried_date' => $request->expried_date,
            'give_access_to' => $accessor,
            'can_see_by' => $request->can_see_by, // Menyimpan nilai pengecekan apakah isi dokumen bisa dilihat atau tidak
        ]);

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'File berhasil diunggah!']);
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
    
            // Jika validasi gagal, kembalikan pesan kesalahan dalam bahasa Inggris
            if ($validator->fails()) {
                return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Ukuran file melebihi batas maksimum 30 MB.']);
            }
        }
    
        // Validasi nomor dokumen yang diinput
        $validator = Validator::make($request->all(), [
            'nomor_dokumen' => [
                'required',
                Rule::unique('documents', 'nomor_dokumen')->ignore($request->id), // Nomor dokumen harus unik kecuali untuk dokumen dengan ID yang sama
            ],
        ], [
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
        ]);
    
        // Jika validasi gagal, kembalikan pesan kesalahan dalam bahasa Inggris
        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Nomor dokumen sudah digunakan.']);
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
    
                // Validasi ukuran file sebelum menyimpan
                if ($file->getSize() > 30720) {
                    // Jika ukuran file lebih besar dari yang ditentukan, kembalikan pesan error dalam bahasa Inggris
                    return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Ukuran file melebihi batas maksimum 30 MB.']);
                }
    
                try {
                    $file->move(public_path('/src/documents'), $filename);
                    $document->directory = '/src/documents/' . $filename;
                    $document->nama_dokumen = $filename; // Menggunakan nama asli file
                } catch (IniSizeFileException $e) {
                    return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File terlalu besar. Batas unggah file maksimum adalah 30 MB!']);
                }
            }
    
            // Update data dokumen hanya untuk field yang diubah
            $document->name = $request->name;
            $document->nomor_dokumen = $request->nomor_dokumen;
            $document->status = $request->status; // Perbarui status menggunakan nilai yang dikirimkan melalui formulir
            $document->year = $request->year;
            $document->tipe_dokumen = $request->tipe_dokumen;
            $document->expried_date = $request->expried_date;
            $document->menggantikan_dokumen = $request->menggantikan_dokumen;
            $document->start_date = $request->start_date;
            $document->end_date = $request->end_date;
            $document->deskripsi = $request->deskripsi;
            $document->give_access_to = implode(';', $request->give_access_to);
            $document->can_see_by = $request->can_see_by; // Update nilai pengecekan apakah isi dokumen bisa dilihat atau tidak
            $document->save();
    
            return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Dokumen berhasil diperbarui!']);
        } else {
            // Dokumen tidak ditemukan, kembalikan ke halaman manajemen dokumen dengan pesan kesalahan dalam bahasa Inggris
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Dokumen tidak ditemukan!']);
        }
    }
    
        
    public function getDocument() {
        // Mendapatkan semua dokumen dengan pengurutan berdasarkan tanggal pembuatan (created_at) secara descending
        $documents = DocumentModel::whereIn('give_access_to', ['0', '50'])
                             ->orWhere('give_access_to', 'LIKE', '%1%')
                             ->orderBy('created_at', 'desc')
                             ->get();
        
        // Ambil data pengguna yang mengunggah
        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
            // dd($documents);
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
    
        // Ambil dokumen-dokumen lain yang memiliki tipe dokumen yang sama dengan dokumen yang sedang ditampilkan
        $similarDocuments = DocumentModel::where('tipe_dokumen', $requestedType)
                                    ->where('give_access_to', 'LIKE', ['0', '50'])
                                    ->where('id', '!=', $id) // Exclude the current document from the similar documents
                                    ->get();
    
        // Ambil juga dokumen dengan status 'Tidak Berlaku' yang memiliki tipe dokumen yang sama
        $similarDocumentsNotActive = DocumentModel::where('tipe_dokumen', $requestedType)
                                              ->where('status', 'Tidak Berlaku')
                                              ->where('give_access_to', 'LIKE', ['0', '50'])
                                              ->where('id', '!=', $id) // Exclude the current document from the similar documents
                                              ->get();
    
        // Gabungkan dokumen serupa dengan status 'Tidak Berlaku' ke dalam daftar dokumen serupa
        $similarDocuments = $similarDocuments->merge($similarDocumentsNotActive);
    
        // Ambil data pengguna yang mengunggah
        $uploadedUser = User::find($document->created_by);
    
        // Kirim data dokumen, dokumen serupa, dan pengguna yang mengunggah ke view document-detail
        return view('document-detail', ['document' => $document, 'uploadedUser' => $uploadedUser, 'similarDocuments' => $similarDocuments]);
    }
}

