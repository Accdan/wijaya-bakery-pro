<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['comments.user', 'likes'])->get();
        $data = $menus->map(function ($menu) {
            return [
                'id' => $menu->id,
                'title' => $menu->nama_menu,
                'desc' => $menu->deskripsi_menu,
                'image' => $menu->gambar_menu,
                'likes' => $menu->likes->count(),
                'comments' => $menu->comments->map(function ($comment) {
                    return [
                        'user' => $comment->user->name,
                        'text' => $comment->comment_text,
                    ];
                })->toArray(),
            ];
        });

        return view('user.dashboard-user', ['menus' => $data]);
    }

    public function homepage()
    {
        return view('user.homepage');
    }

    public function kategoriList()
    {
        $kategoris = Kategori::all();
        return view('user.kategori-list', compact('kategoris'));
    }

    public function menuByKategori($id)
    {
        $kategori = Kategori::with('menus')->findOrFail($id); // ambil kategori & semua menunya
        return view('user.menu-by-kategori', compact('kategori'));
    }
}
