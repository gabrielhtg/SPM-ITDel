<?php

namespace App\Http\Controllers;
use App\Models\JenisLaporan;

use App\Models\LogLaporan;
use App\Models\TipeLaporan;
use Illuminate\Http\Request;

class DashboardLaporanController extends Controller
{
    public function index()
    {   
        $jenis_laporan = JenisLaporan::all();
     

        $active_sidebar = [9, 0]; 

        $data = [
          
            'active_sidebar' => [9, 0],
            'jenis_laporan'=>$jenis_laporan,
            
        ];

        return view('components.dashboard-laporan',$data);
    }
    public function getDashboardLaporanContinue(Request $request)
    {
        $year = $request->query('year');
    
        // Ambil jenis laporan berdasarkan tahun
        $jenis_laporan_ids = JenisLaporan::where('year', $year)->pluck('id');
    
        // Ambil tipe laporan beserta jenis laporannya
        $tipe_laporan = TipeLaporan::with(['jenis_laporan' => function ($query) use ($jenis_laporan_ids) {
            $query->whereIn('id', $jenis_laporan_ids);
        }])->get();
    
        // Ambil log laporan berdasarkan jenis laporan yang dipilih
        $log_laporan = LogLaporan::whereIn('id_jenis_laporan', $jenis_laporan_ids)->get();
    
        // Menghitung jumlah laporan yang statusnya tidak null dan null untuk setiap jenis laporan
        $jumlah_per_jenis = [];
        foreach ($jenis_laporan_ids as $jenis_id) {
            $jumlah_mengumpul = $log_laporan->where('id_jenis_laporan', $jenis_id)->whereNotNull('status')->count();
            $jumlah_tidak_mengumpul = $log_laporan->where('id_jenis_laporan', $jenis_id)->whereNull('status')->count();
            $jumlah_per_jenis[$jenis_id] = [
                'mengumpul' => $jumlah_mengumpul,
                'tidak_mengumpul' => $jumlah_tidak_mengumpul,
            ];
        }
        // dd($jumlah_per_jenis);
    
        $data = [
            'active_sidebar' => [9, 0],
            'log_laporan' => $log_laporan,
            'tipe_laporan' => $tipe_laporan,
            'jenis_laporan' => $jenis_laporan_ids,
            'jumlah_per_jenis' => $jumlah_per_jenis,
        ];
    
        return view('components.dashboard-laporan-continue', $data);
    }
    

    

    
    
}
