<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('survei.role');

        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        $aspek = collect();

        if ($periode) {
            $aspek = DB::table('aspek as a')
                ->join('pertanyaan as p', 'p.aspek_id', '=', 'a.aspek_id')
                ->leftJoin('jawaban as j', function ($join) use ($periode) {
                    $join->on('j.pertanyaan_id', '=', 'p.pertanyaan_id')
                        ->where('j.survei_id', '=', $periode->survei_id)
                        ->whereNotNull('j.skor');
                })
                ->where('p.survei_id', $periode->survei_id)
                ->where('p.jenis', 'Skala')
                ->where('p.aktif', 1)
                ->whereNull('p.deleted_at')
                ->select(
                    'a.aspek_id',
                    'a.nama_aspek',
                    'a.bersama',
                    DB::raw('ROUND(AVG(j.skor), 2) as rata'),
                    DB::raw('COUNT(j.jawaban_id) as jumlah_jawaban')
                )
                ->groupBy('a.aspek_id', 'a.nama_aspek', 'a.bersama')
                ->orderBy('a.aspek_id')
                ->get();
        }

        return view('survei.dashboard.hasil', [
            'periode' => $periode,
            'semester' => $periode
                ? $periode->tahun_ajaran . ' · Semester ' . $periode->semester
                : null,
            'aspek' => $aspek,
            'rinci' => false,
            'kategori' => [],
        ]);
    }
}
