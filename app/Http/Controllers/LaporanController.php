<?php

namespace App\Http\Controllers;

use App\Models\AccountableModel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\JenisLaporan;
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


    $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();

    $id_user = auth()->user()->role;
    $role = RoleModel::find($id_user);
    $document = $role->required_to_submit_document;
    
   
    $documentIds = explode(';', $document);

   
    $tipe_laporan = JenisLaporan::whereIn('id_tipelaporan', $documentIds)->get();
    

    $data = [
        'uploadedUsers' => $uploadedUsers,
        'roles' => $role,
        'active_sidebar' => [5, 1],  
        'laporan' => $laporan,
        'tipe_laporan' => $tipe_laporan,
        
    ];

    return view('laporan-manajemen-add', $data);
}


    

public function getLaporanManagementReject()
{
    if (auth()->check()) {
        $userId = auth()->user()->role;
        $role = RoleModel::find($userId);

        if ($role) {
            $laporan= Laporan::all();
            $banyakData = 0; // Inisialisasi variabel banyakData
            
            foreach($laporan as $item){
                if(($item->status ==='Menunggu')&&(app(AllServices::class)->isAccountableToRole(auth()->user()->role,app(AllServices::class)->getUserRoleById($item->created_by)))){
                    $banyakData++; // Update nilai banyakData
                }
            };
            
        
            $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();
            $tipe_laporan = TipeLaporan::all();
            // dd($accountableModel);
            // dd($banyakData);

            $data = [
                'uploadedUsers' => $uploadedUsers,
                'roles' => $role,
                'active_sidebar' => [5, 2],  
                'laporan' => $laporan,
                'tipe_laporan' => $tipe_laporan,
                'banyakData' => $banyakData,
            ];

            return view('laporan-manajemen-reject', $data);
        }
    }

    return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini');
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
    
       
        $id_user = auth()->user()->role;
        $role = RoleModel::find($id_user);
       
        
       
        
        
     
      
       
        
       
        Laporan::create([
            'id_tipelaporan' => $request->id_tipelaporan,
            'nama_laporan' => $request->nama_laporan,
            'directory' => $file ? '/src/documents/'.$fileName : null,
            'created_by' => auth()->user()->id,
            'revisi' => $request->revisi ?? false,
        ]);
       
    
        return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => true, 'text' => 'Laporan berhasil diunggah!']);
    }
    
    public function approve($id)
    {   
        $nowDate = Carbon::now();
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'Disetujui'; 
        $laporan->approve_at = $nowDate;
        $laporan->direview_oleh = auth()->user()->id;
        $laporan->save();

        return redirect()->back()->with('toastData', ['success' => true, 'text' => 'Laporan Disetuji!']);
    }


public function reject($id)
{
    $nowDate = Carbon::now();
    $laporan = Laporan::findOrFail($id);
    $laporan->status = 'Ditolak'; 
    $laporan->reject_at = $nowDate;
    $laporan->direview_oleh = auth()->user()->id;
    $laporan->save();

    return redirect()->back()->with('toastData', ['success' => true, 'text' => 'Laporan Ditolak!']);
}


    


}
