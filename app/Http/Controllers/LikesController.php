<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function toggle(Request $request, $menu_id)
    {
        $user = Auth::user();

        $existingLike = Likes::where('user_id', $user->id)
                             ->where('menu_id', $menu_id)
                             ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['status' => 'unliked']);
        } else {
            Likes::create([
                'user_id' => $user->id,
                'menu_id' => $menu_id,
            ]);
            return response()->json(['status' => 'liked']);
        }
    }
}
