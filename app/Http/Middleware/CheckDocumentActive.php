<?php

namespace App\Http\Middleware;

use App\Models\DocumentModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            $nowDate = Carbon::now();

            if ($document->end_date === null) {
                // Jika end_date null, anggap dokumen aktif jika start_date < now
                if ($nowDate->greaterThanOrEqualTo($carbonStartDate)) {
                    $document->update([
                        // 'status' => true,
                        'keterangan_status' => true,
                    ]);
                } else {
                    $document->update([
                        // 'status' => false,
                        'keterangan_status' => false,
                    ]);
                }
            } else {
                $carbonEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $document->end_date);

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
        }

        foreach ($allDocuments as $document) {
            $keterangan_berlaku = $document->keterangan_berlaku;
            $carbonEndDate =  $document->end_date;
            if ($keterangan_berlaku !== null) {
                if ($keterangan_berlaku == 1) {
                    $document->update([
                        'keterangan_status' => false,
                        'end_date'=>now()
                        
                    ]);
                }


                
            }
        }


        return $next($request);
    }
}
