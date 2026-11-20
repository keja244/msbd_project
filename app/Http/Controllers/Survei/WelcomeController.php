<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        // Data sementara, nanti diganti dari database
        $periode = (object) ['semester' => 1, 'tahun_ajaran' => '2026/2027', 'selesai' => '2026-11-30'];
        $kategori = collect([
            ['nama' => 'Siswa', 'wajib' => true], ['nama' => 'Guru', 'wajib' => true],
            ['nama' => 'Tendik', 'wajib' => true], ['nama' => 'Orang Tua', 'wajib' => false],
            ['nama' => 'Masyarakat', 'wajib' => false],
        ])->map(fn ($k) => (object) $k);

        return view('survei.welcome', compact('periode', 'kategori'));
    }
}