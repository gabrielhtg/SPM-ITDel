<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroDocument;

class HeroDocumentController extends Controller
{

    
    public function getView($id)
    {
        // Ambil data dokumen berdasarkan ID
        $documenthero = HeroDocument::findOrFail($id);
        dd($documenthero); // Tampilkan data untuk debugging
    
        // Tampilkan view untuk menampilkan detail dokumen
        return view('document-view', compact('documenthero'));
    }
    
    

    public function edit($id)
    {
        // Ambil data dokumen berdasarkan ID
        $document = HeroDocument::findOrFail($id);

        // Tampilkan view untuk form edit dokumen
        return view('', compact('document'));
    }

    // Metode lainnya seperti store(), update(), destroy(), dll. dapat ditambahkan sesuai kebutuhan.
}
