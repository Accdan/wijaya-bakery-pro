<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
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
}
