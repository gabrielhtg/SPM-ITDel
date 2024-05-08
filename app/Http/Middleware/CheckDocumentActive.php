<?php

namespace App\Http\Middleware;

use App\Models\DocumentModel;
use App\Models\JenisLaporan;
use App\Models\LogLaporan;
use App\Models\User;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Runner\ErrorException;

class CheckDocumentActive
{
    /**
     * Handle an incoming request.
     *
     * @param Closure $next
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
        $allDocuments = DocumentModel::all();

        $users = User::all();

        if (auth()->user() !== null) {
            User::find(auth()->user()->id)->update([
                'last_login_at' => now()
            ]);

            foreach ($users as $user) {
                $targetTime = $user->last_login_at;

                $currentDateTime = new DateTime();

                try {
                    $targetDateTime = new DateTime($targetTime);
                    $targetDateTime->modify('+1 hour');

                    if ($currentDateTime > $targetDateTime) {
                        $user->update([
                            'online' => false,
                        ]);
                    }
                } catch (\Exception $e) {
                    // do nothing
                }
            }
        }
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


        if (auth()->check()) {

            auth()->user()->update([
                'online' =>true
            ]);
        }
    
        return $next($request);
    }
}
