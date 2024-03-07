<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{

    public function index()
    {
        $dashboard = Dashboard::all()->sortByDesc('id');

        $data = [
            'dashboard' => $dashboard
        ];

        return view('components.guesslayout', $data);
    }

    public function guestIntroduction()
    {
        $dashboard = Dashboard::all()->sortByDesc('id'); 

        return view('components.guesslayout', compact('dashboard'));
    }

    public function getdashboard()
    {

        $dashboard = Dashboard::all()->sortByDesc('id');

        $data = [
            'dashboard' => $dashboard
        ];

        return view('dashboard-admin', $data);
    }

    public function storeintroduction(Request $request)
    {
        $request->validate([
            'juduldashboard' => 'required',
            'keterangandashboard' => 'required',
        ]);   

        Dashboard::create([
            'juduldashboard' => $request->juduldashboard,
            'keterangandashboard' => $request->keterangandashboard,
        ]);
        
        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to add introduction']);
    }


    public function getdashboardintroductiondetail($id)
    {
        $dashboardDetail = Dashboard::find($id);

        // Mengirimkan data pengumuman beserta ukuran file ke tampilan
        return view('dashboard-admin-detail', [
            'dashboardDetail' => $dashboardDetail
        ]);
    }

    public function updatedashboard(Request $request, $id)
    {
        $request->validate([
            'juduldashboard' => 'required',
            'keterangandashboard' => 'required',
        ]);

        // Cari data pengumuman yang akan diupdate
        $data = Dashboard::find($id);

        $data->juduldashboard = $request->juduldashboard;
        $data->keterangandashboard = $request->keterangandashboard;
        $data->save();

        return redirect()->route('dashboard-admin')->with('toastData', ['success' => true, 'text' => 'Succesfully to update introduction']);
    }

    public function deletedashboard($id)
    {

        $dashboard = Dashboard::find($id);

        $dashboard->delete();

        return redirect('dashboard-admin')->with('toastData', ['success' => true, 'text' => ' Succesfully to delete introduction']);
    }
}
