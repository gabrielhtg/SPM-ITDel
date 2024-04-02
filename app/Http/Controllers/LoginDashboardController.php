<?php

namespace App\Http\Controllers;
use App\Models\LoginDashboard;
use App\Models\User;
use Illuminate\Http\Request;

class LoginDashboardController extends Controller
{
    public function indexlogindashboard()
    {
        $logindashboard = LoginDashboard::all()->sortByDesc('id');

        $data = [
            'dashboard' => $logindashboard
        ];

        return view('login-admin-dashboard', $data);
    }
    
}
