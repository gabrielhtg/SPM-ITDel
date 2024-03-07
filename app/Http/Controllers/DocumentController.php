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
        'roles' => $roles,
        'documents' => $documents,
        'uploadedUsers' => $uploadedUsers,
        'jenis_dokumen' => $jenis_dokumen,
    ];

    return view('document-management', $data);
}



    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
            'nomor_dokumen' => 'required|unique:documents,nomor_dokumen',
            'status' => 'required|in:Berlaku,Tidak Berlaku',
            'expried_date' => 'nullable|date',
            'menggantikan_dokumen' => 'nullable',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'deskripsi' => 'nullable',
            'tipe_dokumen' => 'required',
            'can_see_by' => 'required|in:Public,Private',
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
            'keterangan_status' => $request->keterangan_status,
            'give_access_to' => $accessor,
            'can_see_by' => $request->can_see_by,
            
        ]);

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'File berhasil diunggah!']);
    }


    public function removeDocument(Request $request)
    {
        $document = DocumentModel::find($request->id);
        File::delete(public_path($document->directory));
        $document->delete();

        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Document deleted successfully!']);
    }

    public function updateDocument(Request $request)
    {
        if ($request->hasFile('file')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
            ]);

            if ($validator->fails()) {
                return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Ukuran file melebihi batas maksimum 30 MB.']);
            }
        }

        $validator = Validator::make($request->all(), [
            'nomor_dokumen' => [
                'required',
                Rule::unique('documents', 'nomor_dokumen')->ignore($request->id),
            ],
        ], [
            'nomor_dokumen.unique' => 'Nomor dokumen sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => 'Nomor dokumen sudah digunakan.']);
        }

        $document = DocumentModel::find($request->id);

        if ($document) {
            if ($request->hasFile('file')) {
                if ($document->directory) {
                    File::delete(public_path($document->directory));
                }

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

            $document->name = $request->name;
            $document->nomor_dokumen = $request->nomor_dokumen;
            $document->status = $request->status;
            $document->year = $request->year;
            $document->tipe_dokumen = $request->tipe_dokumen;
            $document->expried_date = $request->expried_date;
            $document->menggantikan_dokumen = $request->menggantikan_dokumen;
            $document->start_date = $request->start_date;
            $document->end_date = $request->end_date;
            $document->deskripsi = $request->deskripsi;
            $document->give_access_to = implode(';', $request->give_access_to);
            $document->can_see_by = $request->can_see_by;
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
