<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle($request, Closure $next)
    {
        // Ambil semua dokumen dengan parent null
        $documentsWithNullParent = DocumentModel::whereNull('parent')->get();
        
        // Loop melalui setiap dokumen
        foreach ($documentsWithNullParent as $document) {
            // Perbarui parent menjadi id sendiri jika tidak digunakan sebagai parent oleh dokumen lain
            if (!DocumentModel::where('parent', $document->id)->exists()) {
                $document->update([
                    'parent' => $document->id
                    
                ]);
            }
        }
        // dd("Document ID: " . $document->id, "Parent Value: " . $document->parent);

        return $next($request);
    }
}
