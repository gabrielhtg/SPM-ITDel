<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\Laporan;

use Illuminate\Support\Facades\Validator;
class LaporanController extends Controller
{
    //
    public function getLaporanManagementView()
    {
        // Ambil 10 dokumen terbaru
        $laporan = Laporan::all();

        $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();
        $tipe_laporan = TipeLaporan::all();
        $roles = RoleModel::all();


        // dd($documenthero);
        $data = [
            'uploadedUsers' => $uploadedUsers,
            'roles' => $roles,
            'active_sidebar' => [5, 1],  
            'laporan'=>$laporan,
            'tipe_laporan'=>$tipe_laporan,
        ];

        return view('laporan-manajemen-add', $data);
    }

    public function getLaporanManagementReject()
    {
        // Ambil 10 dokumen terbaru
        $laporan = Laporan::all();

        $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();
        $tipe_laporan = TipeLaporan::all();
        $roles = RoleModel::all();


        // dd($documenthero);
        $data = [
            'uploadedUsers' => $uploadedUsers,
            'roles' => $roles,
            'active_sidebar' => [5, 2],  
            'laporan'=>$laporan,
            'tipe_laporan'=>$tipe_laporan,
        ];

        return view('laporan-manajemen-reject', $data);
    }

    public function addLaporan(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
        'id_tipelaporan' => 'required',
        'nama_laporan' => 'required|max:255',
        'tujuan' => 'required',
    ], [
        'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
        'id_tipelaporan.required' => 'Pilih tipe laporan.',
        'nama_laporan.required' => 'Nama laporan harus diisi.',
        'nama_laporan.max' => 'Nama laporan tidak boleh melebihi 255 karakter.',
        'tujuan.required' => 'Tujuan laporan harus diisi.',
    ]);

    if ($validator->fails()) {
        return redirect()->route('laporanManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
    }

    // Proses unggah file jika ada
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = uniqid('laporan_').'.'.$fileExtension;

        // Simpan file di folder public/src/documents
        $file->move(public_path('src/documents'), $fileName);
    }

    // Tangani pilihan tujuan laporan
    $giveRequestTo = $request->input('tujuan', []);
    $accessor = is_array($giveRequestTo) ? implode(';', $giveRequestTo) : $giveRequestTo;

    // Simpan data laporan ke database
    $laporan = Laporan::create([
        'id_tipelaporan' => $request->id_tipelaporan,
        'nama_laporan' => $request->nama_laporan,
        'directory' => $file ? '/src/documents/'.$fileName : null,
        'created_by' => auth()->user()->id,
        'revisi' => $request->revisi ?? false,
        'tujuan' => $accessor,
    ]);

    return redirect()->route('LaporanManagementAdd')->with('success', 'Laporan berhasil ditambahkan.');
}


}
