<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use App\Support\DataHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('survei.role');

        // Dashboard khusus Humas
        if ($role === 'humas') {
            $periode = DB::table('survei')
                ->where('status', 'Aktif')
                ->whereNull('deleted_at')
                ->orderByDesc('survei_id')
                ->first();

            $jumlahPertanyaan = 0;
            $jumlahPartisipasi = 0;
            $jumlahJawaban = 0;

            if ($periode) {
                $jumlahPertanyaan = DB::table('pertanyaan')
                    ->where('survei_id', $periode->survei_id)
                    ->where('aktif', 1)
                    ->whereNull('deleted_at')
                    ->count();

                $jumlahPartisipasi = DB::table('partisipasi')
                    ->where('survei_id', $periode->survei_id)
                    ->count();

                $jumlahJawaban = DB::table('jawaban')
                    ->where('survei_id', $periode->survei_id)
                    ->count();
            }

            return view('survei.dashboard.humas', compact(
                'periode',
                'jumlahPertanyaan',
                'jumlahPartisipasi',
                'jumlahJawaban'
            ));
        }

        // Dashboard khusus Sarpras
        if ($role === 'sarpras') {
            $periode = DB::table('survei')
                ->where('status', 'Aktif')
                ->whereNull('deleted_at')
                ->orderByDesc('survei_id')
                ->first();

            $jumlahFasilitas = DB::table('sarana_prasarana')
                ->whereNull('deleted_at')
                ->count();

            $jumlahPertanyaan = 0;
            $rataSkor = 0;
            $jumlahJawaban = 0;

            if ($periode) {
                $jumlahPertanyaan = DB::table('pertanyaan')
                    ->where('survei_id', $periode->survei_id)
                    ->where('aspek_id', 4)
                    ->where('aktif', 1)
                    ->whereNull('deleted_at')
                    ->count();

                // Hitung rata-rata hasil survei khusus aspek sarpras
                $hasilSarpras = DB::table('jawaban as j')
                    ->join('pertanyaan as p', 'j.pertanyaan_id', '=', 'p.pertanyaan_id')
                    ->where('j.survei_id', $periode->survei_id)
                    ->where('p.aspek_id', 4)
                    ->whereNotNull('j.skor')
                    ->select(
                        DB::raw('ROUND(AVG(j.skor), 2) as rata'),
                        DB::raw('COUNT(j.jawaban_id) as total')
                    )
                    ->first();

                if ($hasilSarpras) {
                    $rataSkor = $hasilSarpras->rata ?? 0;
                    $jumlahJawaban = $hasilSarpras->total ?? 0;
                }
            }

            $fasilitasTerbaru = DB::table('sarana_prasarana')
                ->whereNull('deleted_at')
                ->orderByDesc('sarpras_id')
                ->take(4)
                ->get();

            $pertanyaanList = $periode ? DB::table('pertanyaan')
                ->where('survei_id', $periode->survei_id)
                ->where('aspek_id', 4)
                ->whereNull('deleted_at')
                ->orderBy('urutan')
                ->take(4)
                ->get() : collect();

            return view('survei.dashboard.sarpras', compact(
                'periode',
                'jumlahFasilitas',
                'jumlahPertanyaan',
                'rataSkor',
                'jumlahJawaban',
                'fasilitasTerbaru',
                'pertanyaanList'
            ));
        }

        // Dashboard untuk role lainnya tetap menggunakan DataHasil
        $aspek = collect(DataHasil::untukRole($role))
            ->filter(fn ($a) => $a['rata'] !== null)
            ->sortByDesc('rata')
            ->values();

        return view('survei.dashboard.index', [
            'role' => $role,
            'semester' => DataHasil::SEMESTER,
            'rataAll' => round($aspek->avg('rata'), 1),
            'jumlahAspek' => $aspek->count(),
            'tertinggi' => $aspek->take(3),
            'terendah' => $aspek->reverse()->take(3)->values(),
            'lihatPartisipasi' => in_array($role, ['admin', 'kepsek', 'humas'], true),
            'partisipasi' => DataHasil::partisipasi(),
            'total' => DataHasil::partisipasiTotal(),
        ]);
    }
}
