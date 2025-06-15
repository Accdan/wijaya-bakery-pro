<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Sponsor;
use App\Models\Role;
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
        $totalPromo     = Promo::count();
        $totalSponsor   = Sponsor::count();
        
        return view('admin.dashboard-admin', compact('totalPeran' , 'totalUser','totalKategori', 'totalMenu', 'totalPromo', 'totalSponsor'));
    }
}
