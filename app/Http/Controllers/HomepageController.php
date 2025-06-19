<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Hero;
use App\Models\Promo;
use App\Models\Sponsor;

class HomepageController extends Controller
{
    public function index()
{
    $menus = Menu::latest()->get();
    $hero = Hero::where('status', 1)->latest()->first();
    $promos = Promo::where('status', 1)->get();
    $sponsors = Sponsor::all();
    return view('homepage', compact('menus', 'hero', 'promos', 'sponsors'));
}

}
