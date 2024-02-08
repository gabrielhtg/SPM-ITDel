<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserSettings() {
        if (Auth::check()) {
            return view("user-settings");
        }

        else {
            return redirect()->route('dashboard');
        }
    }
}
