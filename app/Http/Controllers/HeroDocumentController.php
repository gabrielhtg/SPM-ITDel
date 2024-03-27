<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroDocument;

class HeroDocumentController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'titlehero' => 'required',
            'descriptionhero' => 'required',
            'imagehero' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx|max:10240|required',
        ],[
            'imagehero.required'=> 'dedi',
        ]);

        // Ambil data dokumen pahlawan berdasarkan ID
        $document = HeroDocument::findOrFail($id);

        // Update data dokumen pahlawan dengan data baru
        $document->titlehero = $request->titlehero;
        $document->descriptionhero = $request->descriptionhero;

        // Jika ada file gambar yang diunggah, proses gambar
       // Jika ada file gambar yang diunggah, proses gambar
        if ($request->hasFile('imagehero')) {
            // Proses unggah gambar
            $file = $request->file('imagehero');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan gambar ke direktori public/src/img
            $file->move(public_path('src/img'), $fileName);
            
            // Simpan nama file gambar ke dalam model HeroDocument
            $document->imagehero = $fileName;
        }


        // Simpan perubahan
        $document->save();

        // Redirect ke halaman atau tindakan lain setelah penyimpanan
        return redirect()->route('documentManagement')->with('toastData', ['success' => true, 'text' => 'Berhasil diperbarui!']);
    }
}
