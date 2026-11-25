<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->select(
                'semester',
                'tahun_ajaran',
                'tanggal_selesai as selesai'
            )
            ->first();

        $kategori = DB::table('kategori_responden')
            ->select('kategori_id', 'nama', 'wajib')
            ->orderBy('kategori_id')
            ->get();

        return view('survei.publik.welcome', compact('periode', 'kategori'));
    }
}
