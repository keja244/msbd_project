<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PartisipasiController extends Controller
{
    public function index()
    {
        // Mengambil survei aktif terbaru
        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        $partisipasi = collect();
        $total = [
            'terisi' => 0,
            'total' => 0,
            'persen' => 0,
        ];

        if ($periode) {
            // Mengambil kategori dan jumlah responden yang sudah mengisi
            $partisipasi = DB::table('kategori_responden as k')
                ->leftJoin('v_rekap_partisipasi_per_kategori_responden as v', function ($join) use ($periode) {
                    $join->on('v.kategori_id', '=', 'k.kategori_id')
                        ->where('v.survei_id', '=', $periode->survei_id);
                })
                ->select(
                    'k.kategori_id',
                    'k.nama',
                    'k.wajib',
                    DB::raw('COALESCE(v.jumlah_partisipasi, 0) as terisi')
                )
                ->orderBy('k.kategori_id')
                ->get();

            $total['terisi'] = $partisipasi->sum('terisi');
        }

        return view('survei.pengelola.partisipasi', [
            'periode' => $periode,
            'semester' => $periode
                ? $periode->tahun_ajaran . ' · Semester ' . $periode->semester
                : null,
            'partisipasi' => $partisipasi,
            'total' => $total,
        ]);
    }
}
