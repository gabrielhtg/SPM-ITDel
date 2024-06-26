<?php

namespace App\Http\Controllers;

use App\Models\AccountableModel;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\JenisLaporan;
use App\Models\LogLaporan;
use App\Models\Laporan;
use App\Models\NotificationModel;
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

    $tipe_laporan = app(AllServices::class)->getJenisLaporanWithoutLog(auth()->user()->id);

   
    $type_laporan =TipeLaporan::all();
    $jenis_laporan =JenisLaporan::all();


    $data = [
        'uploadedUsers' => $uploadedUsers,
        'roles' => $role,
        'active_sidebar' => [6, 1],
        'laporan' => $laporan,
        'tipe_laporan' => $tipe_laporan,
        'type_laporan'=>$type_laporan,
        'jenis_laporan'=>$jenis_laporan,

    ];

    return view('laporan-manajemen-add', $data);
}

public function getLogLaporanView()
{
    $tipe_laporan = TipeLaporan::all();

    $data = [
        'active_sidebar' => [6, 3],
        'tipe_laporan' => $tipe_laporan,
    ];
    return view('log-laporan-view', $data);
}
public function getJenisLaporanView($id)
{
    $jenis_laporan = JenisLaporan::where('id_tipelaporan', $id)
                                  ->orderByDesc('end_date')
                                  ->get();

    $data = [
        'active_sidebar' => [6, 3],
        'jenis_laporan' => $jenis_laporan,
    ];
    // dd($jenis_laporan);
    return view('laporan-jenis', $data);
}



    public function getLogLaporanContinue($id){
        $log = LogLaporan::where('id_jenis_laporan',$id)->get();
        $data = [
            'active_sidebar' => [6, 3],
            'log'=>$log
        ];
        return view('log-laporan-continue', $data);
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
                if(($item->status ==='Menunggu')&&(app(AllServices::class)->isAccountableToRoleLaporan(auth()->user()->role,app(AllServices::class)->getUserRoleById($item->created_by)))){
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
                'active_sidebar' => [6, 2],
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
            'cek_revisi'=>'nullable',
            'revisi' => 'nullable', 


        ], [
            'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
            'id_tipelaporan.required' => 'Pilih tipe laporan.',
            'nama_laporan.required' => 'Nama laporan harus diisi.',
            'nama_laporan.max' => 'Nama laporan tidak boleh melebihi 255 karakter.',
        ]);

        // dd($request->cek_revisi);
        // dd($request->id_tipelaporan);

        if ($validator->fails()) {
            return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }
        if ($request->has('revisi') && $request->id_tipelaporan != $request->cek_revisi) {
            return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => false, 'text' => 'Kategori Tipe Laporan harus sama dengan Kategori Laporan yang Direvisi']);
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
            'cek_revisi'=>$request->cek_revisi,
            'nama_laporan' => $request->nama_laporan,
            'directory' => $file ? '/src/documents/'.$fileName : null,
            'created_by' => auth()->user()->id,
            'revisi' => $request->revisi ?? false,
        ]);

        $iduser = auth()->user()->id;
        $user = User::findOrFail($iduser);
        
        $accountable = AccountableModel::where('role', $user->role)->first();
        $roleId = $accountable->role; // Ganti dengan id peran yang diinginkan
        
        // Ambil semua nilai accountable_to berdasarkan roleId
        $accountableTos = AccountableModel::where('role', $roleId)->pluck('accountable_to')->toArray();
        
        // Buat array unik dari semua nilai accountable_to
        $allAccountableTo = [];
        foreach ($accountableTos as $accountableTo) {
            $allAccountableTo = array_merge($allAccountableTo, explode(';', $accountableTo));
        }
        $allAccountableTo = array_unique($allAccountableTo);
        
        // Ambil semua user
        $allUsers = User::all();
        
        // Filter user yang memiliki peran yang termasuk dalam nilai accountable_to yang unik
        $filteredUsers = $allUsers->filter(function ($user) use ($allAccountableTo) {
            $userRoles = explode(';', $user->role);
            foreach ($userRoles as $role) {
                if (in_array($role, $allAccountableTo)) {
                    return true;
                }
            }
            return false;
        });
        
        // Buat notifikasi untuk setiap user yang terfilter
        foreach ($filteredUsers as $filteredUser) {
            NotificationModel::create([
                'message' => "Permintaan untuk memeriksa laporan dari " . $user->name . ".",
                'ref_link' => "LaporanManagementReject",
                'clicked' => false,
                'to' => $filteredUser->id,
            ]);
        }
        
        


        $jenis_laporan = JenisLaporan::where('id',$request->id_tipelaporan)->first();
        $tipe_laporan = TipeLaporan::where('id',$jenis_laporan->id_tipelaporan)->first();
     

        AllServices::addLog(sprintf("%s Menambahkan %s %s(%d) ", $user->name,$tipe_laporan->nama_laporan,$jenis_laporan->nama,$jenis_laporan->year));
        return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => true, 'text' => 'Laporan berhasil diunggah!']);
    }

    public function approve($id)
    {
        $nowDate = Carbon::now();
        $laporan = Laporan::findOrFail($id);
        $tipeLaporan = JenisLaporan::findOrFail($laporan->id_tipelaporan);
        $create_at = $laporan->created_at;
        $approve_at = $laporan->approve_at;
    
        // Update status laporan
        $laporan->status = 'Disetujui';
        $laporan->approve_at = $nowDate;
        $laporan->direview_oleh = auth()->user()->id;
        $laporan->save();
    
        // Bandingkan tanggal laporan dengan tanggal awal periode pada jenis laporan
        $carbonStartDate = $tipeLaporan->end_date;
        $carbonCreateDate = $laporan->created_at;
        
        // Tentukan status berdasarkan perbandingan tanggal
        $status = $carbonCreateDate->greaterThan($carbonStartDate) ? 'Terlambat' : 'Tepat Waktu';
    
        // Perbarui log laporan yang sesuai
        LogLaporan::where('id_jenis_laporan', $laporan->id_tipelaporan)
            ->where('upload_by', $laporan->created_by)
            ->update([
                'status' => $status,
                'approve_at' => $nowDate,
                'create_at' => $create_at,
            ]);

            $message = AllServices::getJenislaporanName($tipeLaporan->id_tipelaporan, $tipeLaporan->id)." "."Telah Disetujui oleh"." ".auth()->user()->name;
            NotificationModel::create([
                'message' =>$message,
                'ref_link' => "LaporanManagementAdd",
                'clicked' => false,
                'to' => $laporan->created_by,
            ]);

           
        $tipe_laporan = TipeLaporan::where('id',$tipeLaporan->id_tipelaporan)->first();
            $iduser = auth()->user()->id;
            $user = User::findOrFail($iduser);
            $createdby = User::findOrFail($laporan->created_by);
            AllServices::addLog(sprintf("%s Menyetujui %s %s(%d) dari %s ", $user->name,$tipe_laporan->nama_laporan,$tipeLaporan->nama,$tipeLaporan->year,$createdby->name));
        return redirect()->back()->with('toastData', ['success' => true, 'text' => 'Laporan Disetujui!']);
    }
    





public function reject(Request $request, $id)
{   
    $validator = Validator::make($request->all(), [
        'komentar' => 'required',
       
    ]);

    // Periksa jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput(); 
    }

    $laporan = Laporan::findOrFail($id);
    $laporan->status = 'Direview';
    $laporan->reject_at = now();
    $laporan->direview_oleh = auth()->user()->id;
    $laporan->komentar = $request->komentar; 

    // Proses file yang diunggah
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = uniqid('laporan_').'.'.$fileExtension;

        // Simpan file di folder public/src/documents
        $file->move(public_path('src/documents'), $fileName);

        // Atur nilai file_catatan
        $laporan->file_catatan ='/src/documents/'.$fileName;
    }

    $laporan->save();
    $tipeLaporan = JenisLaporan::findOrFail($laporan->id_tipelaporan);
    $message = AllServices::getJenislaporanName($tipeLaporan->id_tipelaporan, $tipeLaporan->id)." "."Telah Direview oleh"." ".auth()->user()->name."."." "."Silahkan melakukan Revisi.";
    NotificationModel::create([
        'message' =>$message,
        'ref_link' => "LaporanManagementAdd",
        'clicked' => false,
        'to' => $laporan->created_by,
    ]);

    $tipe_laporan = TipeLaporan::where('id',$tipeLaporan->id_tipelaporan)->first();
            $iduser = auth()->user()->id;
            $user = User::findOrFail($iduser);
            $createdby = User::findOrFail($laporan->created_by);
            AllServices::addLog(sprintf("%s Tidak Menyetujui %s %s(%d) dari %s ", $user->name,$tipe_laporan->nama_laporan,$tipeLaporan->nama,$tipeLaporan->year,$createdby->name));
    return redirect()->back()->with('toastData', ['success' => true, 'text' => 'Laporan Direvisi!']);
}





public function update(Request $request, $id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama_laporan' => 'required|max:255',
        'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:30720',
        'id_tipelaporan' => 'required',
        'cek_revisi'=>'nullable',
    ], [
        'file.max' => 'Ukuran file melebihi batas maksimum unggah 30 MB.',
        'id_tipelaporan.required' => 'Pilih tipe laporan.',
        'nama_laporan.required' => 'Nama laporan harus diisi.',
        'nama_laporan.max' => 'Nama laporan tidak boleh melebihi 255 karakter.',
    ]);

    // Jika validasi gagal, kembalikan ke halaman edit dengan pesan error
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Temukan laporan yang akan disunting
    $laporan = Laporan::findOrFail($id);

    // Proses unggah file jika ada
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = uniqid('laporan_').'.'.$fileExtension;

        // Simpan file di folder public/src/documents
        $file->move(public_path('src/documents'), $fileName);

        // Hapus file lama jika ada
        if ($laporan->directory) {
            // Gunakan fungsi unlink untuk menghapus file dari sistem file
            unlink(public_path($laporan->directory));
        }

        // Update dici baru pada laporan
        $laporan->directory = '/src/documents/'.$fileName;
    }

    // Update data laporan dengan data baru dari formulir
    $laporan->nama_laporan = $request->nama_laporan;
    $laporan->id_tipelaporan = $request->id_tipelaporan;
    $laporan->cek_revisi= $request->cek_revisi;

    $laporan->revisi = $request->revisi ?? false;
    $laporan->save();
    $jenis_laporan = JenisLaporan::where('id',$request->id_tipelaporan)->first();
    $tipe_laporan = TipeLaporan::where('id',$jenis_laporan->id_tipelaporan)->first();
    $iduser = auth()->user()->id;
    $user = User::findOrFail($iduser);

    AllServices::addLog(sprintf("%s Memperbaharui %s %s(%d) ", $user->name,$tipe_laporan->nama_laporan,$jenis_laporan->nama,$jenis_laporan->year));

    // Redirect kembali ke halaman manajemen laporan dengan pesan sukses
    return redirect()->route('LaporanManagementAdd')->with('toastData', ['success' => true, 'text' => 'Laporan berhasil disunting!']);
}




}
