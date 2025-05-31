<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->latest()->take(6)->get();
        return view('home', compact('menus'));
    }
}
