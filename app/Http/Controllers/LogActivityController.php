<?php

namespace App\Http\Controllers;

use App\Models\LogActivityModel;
use App\Models\TipeLaporan;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function getLogActivityPage () {
        $data = [
            'log_activities' => LogActivityModel::all(),
//            'log_activities' => LogActivityModel::orderBy('created_at', 'desc')->take(20)->get(),
            'active_sidebar' => [10, 0]
        ];

        return view('log-activity', $data);
    }
}
