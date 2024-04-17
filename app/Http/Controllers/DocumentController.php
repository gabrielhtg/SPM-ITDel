<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\DocumentTypeModel;
use App\Models\JenisLaporan;
use App\Models\LaporanTypeModel;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\HeroDocument;
use Illuminate\Support\Str;
use App\Models\User;
use Symfony\Component\HttpFoundation\File\Exception\IniSizeFileException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class DocumentController extends Controller
{
    public function getDocumentManagementView()
    {
        // Ambil 10 dokumen terbaru
        $documents = DocumentModel::all();

        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
        $jenis_dokumen = DocumentTypeModel::all();
        $roles = RoleModel::all();
        $documenthero = HeroDocument::first();
        $documentheroIds = $documenthero->pluck('id');


        // dd($documenthero);
        $data = [
            'documents' => $documents,
            'uploadedUsers' => $uploadedUsers,
            'jenis_dokumen' => $jenis_dokumen,
            'roles' => $roles,
            'active_sidebar' => [6, 0],
            'documenthero'=> $documenthero,
            'documentheroIds' => $documentheroIds,
        ];

        return view('document-management', $data);
    }

    public function getDocumentManagementViewAll()
    {

        $documents = DocumentModel::orderBy('created_at', 'desc')->get();
        $documenthero = HeroDocument::all();
        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
        $jenis_dokumen = DocumentTypeModel::all();
        $roles = RoleModel::all();


        $data = [
            'documents' => $documents,
            'uploadedUsers' => $uploadedUsers,
            'jenis_dokumen' => $jenis_dokumen,
            'roles' => $roles,
            'documenthero'=>$documenthero,

        ];

        return view('document-view-all', $data);
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
            'active_sidebar' => [0, 0]
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
                'active_sidebar' => [0, 0]
            ];

            return view('components/edit-file-modal', $data);
        } else {
            // Dokumen tidak ditemukan, arahkan pengguna kembali ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->with('toastData', ['success' => false, 'text' => 'Dokumen tidak ditemukan!']);
        }
    }


    public function uploadFile(Request $request)
{
    $editor = null;
    $parent = null;
    $accessor = null;
    $menggantikanDokumenImploded = null; // Definisikan variabel sebelum penggunaan

    $validator = Validator::make($request->all(), [
        'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
        'nomor_dokumen' => 'required|unique:documents,nomor_dokumen',
        'start_date' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->filled('end_date')) {
                    if ($value >= $request->input('end_date')) {
                        $fail('Tanggal mulai harus lebih kecil dari tanggal akhir.');
                    }
                }
            }
        ],
        'tipe_dokumen' => 'required',
        'can_see_by' => 'required',
        'link' => ['nullable', 'url'],
        'menggantikan_dokumen' => [
            // Validasi tambahan untuk memastikan bahwa dokumen yang digantikan memiliki tipe dokumen yang sama
            function ($attribute, $value, $fail) use ($request) {
                if (is_array($value)) {
                    foreach ($value as $documentId) {
                        $dokumenYangDigantikan = DocumentModel::find($documentId);
                        if ($dokumenYangDigantikan && $dokumenYangDigantikan->tipe_dokumen != $request->tipe_dokumen) {
                            $fail('Dokumen yang digantikan harus memiliki tipe dokumen yang sama.');
                        }
                    }
                }
            },
        ],
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

    // Upload file and process document data storage if file is provided
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $documentType = DocumentTypeModel::find($request->tipe_dokumen);
        $documentTypeAbbreviation = $documentType ? $documentType->singkatan : '';
        $nameWithoutSpaces = str_replace(' ', '_', $request->name);

        // Mendapatkan ekstensi file
        $fileExtension = $file->getClientOriginalExtension();

        // Membentuk nama file dengan ekstensi
        $filename = $documentTypeAbbreviation . '_' . $nameWithoutSpaces . '.' . $fileExtension;

        // Set status based on menggantikan_dokumen
        // $status = $request->menggantikan_dokumen ? false : true;

        // Convert array to string for 'give_access_to' column


        // Simpan file dengan nama baru
        $file->move(public_path('/src/documents/'), $filename);
    } else {
        // If no file is provided, set filename and directory to null
        $filename = null;
    }
    $giveAccessTo = $request->input('give_access_to', []);
    $accessor = is_array($giveAccessTo) ? implode(';', $giveAccessTo) : $giveAccessTo;

    $giveEditTo = $request->input('give_edit_access_to', []);
    $editor = is_array($giveEditTo) ? implode(';', $giveEditTo) : $giveEditTo;

    // Convert array to string for 'menggantikan_dokumen' column
    $menggantikanDokumen = $request->input('menggantikan_dokumen', []);
    $menggantikanDokumenImploded = is_array($menggantikanDokumen) ? implode(',', $menggantikanDokumen) : $menggantikanDokumen;

    // Jika ada dokumen yang digantikan, tentukan parent
    if (!empty($menggantikanDokumen)) {
        $dokumenYangDigantikanId = end($menggantikanDokumen);
        $dokumenYangDigantikan = DocumentModel::find($dokumenYangDigantikanId);
        if ($dokumenYangDigantikan) {
            // Jika parent dari dokumen yang digantikan adalah null, ambil parent dari dokumen yang digantikan
            $parent = $dokumenYangDigantikan->parent ?? $dokumenYangDigantikan->id;
        }
    }

    $document = DocumentModel::create([
        'name' => $request->name,
        'nama_dokumen' => $filename ?? 'default_filename.pdf', // Pastikan nilai default yang sesuai jika $filename null
        'nomor_dokumen' => $request->nomor_dokumen,
        'deskripsi' => $request->deskripsi,
        'directory' => $filename ? '/src/documents/' . $filename : null,
        'created_by' => auth()->user()->id,
        // 'status' => $status,
        'menggantikan_dokumen' => $menggantikanDokumenImploded,
        'parent' => $parent,
        'year' => $request->year,
        'tipe_dokumen' => $request->tipe_dokumen,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'keterangan_status' => true,
        'give_access_to' => $accessor ?? 'default_user', // Pastikan nilai default yang sesuai jika $accessor null
        'give_edit_access_to' => $editor,
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
    // Validasi data masukan
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'nomor_dokumen' => [
            'required'
        ],
        'start_date' => ['required', 'date', $request->input('end_date') ? 'before:end_date' : ''],
        'tipe_dokumen' => 'required',
        'can_see_by' => 'required',
        'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
        'link' => ['nullable', 'url'],
        'menggantikan_dokumen.*' => [
            // Validasi tambahan untuk memastikan bahwa dokumen yang digantikan memiliki tipe dokumen yang sama
            function ($attribute, $value, $fail) use ($request) {
                if ($value) {
                    $dokumenYangDigantikan = DocumentModel::find($value);
                    if ($dokumenYangDigantikan && $dokumenYangDigantikan->tipe_dokumen != $request->tipe_dokumen) {
                        $fail('Dokumen yang digantikan harus memiliki tipe dokumen yang sama.');
                    }
                }
            },
        ],
    ], [
        'name.required' => 'Nama dokumen harus diisi.',
        'start_date.required' => 'Tanggal mulai harus diisi.',
        'start_date.before' => 'Tanggal mulai harus lebih kecil dari tanggal akhir.',
        'tipe_dokumen.required' => 'Tipe dokumen harus diisi.',
        'can_see_by.required' => 'Pilihan untuk dapat dilihat atau tidak harus dipilih.',
        'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
        'link.url' => 'Link dokumen tidak valid.',
    ]);

    // Jika validasi gagal, kembalikan dengan pesan kesalahan
    if ($validator->fails()) {
        return redirect()->route('documentManagement', $id)->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
    }

    // Cari dokumen yang akan diperbarui
    $document = DocumentModel::findOrFail($id);

    // Hapus file lama jika ada
    if ($request->hasFile('file') && $document->directory) {
        // Hapus file lama dari sistem penyimpanan
        if (File::exists(public_path($document->directory))) {
            File::delete(public_path($document->directory));
        }

        // Setel direktori dokumen menjadi null karena file lama dihapus
        $document->directory = null;
        $document->nama_dokumen = null;
    }

    if ($request->hasFile('file')) {
        // Lakukan pengungahan file baru
        $file = $request->file('file');
        $documentType = DocumentTypeModel::find($request->tipe_dokumen);
        $documentTypeAbbreviation = $documentType ? $documentType->singkatan : '';
        $nameWithoutSpaces = Str::slug($request->name);

        // Mendapatkan ekstensi file
        $fileExtension = $file->getClientOriginalExtension();

        // Membentuk nama file baru dengan ekstensi
        $filename = $documentTypeAbbreviation . '_' . $nameWithoutSpaces . '.' . $fileExtension;

        // Simpan file dengan nama baru
        $file->move(public_path('/src/documents/'), $filename);

        // Setel nama dan direktori dokumen baru
        $document->nama_dokumen = $filename;
        $document->directory = '/src/documents/' . $filename;
    }

    // Update keterangan_status jika ada perubahan
    if ($request->has('keterangan_status')) {
        $document->keterangan_status = $request->keterangan_status;
        if ($request->keterangan_status == false) {
            $document->end_date = Carbon::now();
        }
    }

    // Lanjutkan dengan penanganan atribut lainnya
    $document->name = $request->name;
    $document->nomor_dokumen = $request->nomor_dokumen;
    $document->deskripsi = $request->deskripsi;
    $document->year = $request->year;
    $document->tipe_dokumen = $request->tipe_dokumen;
    $document->start_date = $request->start_date;
    $document->end_date = $request->end_date;
    $document->give_access_to = implode(';', $request->input('give_access_to', []));
    $document->give_edit_access_to = implode(';', $request->input('give_edit_access_to', []));
    $document->can_see_by = $request->can_see_by ?? $document->can_see_by;
    $document->link = $request->link;

    // Menentukan parent jika ada dokumen yang digantikan
    $menggantikanDokumen = $request->input('menggantikan_dokumen', []);
    $menggantikanDokumenImploded = is_array($menggantikanDokumen) ? implode(',', $menggantikanDokumen) : $menggantikanDokumen;
    $document->menggantikan_dokumen = $menggantikanDokumenImploded;

    if (!empty($menggantikanDokumen)) {
        $dokumenYangDigantikanId = end($menggantikanDokumen);
        $dokumenYangDigantikan = DocumentModel::find($dokumenYangDigantikanId);
        if ($dokumenYangDigantikan) {
            // Jika parent dari dokumen yang digantikan adalah null, ambil parent dari dokumen yang digantikan
            $document->parent = $dokumenYangDigantikan->parent ?? $dokumenYangDigantikan->id;
        }
    }

    // Simpan perubahan ke database
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
            ->take(10) // Mengambil hanya 10 dokumen
            ->get();

        $uploadedUsers = User::whereIn('id', $documents->pluck('created_by'))->get();
        $documenthero = HeroDocument::all();

        return view('document-view', ['documents' => $documents, 'uploadedUsers' => $uploadedUsers,'documenthero'=> $documenthero]);
    }


    public function getDocumentDetail($id)
    {
        $document = DocumentModel::find($id);
        $jenis_dokumen = DocumentTypeModel::all();
        $uploadedUser = User::find($document->created_by);
        $documenthero = HeroDocument::all();

        // Mengembalikan tampilan dengan melewatkan data $jenis_dokumen
        return view('document-detail', [
            'document' => $document,
            'uploadedUser' => $uploadedUser,
            'jenis_dokumen' => $jenis_dokumen,
            'documenthero'=> $documenthero
            // Melewatkan data jenis_dokumen ke tampilan
        ]);
    }

    public function getDocumentDetailReplaced($id)
    {
        $document = DocumentModel::find($id);
        $jenis_dokumen = DocumentTypeModel::all();
        $uploadedUser = User::find($document->created_by);
        $documenthero = HeroDocument::all();

        $data = [
            'document' => $document,
            'uploadedUser' => $uploadedUser,
            'jenis_dokumen' => $jenis_dokumen,
            'documenthero'=> $documenthero
        ];

        return view('document-replaced-all', $data);
    }

    public function getviewLaporanType()
    {
        $tipe_laporan = LaporanTypeModel::all();
        $active_sidebar = [1, 1]; // Mengatur nilai untuk $active_sidebar


        return view('components/view-tipe-laporan', compact('tipe_laporan', 'active_sidebar'));
    }

    public function viewLaporanJenis()
    {
        $jenis_laporan = JenisLaporan::all();
        $type_laporan =TipeLaporan::all();
        $active_sidebar = [1, 1]; // Mengatur nilai untuk $active_sidebar

        $data = [
            'type_laporan'=>$type_laporan,
            'jenis_laporan'=>$jenis_laporan,

        ];


        return view('components/view-jenis-laporan',$data, compact( 'active_sidebar'));
    }







}
