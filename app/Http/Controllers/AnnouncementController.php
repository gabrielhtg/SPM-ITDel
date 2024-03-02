<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnnouncementController extends Controller
{
    public function getAnnouncement()
    {

        $announcement = Announcement::all()->sortByDesc('id');

        $data = [
            'announcement' => $announcement
        ];

        return view('announcement', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:5120',
        ]);

        // Inisialisasi nama file dengan string kosong
        $fileAnc = '';

        // Periksa apakah file diunggah
        if ($request->hasFile('file')) {
            // Jika file diunggah, atur nama file dengan nama file asli
            $fileAnc = $request->file('file')->getClientOriginalName();

            // Pindahkan file ke folder tujuan dengan nama file asli
            $request->file('file')->move(public_path('src/fileanc'), $fileAnc);
        }

        // Simpan data pengumuman ke dalam database
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'file' => $fileAnc, // Masukkan nama file ke dalam basis data
        ]);

        return redirect('announcement')->with('toastData', ['success' => true, 'text' => 'Succesfully to add announcement']);
    }


    public function getDetail($id)
    {
        $announcementDetail = Announcement::find($id);
        // $users = auth()->user()->name;

        // Periksa apakah pengumuman ditemukan
        if (!$announcementDetail) {
            // Jika tidak ditemukan, kembalikan respons dengan pesan kesalahan atau redirect ke halaman lain
            return redirect()->route('announcement')->with('error', 'Pengumuman tidak ditemukan.');
        }

        // Mendapatkan ukuran file
        $filePath = public_path('src/fileanc/') . $announcementDetail->file;
        $fileSize = filesize($filePath); // Ukuran file dalam byte
        $fileSizeInKB = $fileSize / 1024; // Konversi ke kilobyte
        $fileSizeInMB = $fileSizeInKB / 1024; // Konversi ke megabyte

        // Membatasi jumlah desimal menjadi 2
        $fileSizeInKB = number_format($fileSizeInKB, 2);
        $fileSizeInMB = number_format($fileSizeInMB, 2);

        $loggedInUserName = auth()->user()->name;

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('announcement-detail', [
            'announcementDetail' => $announcementDetail,
            'fileSizeInKB' => $fileSizeInKB,
            'fileSizeInMB' => $fileSizeInMB,
            'loggedInUserName' => $loggedInUserName,
        ]);
    }

    public function updateannouncement(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:5120',
        ]);

        // Cari data pengumuman yang akan diupdate
        $data = Announcement::find($id);

        if (!$data) {
            return redirect()->route('announcement')->with('error', 'Pengumuman tidak ditemukan.');
        }

        // Jika ada file baru yang diunggah, lakukan proses penghapusan dan pembaruan file
        if ($request->hasFile('file')) {
            $fileAncPath = public_path('src/fileanc/') . $data->file;

            // Hapus file lama jika ada
            if (File::exists($fileAncPath)) {
                File::delete($fileAncPath);
            }

            // Simpan file yang baru diunggah
            $fileAnc = $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('src/fileanc'), $fileAnc);

            // Update data dengan file yang baru
            $data->file = $fileAnc;
        }

        // Update data pengumuman dengan informasi yang baru
        $data->title = $request->title;
        $data->content = $request->content;
        $data->save();

        return redirect()->route('announcement')->with('toastData', ['success' => true, 'text' => 'Succesfully to update announcement']);
    }

    public function deleteannouncement($id)
    {

        $announcement = Announcement::find($id);

        $fileAncPath = public_path('src/fileanc/') . $announcement->file;

        if (File::exists($fileAncPath)) {
            File::delete($fileAncPath);
        }
        $announcement->delete();

        return redirect('announcement')->with('toastData', ['success' => true, 'text' => ' Succesfully to delete announcement']);
    }
}
