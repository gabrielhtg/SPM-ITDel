<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\News;
use Illuminate\Support\Carbon;

class ActiveNews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil semua dokumen
        $allNews = News::all();

        foreach ($allNews as $news) {
            $carbonStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $news->start_date);
            $nowDate = Carbon::now();

            if ($news->end_date === null) {
                // Jika end_date null, anggap dokumen aktif jika start_date < now
                if ($nowDate->greaterThanOrEqualTo($carbonStartDate)) {
                    $news->update([
                        // 'status' => true,
                        'keterangan_status' => true,
                    ]);
                } else {
                    $news->update([
                        // 'status' => false,
                        'keterangan_status' => false,
                    ]);
                }
            } else {
                $carbonEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $news->end_date);

                if ($nowDate->greaterThanOrEqualTo($carbonStartDate) && $nowDate->lessThanOrEqualTo($carbonEndDate)) {
                    $news->update([
                        'keterangan_status' => true,
                    ]);
                } else {
                    $news->update([
                        'keterangan_status' => false,
                    ]);
                }
            }
        }
        return $next($request);
    }
}
