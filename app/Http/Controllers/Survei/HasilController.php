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
        $pertanyaanSarpras = collect();
        $saranSarpras = collect();

        if ($periode) {
            $query = DB::table('aspek as a')
                ->join('pertanyaan as p', 'p.aspek_id', '=', 'a.aspek_id')
                ->leftJoin('jawaban as j', function ($join) use ($periode) {
                    $join->on('j.pertanyaan_id', '=', 'p.pertanyaan_id')
                        ->where('j.survei_id', '=', $periode->survei_id)
                        ->whereNotNull('j.skor');
                })
                ->where('p.survei_id', $periode->survei_id)
                ->where('p.jenis', 'Skala')
                ->where('p.aktif', 1)
                ->whereNull('p.deleted_at');

            // HANYA aspek sarpras jika role adalah sarpras
            if ($role === 'sarpras') {
                $query->where('a.aspek_id', 4);
            }

            $aspek = $query->select(
                'a.aspek_id',
                'a.nama_aspek',
                'a.bersama',
                DB::raw('ROUND(AVG(j.skor), 2) as rata'),
                DB::raw('COUNT(j.jawaban_id) as jumlah_jawaban')
            )
                ->groupBy('a.aspek_id', 'a.nama_aspek', 'a.bersama')
                ->orderBy('a.aspek_id')
                ->get()
                ->map(function ($item) {
                    return [
                        'aspek_id' => $item->aspek_id,
                        'nama' => $item->nama_aspek,
                        'bersama' => $item->bersama,
                        'rata' => $item->rata,
                        'jumlah_jawaban' => $item->jumlah_jawaban,
                        'delta' => null,
                        'slug' => $item->aspek_id,
                    ];
                });

            // Detail per butir pertanyaan untuk Sarpras
            if ($role === 'sarpras') {
                $pertanyaanSarpras = DB::table('pertanyaan as p')
                    ->leftJoin('jawaban as j', function ($join) use ($periode) {
                        $join->on('j.pertanyaan_id', '=', 'p.pertanyaan_id')
                            ->where('j.survei_id', '=', $periode->survei_id)
                            ->whereNotNull('j.skor');
                    })
                    ->where('p.survei_id', $periode->survei_id)
                    ->where('p.aspek_id', 4)
                    ->where('p.jenis', 'Skala')
                    ->whereNull('p.deleted_at')
                    ->select(
                        'p.pertanyaan_id',
                        'p.teks_pertanyaan',
                        'p.urutan',
                        'p.aktif',
                        DB::raw('ROUND(AVG(j.skor), 2) as rata'),
                        DB::raw('COUNT(j.jawaban_id) as total_respon')
                    )
                    ->groupBy('p.pertanyaan_id', 'p.teks_pertanyaan', 'p.urutan', 'p.aktif')
                    ->orderBy('p.urutan')
                    ->get();

                // Masukan atau saran isian esai terkait sarpras
                $saranSarpras = DB::table('jawaban as j')
                    ->join('pertanyaan as p', 'j.pertanyaan_id', '=', 'p.pertanyaan_id')
                    ->join('kategori_responden as kr', 'j.kategori_id', '=', 'kr.kategori_id')
                    ->where('j.survei_id', $periode->survei_id)
                    ->where('p.aspek_id', 4)
                    ->whereNotNull('j.isian')
                    ->select(
                        'j.jawaban_id',
                        'kr.nama as kategori_responden',
                        'p.teks_pertanyaan',
                        'j.isian as saran',
                        'j.partisipasi_id'
                    )
                    ->take(10)
                    ->get();
            }
        }

        return view('survei.pengelola.hasil', [
            'role' => $role,
            'periode' => $periode,
            'semester' => $periode
                ? $periode->tahun_ajaran.' · Semester '.$periode->semester
                : null,
            'aspek' => $aspek,
            'pertanyaanSarpras' => $pertanyaanSarpras,
            'saranSarpras' => $saranSarpras,
            'rinci' => false,
            'kategori' => [],
        ]);
    }
}