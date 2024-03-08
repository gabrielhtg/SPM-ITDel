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
    public function getDocumentManagementView()
    {
        if (Auth::check()) {
            $documents = DocumentModel::where('created_by', auth()->user()->id)->get();
            $jenis_dokumen = DocumentTypeModel::all();
        } else {
            $documents = DocumentModel::where('give_access_to', 0)->get();
        }

        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
        $jenis_dokumen = DocumentTypeModel::all();
        $roles = RoleModel::all();

        $data = [
            'documents' => $documents,
            'uploadedUsers' => $uploadedUsers,
            'jenis_dokumen' => $jenis_dokumen,
            'roles' => $roles,
        ];

        return view('document-management', $data);
    }

    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
            'nomor_dokumen' => 'required|unique:documents,nomor_dokumen',
            'status' => 'required|in:Berlaku,Tidak Berlaku',
            'menggantikan_dokumen.*' => 'nullable|exists:documents,id', 
            'start_date' => 'required',
            'end_date' => 'required',
            'deskripsi' => 'nullable',
            'link' => 'nullable|url',
            'tipe_dokumen' => 'required',
            'can_see_by' => 'required',
            'give_access_to.*' => 'required|exists:users,id',
        ], [
            'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
            'status.in' => 'Nilai status tidak valid.',
            'menggantikan_dokumen.*.exists' => 'Dokumen yang dipilih untuk digantikan tidak valid.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.date_format' => 'Format tanggal mulai tidak valid.',
            'end_date.required' => 'Tanggal akhir harus diisi.',
            'end_date.date_format' => 'Format tanggal akhir tidak valid.',
            'tipe_dokumen.required' => 'Tipe dokumen harus diisi.',
            'can_see_by.required' => 'Pilihan untuk dapat dilihat atau tidak harus dipilih.',
            
            'give_access_to.*.exists' => 'Pengguna yang diberikan akses tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }

        // Upload file and process document data storage
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        try {
            $file->move(public_path('/src/documents'), $filename);
        } catch (IniSizeFileException $e) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File terlalu besar. Batas unggah file maksimum adalah 30 MB!']);
        }

        // Set keterangan status based on date
        

        $currentDateTime = now();
        $keterangan_status = 'Inactive'; // Nilai default
        
        if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
            $keterangan_status = 'Active';
        }

        // Convert array to string
        $menggantikan_dokumen = $request->menggantikan_dokumen ? implode(',', $request->menggantikan_dokumen) : null;

        $accessor = implode(';', $request->give_access_to);

        // Create document record
        $document = DocumentModel::create([
            'name' => $request->name,
            'nama_dokumen' => $filename,
            'nomor_dokumen' => $request->nomor_dokumen,
            'deskripsi' => $request->deskripsi,
            'directory' => '/src/documents/' . $filename,
            'created_by' => auth()->user()->id,
            'status' => $request->status,
            'menggantikan_dokumen' => $menggantikan_dokumen,
            'year' => $request->year,
            'tipe_dokumen' => $request->tipe_dokumen,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'keterangan_status' => $keterangan_status,
            'give_access_to' => $accessor,
            'can_see_by' => $request->can_see_by,
            'link' => $request->link,
        ]);

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'File berhasil diunggah!']);
    }

    public function removeDocument(Request $request)
    {
        $document = DocumentModel::find($request->id);
        File::delete(public_path($document->directory));
        $document->delete();

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Dokumen berhasil dihapus!']);
    }

    public function updateDocument(Request $request)
    {
        // Tambahkan validasi file jika diunggah
        if ($request->hasFile('file')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Ukuran file melebihi batas maksimum 30 MB.']);
            }
        }
    
        // Validasi nomor dokumen dan dokumen yang digantikan
        $validator = Validator::make($request->all(), [
            'nomor_dokumen' => [
                'required',
                Rule::unique('documents', 'nomor_dokumen')->ignore($request->id),
            ],
            'menggantikan_dokumen.*' => 'nullable|exists:documents,id', // Validasi dokumen yang dipilih untuk digantikan
        ], [
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
            'menggantikan_dokumen.*.exists' => 'Dokumen yang dipilih untuk digantikan tidak valid.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }
    
        // Temukan dokumen yang akan diperbarui
        $document = DocumentModel::find($request->id);
    
        if ($document) {
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($document->directory) {
                    File::delete(public_path($document->directory));
                }
    
                // Unggah file baru
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
    
                if ($file->getSize() > 30720) {
                    return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Ukuran file melebihi batas maksimum 30 MB.']);
                }
    
                try {
                    $file->move(public_path('/src/documents'), $filename);
                    $document->directory = '/src/documents/' . $filename;
                    $document->nama_dokumen = $filename;
                } catch (IniSizeFileException $e) {
                    return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'File terlalu besar. Batas unggah file maksimum adalah 30 MB!']);
                }
            }
    
            // Perbarui data dokumen
            $document->name = $request->name;
            $document->nomor_dokumen = $request->nomor_dokumen;
            $document->status = $request->status;
            $document->year = $request->year;
            $document->tipe_dokumen = $request->tipe_dokumen;
            $document->menggantikan_dokumen = $request->menggantikan_dokumen ? implode(',', $request->menggantikan_dokumen) : null; // Convert array to string or set to null if empty
            $document->start_date = $request->start_date;
            $document->end_date = $request->end_date;
            $document->deskripsi = $request->deskripsi;
            $document->give_access_to = implode(';', $request->give_access_to);
            $document->can_see_by = $request->can_see_by;
    
            $currentDate = now();
            $keterangan_status = 'Inactive'; // Nilai default
            
            if ($request->start_date && $request->start_date <= $currentDate && (!$request->end_date || $request->end_date >= $currentDate)) {
                $keterangan_status = 'Active';
            }
            
            // Atur keterangan_status menjadi Inactive jika end_date sudah lewat dari waktu saat ini
            if ($request->end_date && $request->end_date < $currentDate) {
                $keterangan_status = 'Inactive';
            }
            
    
            // Perbarui keterangan status menjadi Inactive jika waktu sekarang melewati end_date
            if ($request->end_date && $request->end_date < $currentDate) {
                $document->keterangan_status = 'Inactive';
            }
    
            $document->save();
    
            return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Dokumen berhasil diperbarui!']);
        } else {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Dokumen tidak ditemukan!']);
        }
    }
    

    public function getDocument()
    {
        $documents = DocumentModel::whereIn('give_access_to', ['0', '50'])
            ->orWhere('give_access_to', 'LIKE', '%1%')
            ->orderBy('created_at', 'desc')
            ->get();

        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();

        return view('document-view', ['documents' => $documents, 'uploadedUsers' => $uploadedUsers]);
    }

    public function getDocumentDetail($id)
    {
        $document = DocumentModel::find($id);

        if (!$document) {
            return redirect()->route('viewdocument')->with('error', 'Document not found!');
        }

        $requestedType = $document->tipe_dokumen;
        $requestedStatus = $document->status;

        $similarDocuments = DocumentModel::where('tipe_dokumen', $requestedType)
            ->where('give_access_to', 'LIKE', ['0', '50'])
            ->where('id', '!=', $id)
            ->get();

        $similarDocumentsNotActive = DocumentModel::where('tipe_dokumen', $requestedType)
            ->where('status', 'Tidak Berlaku')
            ->where('give_access_to', 'LIKE', ['0', '50'])
            ->where('id', '!=', $id)
            ->get();

        $similarDocuments = $similarDocuments->merge($similarDocumentsNotActive);

        $uploadedUser = User::find($document->created_by);

        return view('document-detail', ['document' => $document, 'uploadedUser' => $uploadedUser, 'similarDocuments' => $similarDocuments]);
    }
}
