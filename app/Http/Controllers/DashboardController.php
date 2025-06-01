<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
// use App\Models\Pengguna;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeran     = Role::count();
        $totalUser      = User::count();
        $totalKategori  = Kategori::count();
        $totalMenu      = Menu::count();

        return view('admin.dashboard-admin', compact('totalPeran' , 'totalUser','totalKategori', 'totalMenu'));
    }
}
