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

        // Tampilkan view untuk menampilkan detail dokumen
        return view('dokument-view', compact('documenthero'));
    }

    public function edit($id)
    {
        // Ambil data dokumen berdasarkan ID
        $document = HeroDocument::findOrFail($id);

        // Tampilkan view untuk form edit dokumen
        return view('hero_documents.edit', compact('document'));
    }

    // Metode lainnya seperti store(), update(), destroy(), dll. dapat ditambahkan sesuai kebutuhan.
}
