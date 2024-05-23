<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\HeroDashboard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



class HerodashboardController extends Controller
{
    // ----------------------------------------ini merupakan bagian untuk Hero Dashboard

    public function guestHero()
    {
        $herosection = HeroDashboard::all()->sortByDesc('id'); 

        return view('dashboard-admin', compact('herosection'));
    }

    public function indexherosection()
    {
        $dashboardhero = HeroDashboard::all()->sortByDesc('id');

        $data = [
            'dashboard' => $dashboardhero
        ];

        return view('dashboard-admin', $data);
    }

    public function storeherosection(Request $request)
    {
        $request->validate([
            'profilhero' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
            'judulhero' => 'required',
            'tambahanhero' => 'required',
            'gambarhero' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:10240',
        ]);

        // Inisialisasi nama file dengan string kosong
        $walpeper = '';
        $profilhero = '';
        
        if ($request->hasFile('profilhero')) {
            // Jika file diunggah, atur nama file dengan nama file asli
            $profilhero = $request->file('profilhero')->getClientOriginalName();

            // Pindahkan file ke folder tujuan dengan nama file asli
            $request->file('profilhero')->move(public_path('src/profilhero'), $profilhero);
        }
        // Periksa apakah file diunggah
        if ($request->hasFile('gambarhero')) {
            // Jika file diunggah, atur nama file dengan nama file asli
            $walpeper = $request->file('gambarhero')->getClientOriginalName();

            // Pindahkan file ke folder tujuan dengan nama file asli
            $request->file('gambarhero')->move(public_path('src/walpeper'), $walpeper);
        }

        // Simpan data pengumuman ke dalam database
        HeroDashboard::create([
            'profilhero' => $profilhero,
            'judulhero' => $request->judulhero,
            'tambahanhero' => $request->tambahanhero,
            'gambarhero' => $walpeper, // Masukkan nama file ke dalam basis data
        ]);

        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Berhasil Menambahkan Hero Section']);
    }

    public function getDetailherosection($id)
    {
        
        $herosectiondetail = HeroDashboard::find($id);
        // $users = auth()->user()->name;

        // Periksa apakah pengumuman ditemukane
        if (!$herosectiondetail) {
            // $isEmpty = true;

            // Jika tidak ditemukan, kembalikan respons dengan pesan kesalahan atau redirect ke halaman lain
            return redirect()->route('dashboard-admin')->with('error', 'Pengumuman tidak ditemukan.');
        }

        // Mendapatkan ukuran file
        $filePath = public_path('src/walpeper') . '/' . $herosectiondetail->gambarhero;
        $filePathakreditasi = public_path('src/profilhero') . '/' . $herosectiondetail->profilhero;

        $fileSize = filesize($filePath); // Ukuran file dalam byte
        $fileSizeInKB = $fileSize / 1024; // Konversi ke kilobyte
        $fileSizeInMB = $fileSizeInKB / 1024; // Konversi ke megabyte

        $fileSizeakreditasi = filesize($filePathakreditasi); // Ukuran file dalam byte
        $fileSizeInKBakreditasi = $fileSizeakreditasi / 1024; // Konversi ke kilobyte
        $fileSizeInMBakreditasi = $fileSizeInKBakreditasi / 1024; // Konversi ke megabyte

        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKB = number_format($fileSizeInKB, 2);
        $fileSizeInMB = number_format($fileSizeInMB, 2);

        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKBakreditasi = number_format($fileSizeInKBakreditasi, 2);
        $fileSizeInMBakreditasi = number_format($fileSizeInMBakreditasi, 2);

        $loggedInUserName = auth()->user()->name;
        // $isEmpty = ;

        $data = [
            'herosectiondetail' =>   $herosectiondetail,
            'fileSizeInKB' => $fileSizeInKB,
            'fileSizeInKBakreditasi' => $fileSizeInKBakreditasi,
            'fileSizeInMB' => $fileSizeInMB,
            'fileSizeInMBakreditasi' => $fileSizeInMBakreditasi,
            'loggedInUserName' => $loggedInUserName,
            'active_sidebar' => [3,0]
        ];

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('dashboard-adminhero-detail', $data);
    }

    public function updateherosection(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'profilhero' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
            'judulhero' => 'required|max:30',
            'tambahanhero' => 'required|max:50',
            'gambarhero' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
        ]);
        // Cari data pengumuman yang akan diupdate
        $data = HeroDashboard::find($id);

        if (!$data) {
            return redirect()->route('dashboard-admin')->with('error', 'Data tidak ditemukan.');
        }

        // Jika ada file baru yang diunggah, lakukan proses penghapusan dan pembaruan file
        if ($request->hasFile('gambarhero')) {
            $fileAncPath = public_path('src/walpeper/') . $data->gambarhero;

            // Hapus file lama jika ada
            if (File::exists($fileAncPath)) {
                File::delete($fileAncPath);
            }

            // Simpan file yang baru diunggah
            $walpeper = $request->file('gambarhero')->getClientOriginalName();
            $request->file('gambarhero')->move(public_path('src/walpeper'), $walpeper);

            // Update data dengan file yang baru
            $data->gambarhero = $walpeper;
        }

        else if ($request->hasFile('profilhero')) {
            $fileAncPath = public_path('src/profilhero/') . $data->profilhero;

            // Hapus file lama jika ada
            if (File::exists($fileAncPath)) {
                File::delete($fileAncPath);
            }

            // Simpan file yang baru diunggah
            $profilhero = $request->file('profilhero')->getClientOriginalName();
            $request->file('profilhero')->move(public_path('src/profilhero'), $profilhero);

            // Update data dengan file yang baru
            $data->profilhero = $profilhero;
        }
        // Update data pengumuman dengan informasi yang baru
        $data->judulhero = $request->judulhero;
        $data->tambahanhero = $request->tambahanhero;
        $data->save();

        return redirect()->route('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Berhasil Mengubah Hero Section']);

    }

    public function deleteherosection($id)
    {
        $data = HeroDashboard::find($id);
    
        if (!$data) {
            return redirect('dashboard-admin')->with('error', 'Data not found.');
        }
    
        $fileAncPath = public_path('src/walpeper/') . $data->gambarhero;
        $fileAncPath = public_path('src/profilhero/') . $data->profilhero;
    
        if (File::exists($fileAncPath)) {
            File::delete($fileAncPath);
        }
    
        $data->delete();
    
        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Berhasil Menghapus Hero Section']);
    }
    
    
}
