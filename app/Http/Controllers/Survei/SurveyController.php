<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SurveiController extends Controller
{
    public function welcome()
    {
        $periode = DB::table('periode')->where('status', 'buka')->first();
        $kategori = DB::table('kategori_responden')->orderByDesc('wajib')->orderBy('id')->get();

        return view('survei.publik.welcome', compact('periode', 'kategori'));
    }
}