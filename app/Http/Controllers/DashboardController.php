<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $totalPeran     = Role::count();
        // $totalPengguna  = Pengguna::count();
        // $totalDivisi    = Prodi::count();
        // $totalLegalisir = Legalisir::count();

        // return view('dashboard', compact(
        //     'totalPeran',
        //     'totalPengguna',
        //     'totalDivisi',
        //     'totalLegalisir'
        // ));

        return view('dashboard');
    }
}
