<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|uuid|exists:menu,id',
            'comment' => 'required|string|max:1000',
        ]);

        Comments::createComment([
            'user_id' => Auth::id(),
            'menu_id' => $request->menu_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $comment = Comments::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->updateComment([
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $comment->deleteComment();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
