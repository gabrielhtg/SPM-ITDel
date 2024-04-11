<?php

namespace App\Http\Middleware;

use App\Models\Laporan;
use App\Models\LogLaporan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LogPengumpulanLaporan
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
        $response = $next($request);

        
        if ($response->getStatusCode() === 200) {
            
            $laporan = Laporan::where('status', 'Disetujui')->get();
           
            // $id_tipe_laporan= $laporan->id_tipelaporan;


            
            foreach ($laporan as $item) {
                
                LogLaporan::create([
                    'id_jenis_laporan' => $item->id_tipelaporan,
                    'upload_by' => $item->created_by,
                ]);
            }
        }

        return $response;
    }
}
