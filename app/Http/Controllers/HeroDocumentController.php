<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HeroDocument;

class HeroDocumentController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'titlehero' => 'required|string|max:40',
            'descriptionhero' => 'required|string|max:100',
            'imagehero' => 'nullable|file|image|mimes:jpeg,png,jpg|max:10240', // Menambahkan rule 'image'
        ], [
            'descriptionhero.max' => 'Deskripsi tidak boleh melebihi 100 karakter.',
            'titlehero.max' => 'Judul tidak boleh melebihi 40 karakter.',
            'imagehero.image' => 'File harus berupa gambar.', // Pesan error kustom untuk file non-gambar
            'imagehero.mimes' => 'File harus berformat jpeg, png, atau jpg.',
            'imagehero.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);
        
        // Jika validasi gagal, kembali dengan pesan error
        if ($validator->fails()) {
            return redirect()->route('documentManagement')->with('toastData', ['success' => false, 'text' => $validator->errors()->first()]);
        }

        // Ambil data dokumen pahlawan berdasarkan ID
        $document = HeroDocument::findOrFail($id);

        // Update data dokumen pahlawan dengan data baru
        $document->titlehero = $request->titlehero;
        $document->descriptionhero = $request->descriptionhero;

        // Jika ada file gambar yang diunggah, proses gambar
        if ($request->hasFile('imagehero')) {
            // Proses unggah gambar
            $file = $request->file('imagehero');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan gambar ke direktori public/src/img
            $file->move(public_path('src/img'), $fileName);

            // Simpan nama file gambar ke dalam model HeroDocument
            $document->imagehero = $fileName;
        } elseif ($request->filled('use_previous_image')) {
            // Jika pengguna memilih untuk menggunakan gambar yang ada
            // Simpan nama file gambar yang ada ke dalam model HeroDocument
            $document->imagehero = $document->imagehero;
        }

        // Simpan perubahan
        $document->save();

        // Redirect ke halaman atau tindakan lain setelah penyimpanan
        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Berhasil diperbarui!']);
    }
}
