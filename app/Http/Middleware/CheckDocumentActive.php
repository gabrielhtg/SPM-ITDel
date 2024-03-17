<?php

namespace App\Http\Middleware;

use App\Models\DocumentModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckDocumentActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil semua dokumen
        $allDocuments = DocumentModel::all();

        foreach ($allDocuments as $document) {
            $carbonStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $document->start_date);
            $carbonEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $document->end_date);
            $nowDate = Carbon::now();

            
            if ($nowDate->greaterThanOrEqualTo($carbonStartDate) && $nowDate->lessThanOrEqualTo($carbonEndDate)) {
                $document->update([
                    'keterangan_status' => true,
                ]);
            } else {
                $document->update([
                    'keterangan_status' => false,
                ]);
            }
        }

        return $next($request);
    }
}
