<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientsController extends Controller
{
    public function indexByMenu($menu_id)
    {
        $ingredients = Ingredients::where('menu_id', $menu_id)->get();
        return response()->json($ingredients);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id'     => 'required|uuid|exists:menu,id',
            'nama_bahan'  => 'required|string|max:255',
            'jumlah'      => 'required|numeric',
            'satuan'      => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $ingredient = Ingredients::createIngredient($request->all());

        return response()->json([
            'message' => 'Bahan berhasil ditambahkan.',
            'data'    => $ingredient,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ingredient = Ingredients::findOrFail($id);

        $ingredient->updateIngredient($request->all());

        return response()->json([
            'message' => 'Bahan berhasil diperbarui.',
            'data'    => $ingredient,
        ]);
    }

    public function destroy($id)
    {
        $ingredient = Ingredients::findOrFail($id);
        $ingredient->deleteIngredient();

        return response()->json([
            'message' => 'Bahan berhasil dihapus.',
        ]);
    }
}
