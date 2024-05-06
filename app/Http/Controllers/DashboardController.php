<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\HeroDashboard;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{

    public function index()
    {
        $dashboard = Dashboard::all()->sortByDesc('id');
        $herodashboard = HeroDashboard::all()->sortByDesc('id');
        $news = News::latest()->take(6)->get();

        $data = [
            'dashboard' => $dashboard,
            'herodashboard' => $herodashboard,
            'news' => $news,
        ];

        return view('dashboard', $data);
    }

    public function guestIntroduction()
    {
        $dashboard = Dashboard::all()->sortByDesc('id');
        $herodashboard = HeroDashboard::all()->sortByDesc('id');

        return view('components.guesslayout', compact('dashboard', 'herodashboard'));
    }

    public function getdashboard()
    {

        $dashboard = Dashboard::all()->sortByDesc('id');

        $data = [
            'dashboard' => $dashboard,
            'active_sidebar' => [3, 0]
        ];

        return view('dashboard-admin', $data);
    }

    public function storeintroduction(Request $request)
    {
        $request->validate([
            'juduldashboard' => 'required',
            'keterangandashboard' => 'required',
        ]);

        Dashboard::create([
            'juduldashboard' => $request->juduldashboard,
            'keterangandashboard' => $request->keterangandashboard,
        ]);

        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to add introduction']);
    }


    public function getdashboardintroductiondetail($id)
    {
        $dashboardDetail = Dashboard::find($id);

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        $loggedInUserName = auth()->user()->name;

        $data = [
            'dashboardDetail' => $dashboardDetail,
            'loggedInUserName' => $loggedInUserName,
            'active_sidebar' => [3,0]
        ];
        return view('dashboard-admin-detail',$data);
    }

    public function updatedashboard(Request $request, $id)
    {
        $request->validate([
            'juduldashboard' => 'required',
            'keterangandashboard' => 'required',
        ]);

        // Cari data pengumuman yang akan diupdate
        $data = Dashboard::find($id);

        $data->juduldashboard = $request->juduldashboard;
        $data->keterangandashboard = $request->keterangandashboard;
        $data->save();

        return redirect()->route('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to update introduction']);
    }

    public function deletedashboard($id)
    {

        $dashboard = Dashboard::find($id);

        $dashboard->delete();

        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => ' Succesfully to delete introduction']);
    }



    // ----------------------------------------ini merupakan bagian untuk Hero Dashboard

    // public function indexherosection()
    // {
    //     $dashboard = HeroDashboard::all()->sortByDesc('id');

    //     $data = [
    //         'dashboard' => $dashboard
    //     ];

    //     return view('components.guesslayout', $data);
    // }

    public function storeherosection(Request $request)
    {
        $request->validate([
            'judulhero' => 'required',
            'tambahanhero' => 'required',
            'gambarhero' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:5120',
        ]);

        // Inisialisasi nama file dengan string kosong
        $walpeper = '';

        // Periksa apakah file diunggah
        if ($request->hasFile('gambarhero')) {
            // Jika file diunggah, atur nama file dengan nama file asli
            $walpeper = $request->file('gambarhero')->getClientOriginalName();

            // Pindahkan file ke folder tujuan dengan nama file asli
            $request->file('gambarhero')->move(public_path('src/walpeper'), $walpeper);
        }

        // Simpan data pengumuman ke dalam database
        HeroDashboard::create([
            'judulhero' => $request->judulhero,
            'tambahanhero' => $request->tambahanhero,
            'gambarhero' => $walpeper, // Masukkan nama file ke dalam basis data
        ]);

        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to add new Hero Section']);
    }

    public function getDetailherosection($id)
    {

        $herosectiondetail = HeroDashboard::find($id);
        // $users = auth()->user()->name;

        // Periksa apakah pengumuman ditemukan
        if (!$herosectiondetail) {
            // Jika tidak ditemukan, kembalikan respons dengan pesan kesalahan atau redirect ke halaman lain
            return redirect()->route('dashboard-admin')->with('error', 'Pengumuman tidak ditemukan.');
        }

        // Mendapatkan ukuran file
        $filePath = public_path('src/walpeper') . '/' . $herosectiondetail->gambarhero;

        $fileSize = filesize($filePath); // Ukuran file dalam byte
        $fileSizeInKB = $fileSize / 1024; // Konversi ke kilobyte
        $fileSizeInMB = $fileSizeInKB / 1024; // Konversi ke megabyte

        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKB = number_format($fileSizeInKB, 2);
        $fileSizeInMB = number_format($fileSizeInMB, 2);

        $loggedInUserName = auth()->user()->name;

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('dashboard-admin', [
            'herosectiondetail' =>   $herosectiondetail,
            'fileSizeInKB' => $fileSizeInKB,
            'fileSizeInMB' => $fileSizeInMB,
            'loggedInUserName' => $loggedInUserName,
        ]);
    }

    public function updateherosection(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judulhero' => 'required',
            'tambahanhero' => 'required',
            'gambarhero' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:5120',
        ]);
        // Cari data pengumuman yang akan diupdate
        $data = HeroDashboard::find($id);

        if (!$data) {
            return redirect()->route('dashboard-admin')->with('error', 'Berita tidak ditemukan.');
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
            $request->file('gambar')->move(public_path('src/walpeper'), $walpeper);

            // Update data dengan file yang baru
            $data->gambarhero = $walpeper;
        }
        // Update data pengumuman dengan informasi yang baru
        $data->judulhero = $request->judulhero;
        $data->tambahanhero = $request->tambahanhero;
        $data->save();

        return redirect()->route('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to update news']);
    }

    public function deleteherosection($id)
    {
        $herosection = HeroDashboard::find($id);

        $fileAncPath = public_path('src/walpeper/') . $herosection->gambarhero;

        if (File::exists($fileAncPath)) {
            File::delete($fileAncPath);
        }
        $herosection->delete();

        return redirect('dashboatd-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to delete news']);
    }
}
