<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Menu;
use App\Models\MenuTranslation;
use Illuminate\Support\Str;

class MenuTranslateController extends Controller
{
    public function translate($id)
    {
        $menu = Menu::findOrFail($id);

        $existing = MenuTranslation::where('menu_id', $menu->id)->where('lang', 'en')->first();

        if ($existing) {
            return response()->json([
                'status' => 'cached',
                'data' => $existing,
            ]);
        }

        $translatedNama = $this->translateToEnglish($menu->nama_menu);
        $translatedDeskripsi = $this->translateToEnglish($menu->deskripsi_menu);
        $translatedProsedur = $this->translateToEnglish($menu->prosedur);

        $translation = MenuTranslation::create([
            'menu_id' => $menu->id,
            'lang' => 'en',
            'nama_menu' => $translatedNama,
            'deskripsi_menu' => $translatedDeskripsi,
            'prosedur' => $translatedProsedur,
        ]);

        return response()->json([
            'status' => 'translated',
            'data' => $translation,
        ]);
    }

    private function translateToEnglish($text)
    {
        $response = Http::post('https://libretranslate.com/translate', [
            'q' => $text,
            'source' => 'id',
            'target' => 'en',
            'format' => 'text',
            'api_key' => '',
        ]);

        if ($response->successful()) {
            return $response->json()['translatedText'] ?? '[no result]';
        }

        return '[translation error]';
    }
}
