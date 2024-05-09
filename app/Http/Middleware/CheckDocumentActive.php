<?php

namespace App\Http\Middleware;

use App\Mail\DailyReminder;
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
use Termwind\Components\Dd;

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

//        $nowDate = now();
//        $logLaporan = LogLaporan::where('end_date', '<', $nowDate)
//            ->whereNull('status')
//            ->get();
//
//        $userIds = $logLaporan->pluck('upload_by')->toArray();
//
//        // Ambil semua user yang memiliki id yang sesuai dengan user ids dari log laporan
//        $userLaporan = User::whereIn('id', $userIds)->get();
//        $emails = $userLaporan->pluck('email')->toArray();
//
//        foreach ($emails as $email) {
//            $idJenisLaporan = $logLaporan->pluck('id_jenis_laporan')->unique()->toArray(); // Get unique jenis laporan IDs
//            $jenisLaporan = JenisLaporan::whereIn('id', $idJenisLaporan)->get();
//
//            $messageContent = 'Segera kumpulkan: ';
//            foreach ($jenisLaporan as $jenis) {
//                $messageContent .= $jenis->nama . ', ';
//            }
//            $messageContent = rtrim($messageContent, ', '); // Remove the last comma and space
//
////            \dd($email);
//            Mail::to($email)->send(new DailyReminder($messageContent));
//        }

        return $next($request);
    }
}
