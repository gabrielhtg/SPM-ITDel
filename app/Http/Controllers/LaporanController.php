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


    $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();

    $id_user = auth()->user()->role;
    $role = RoleModel::find($id_user);
    $document = $role->required_to_submit_document;
    
   
    $documentIds = explode(';', $document);

   
    $tipe_laporan = TipeLaporan::whereIn('id', $documentIds)->get();

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
            $id_user = auth()->user()->role;
            $role = RoleModel::find($id_user);
            if ($role) {
                
                $laporan = Laporan::all();
                $banyakData = Laporan::where('status', "Menunggu")
                    ->where(function($query) use ($role) {
                        
                        $query->where('accountable_to', 'like', '%' . $role->id . '%');
                    })
                    ->count();
                    // dd($banyakData);
                $uploadedUsers = User::whereIn('id', $laporan->pluck('created_by'))->get();
                $document = $role->required_to_submit_document;
                $documentIds = explode(';', $document);
                $tipe_laporan = TipeLaporan::whereIn('id', $documentIds)->get();

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
       
        $id_atasan = $role->atasan_id;
        $allservice = new AllServices();
        $tujuan = $allservice->getResponsibleTo($id_atasan);
        
        
     
        $accountable_to=$role->accountable_to;
        // dd($accountable_to);
        $informable_to=$role->informable_to;
       
        
       
        Laporan::create([
            'id_tipelaporan' => $request->id_tipelaporan,
            'nama_laporan' => $request->nama_laporan,
            'directory' => $file ? '/src/documents/'.$fileName : null,
            'created_by' => auth()->user()->id,
            'revisi' => $request->revisi ?? false,
            'tujuan' => $tujuan,
            'accountable_to'=>$accountable_to,
            'informable_to'=>$informable_to,
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
