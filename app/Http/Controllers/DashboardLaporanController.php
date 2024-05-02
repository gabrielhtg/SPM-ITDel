<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardLaporanController extends Controller
{
    public function index()
    {
        $active_sidebar = [0, 1]; // atau sesuai dengan kebutuhan Anda

        return view('components.dashboard-laporan', compact('active_sidebar'));
    }
}
