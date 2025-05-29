<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:255',
        ]);

        Tags::createTag($request->only('nama_tag'));

        return redirect()->route('tags.index')->with('success', 'Tag berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tag = Tags::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tags::findOrFail($id);

        $request->validate([
            'nama_tag' => 'required|string|max:255',
        ]);

        $tag->updateTag($request->only('nama_tag'));

        return redirect()->route('tags.index')->with('success', 'Tag berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tag = Tags::findOrFail($id);
        $tag->deleteTag();

        return redirect()->route('tags.index')->with('success', 'Tag berhasil dihapus!');
    }
}
