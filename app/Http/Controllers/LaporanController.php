<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\Laporan;
use App\Services\AllServices;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Validator;
class LaporanController extends Controller
{
    //
    public function getLaporanManagementView()
{
    
    $laporan = Laporan::all();

    
    $banyakData = Laporan::whereNull('status')
                         ->where('tujuan', [auth()->user()->role])
                          ->count();
   
    $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();


    $tipe_laporan = TipeLaporan::all();

    $roles = RoleModel::all();

   
    $data = [
        'uploadedUsers' => $uploadedUsers,
        'roles' => $roles,
        'active_sidebar' => [5, 1],  
        'laporan' => $laporan,
        'tipe_laporan' => $tipe_laporan,
        'banyakData' => $banyakData,
    ];

    
    return view('laporan-manajemen-add', $data);
}

    

    public function getLaporanManagementReject()
    {
        // Ambil 10 dokumen terbaru
        $laporan = Laporan::with('tipeLaporan');

        $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();
    
        $roles = RoleModel::all();


        // dd($documenthero);
        $data = [
            'uploadedUsers' => $uploadedUsers,
            'roles' => $roles,
            'active_sidebar' => [5, 2],  
            'laporan'=>$laporan,
            
        ];

        return view('laporan-manajemen-reject', $data);
    }

    public function addLaporan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
            'id_tipelaporan' => 'required',
           
        ], [
            'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
            'id_tipelaporan.required' => 'Pilih tipe laporan.',
            'nama_laporan.required' => 'Nama laporan harus diisi.',
            'nama_laporan.max' => 'Nama laporan tidak boleh melebihi 255 karakter.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
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
        $id_user = auth()->user()->role;
        $role = RoleModel::find($id_user);
        $id_atasan = $role->atasan_id;
        $allservice = new AllServices();
        $tujuan = $allservice->getResponsibleTo($id_atasan);
       
        
       
        Laporan::create([
            'id_tipelaporan' => $request->id_tipelaporan,
            'nama_laporan' => $request->nama_laporan,
            'directory' => $file ? '/src/documents/'.$fileName : null,
            'created_by' => auth()->user()->id,
            'revisi' => $request->revisi ?? false,
            'tujuan' => $tujuan,
        ]);
       
    
        return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => true, 'text' => 'Laporan berhasil diunggah!']);
    }
    
    public function approve($id)
    {   
        $nowDate = Carbon::now();
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 1; 
        $laporan->approve_at = $nowDate;
        $laporan->direview_oleh = auth()->user()->id;
        $laporan->save();

        return redirect()->back()->with('toastData', ['success' => true, 'text' => 'Laporan Disetuji!']);
    }


public function reject($id)
{
    $nowDate = Carbon::now();
    $laporan = Laporan::findOrFail($id);
    $laporan->status = 0; 
    $laporan->reject_at = $nowDate;
    $laporan->direview_oleh = auth()->user()->id;
    $laporan->save();

    return redirect()->back()->with('toastData', ['success' => true, 'text' => 'Laporan Ditolak!']);
}


    


}
