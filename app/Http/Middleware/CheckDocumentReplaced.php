<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DocumentModel;

class CheckDocumentReplaced
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada dokumen baru yang menggantikan dokumen sebelumnya dengan ID yang sama
        if ($request->filled('menggantikan_dokumen')) {
            $dokumenDigantikan = DocumentModel::whereIn('id', $request->menggantikan_dokumen)->get();
            
            // Loop melalui dokumen yang akan digantikan
            foreach ($dokumenDigantikan as $dokumen) {
                // Ubah status dokumen sebelumnya menjadi tidak aktif (status = 0)
                $dokumenSebelumnya = DocumentModel::find($dokumen->menggantikan_dokumen);
                if ($dokumenSebelumnya) {
                    $dokumenSebelumnya->status = 0;
                    $dokumenSebelumnya->save();
                }
            }
        }

        return $next($request);
    }
}
