<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('survei.role');

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

        return view('survei.pengelola.index', compact(
            'role',
            'periode',
            'jumlahPertanyaan',
            'jumlahPartisipasi',
            'jumlahJawaban'
        ));
    }
}
