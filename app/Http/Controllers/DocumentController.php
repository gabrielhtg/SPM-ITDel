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
       
        $documents = DocumentModel::all();
        
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

    // public function getDocumentManagement()
    // {
    //     if (Auth::check()) {
    //         $documents = DocumentModel::where('created_by', auth()->user()->id)->get();
    //         $jenis_dokumen = DocumentTypeModel::all();
    //     } else {
    //         $documents = DocumentModel::where('give_access_to', 0)->get();
    //     }

    //     $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
    //     $jenis_dokumen = DocumentTypeModel::all();
    //     $roles = RoleModel::all();

    //     $data = [
    //         'documents' => $documents,
    //         'uploadedUsers' => $uploadedUsers,
    //         'jenis_dokumen' => $jenis_dokumen,
    //         'roles' => $roles,
    //     ];

    //     return view('document-management', $data);
    // }

    public function getDocumentManagementAdd()
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
        return view('components/upload-file-modal', $data);
    }
    public function getDocumentManagementEdit($id)
    {
        // Temukan dokumen berdasarkan ID
        $document = DocumentModel::find($id);
    
        // Periksa apakah dokumen ditemukan
        if ($document) {
            // Periksa izin pengguna yang sedang masuk
            if (Auth::check()) {
                // Jika pengguna masuk, dapatkan dokumen yang dibuat oleh pengguna itu sendiri
                $documents = DocumentModel::where('created_by', auth()->user()->id)->get();
                $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
            } else {
                // Jika pengguna tidak masuk, dapatkan dokumen yang diakses oleh semua pengguna
                $documents = DocumentModel::where('give_access_to', 0)->get();
                $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
            }
    
            $jenis_dokumen = DocumentTypeModel::all();
            $roles = RoleModel::all();
    
            $data = [
                'document' => $document,
                'documents' => $documents, // Menambahkan variabel $documents ke dalam array data
                'uploadedUsers' => $uploadedUsers,
                'jenis_dokumen' => $jenis_dokumen,
                'roles' => $roles,
            ];
    
            return view('components/edit-file-modal', $data);
        } else {
            // Dokumen tidak ditemukan, arahkan pengguna kembali ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->with('toastData', ['success' => false, 'text' => 'Dokumen tidak ditemukan!']);
        }
    }
    

public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
            'nomor_dokumen' => 'required|unique:documents,nomor_dokumen',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
            'tipe_dokumen' => 'required',
            'can_see_by' => 'required',
           
            'link' => ['nullable', 'url'],
        ], [
            'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.before' => 'Tanggal mulai harus lebih kecil dari tanggal akhir.',
            'end_date.required' => 'Tanggal akhir harus diisi.',
            'tipe_dokumen.required' => 'Tipe dokumen harus diisi.',
            'can_see_by.required' => 'Pilihan untuk dapat dilihat atau tidak harus dipilih.',
            
            'link.url' => 'Link dokumen tidak valid.'
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
    
        // Set status based on menggantikan_dokumen
        $status = $request->menggantikan_dokumen ? false : true;
    
        // Convert array to string for 'give_access_to' column
        $giveAccessTo = $request->input('give_access_to', []);
        $accessor = is_array($giveAccessTo) ? implode(';', $giveAccessTo) : $giveAccessTo;
    
        // Convert array to string for 'menggantikan_dokumen' column
        $menggantikanDokumen = $request->input('menggantikan_dokumen', []);
        $menggantikanDokumenImploded = is_array($menggantikanDokumen) ? implode(',', $menggantikanDokumen) : $menggantikanDokumen;
    
        // Create document record
        $document = DocumentModel::create([
            'name' => $request->name,
            'nama_dokumen' => $filename,
            'nomor_dokumen' => $request->nomor_dokumen,
            'deskripsi' => $request->deskripsi,
            'directory' => '/src/documents/' . $filename,
            'created_by' => auth()->user()->id,
            'status' => $status,
            'menggantikan_dokumen' => $menggantikanDokumenImploded,
            'year' => $request->year,
            'tipe_dokumen' => $request->tipe_dokumen,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'keterangan_status' => true, // Set to default value, will be updated based on start_date and end_date
            'give_access_to' => $accessor,
            'can_see_by' => $request->can_see_by,
            'link' => $request->link,
        ]);
    
        // Update keterangan_status based on start_date and end_date
        $currentDateTime = now();
        if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
            $document->keterangan_status = true;
        }
    
        $document->save();
    
        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'File berhasil diunggah!']);
    }


    public function updateDocument(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_dokumen' => [
                'required',
                Rule::unique('documents')->ignore($id),
            ],
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
            'tipe_dokumen' => 'required',
            'can_see_by' => 'required',
           
            'link' => ['nullable', 'url'],
        ], [
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.before' => 'Tanggal mulai harus lebih kecil dari tanggal akhir.',
            'end_date.required' => 'Tanggal akhir harus diisi.',
            'tipe_dokumen.required' => 'Tipe dokumen harus diisi.',
            'can_see_by.required' => 'Pilihan untuk dapat dilihat atau tidak harus dipilih.',
            
            'link.url' => 'Link dokumen tidak valid.'
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('documentManagement', $id)->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }
    
        // Find the document
        $document = DocumentModel::findOrFail($id);
    
        // Update document data
        $document->update([
            'nomor_dokumen' => $request->nomor_dokumen,
            'deskripsi' => $request->deskripsi,
            'status' => $request->has('menggantikan_dokumen') ? false : true,
            'year' => $request->year,
            'tipe_dokumen' => $request->tipe_dokumen,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'give_access_to' => implode(';', $request->input('give_access_to', [])),
            'can_see_by' => $request->can_see_by ?? $document->can_see_by, // Menyesuaikan agar nilai default dipertahankan jika tidak ada input yang diberikan
            'link' => $request->link,
        ]);
    
        // Update keterangan_status based on start_date and end_date
        $currentDateTime = now();
        if ($request->start_date <= $currentDateTime && (!$request->end_date || $request->end_date >= $currentDateTime)) {
            $document->keterangan_status = true;
        } else {
            $document->keterangan_status = false;
        }
    
        $document->save();
    
        return redirect()->route('documentManagement', $id)->with('toastData', ['success' => true, 'text' => 'File berhasil diperbarui!']);
    }
    
    
    
    

    

    
    public function removeDocument(Request $request)
    {
        $document = DocumentModel::find($request->id);
        File::delete(public_path($document->directory));
        $document->delete();

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Dokumen berhasil dihapus!']);
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
