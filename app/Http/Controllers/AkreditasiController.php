<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



class AkreditasiController extends Controller
{

    public function guestHero()
    {
        $herosection =  Akreditasi::whereNotNull('gambarakreditasi')->orderByDesc('id')->get();
        

        return view('dashboard-admin', compact('herosection'));
    }

    public function indexherosection()
    {
        $dashboardakreditasi = Akreditasi::whereNotNull('gambarakreditasi')->orderByDesc('id')->get();

        $data = [
            'akreditasi' => $dashboardakreditasi
        ];

        return view('dashboard-admin', $data);
    }

    public function storeherosection(Request $request)
    {
        $request->validate([
            'gambarakreditasi' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
            'keteranganakreditasi' => 'required',
        ]);

        // Inisialisasi nama file dengan string kosong
        $gambarakreditasi = '';
        
        if ($request->hasFile('gambarakreditasi')) {
            // Jika file diunggah, atur nama file dengan nama file asli
            $gambarakreditasi = $request->file('gambarakreditasi')->getClientOriginalName();

            // Pindahkan file ke folder tujuan dengan nama file asli
            $request->file('gambarakreditasi')->move(public_path('src/gambarakreditasi'), $gambarakreditasi);
        }

        // Simpan data pengumuman ke dalam database
        Akreditasi::create([
            'judulakreditasi' => " ",
            'gambarakreditasi' => $gambarakreditasi,
            'keteranganakreditasi' => $request->keteranganakreditasi,
        ]);

        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to add new Hero Section']);
    }

    public function getDetailherosection($id)
    {
        
        $akreditasidetail = Akreditasi::find($id);
        // $users = auth()->user()->name;

        // Periksa apakah pengumuman ditemukan
        if (!$akreditasidetail) {
 
            return redirect()->route('dashboard-admin')->with('error', 'Akreditasi tidak ditemukan.');
        }

        // Mendapatkan ukuran file
        $filePath = public_path('src/gambarakreditasi') . '/' . $akreditasidetail->gambarakreditasi;

        $fileSize = filesize($filePath); // Ukuran file dalam byte
        $fileSizeInKB = $fileSize / 1024; // Konversi ke kilobyte
        $fileSizeInMB = $fileSizeInKB / 1024; // Konversi ke megabyte

        
        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKB = number_format($fileSizeInKB, 2);
        $fileSizeInMB = number_format($fileSizeInMB, 2);

        $loggedInUserName = auth()->user()->name;
        // $isEmpty = ;

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        $data = [
            'akreditasidetail' =>   $akreditasidetail,
            'fileSizeInKB' => $fileSizeInKB,
            'fileSizeInMB' => $fileSizeInMB,
            'loggedInUserName' => $loggedInUserName,
            'active_sidebar' => [3,0]
        ];

        return view('dashboard-akreditasi-detail',$data);
    }

    public function updateherosection(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'gambarakreditasi' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
            'keteranganakreditasi' => 'required',
        ]);
        // Cari data pengumuman yang akan diupdate
        $data = Akreditasi::find($id);

        if (!$data) {
            return redirect()->route('dashboard-admin')->with('error', 'Data tidak ditemukan.');
        }

        // Jika ada file baru yang diunggah, lakukan proses penghapusan dan pembaruan file
        if ($request->hasFile('gambarakreditasi')) {
            $fileAncPath = public_path('src/gambarakreditasi/') . $data->gambarakreditasi;

            // Hapus file lama jika ada
            if (File::exists($fileAncPath)) {
                File::delete($fileAncPath);
            }

            // Simpan file yang baru diunggah
            $gambarakreditasi = $request->file('gambarakreditasi')->getClientOriginalName();
            $request->file('gambarakreditasi')->move(public_path('src/gambarakreditasi'), $gambarakreditasi);

            // Update data dengan file yang baru
            $data->gambarakreditasi = $gambarakreditasi;
        }

        

        // dd($request->keteranganakreditasi);
        // Update data pengumuman dengan informasi yang baru
        $data->judulakreditasi = " ";
        $data->keteranganakreditasi = $request->keteranganakreditasi;
        $data->save();


        return redirect()->route('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to update Dashboard']);

    }

    public function deleteherosection($id)
    {
        $data = Akreditasi::find($id);
    
        if (!$data) {
            return redirect('dashboard-admin')->with('error', 'Data not found.');
        }
    
        $fileAncPath = public_path('src/gambarakreditasi/') . $data->gambarakreditasi;
    
        if (File::exists($fileAncPath)) {
            File::delete($fileAncPath);
        }
    
        $data->delete();
    
        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Successfully deleted Akreditasi']);
    }
    
    
}
