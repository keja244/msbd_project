<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class DataSurvei
{
    private static function kategoriId(string $kategori): ?int
    {
        return match ($kategori) {
            '1', 'guru', 'tendik' => 1,
            '2', 'siswa' => 2,
            '3', 'masyarakat', 'orang_tua', 'tamu' => 3,
            default => null,
        };
    }

    public static function pertanyaan(string $kategori): array
    {
        $kategoriId = self::kategoriId($kategori);

        if (!$kategoriId) {
            return [];
        }

        $tanggal = now()->toDateString();

        $survei = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            // ->whereDate('tanggal_mulai', '<=', $tanggal)
            // ->whereDate('tanggal_selesai', '>=', $tanggal)
            ->orderByDesc('tanggal_mulai')
            ->first();

        if (!$survei) {
            return [];
        }

        $data = DB::table('aspek_kategori as ak')
            ->join('aspek as a', 'a.aspek_id', '=', 'ak.aspek_id')
            ->join('pertanyaan as p', function ($join) use ($survei) {
                $join->on('p.aspek_id', '=', 'a.aspek_id')
                    ->where('p.survei_id', '=', $survei->survei_id);
            })
            ->where('ak.survei_id', $survei->survei_id)
            ->where(function ($query) use ($kategoriId) {
                $query->whereNull('ak.kategori_id')
                    ->orWhere('ak.kategori_id', $kategoriId);
            })
            ->whereNull('p.deleted_at')
            ->where('p.aktif', 1)
            ->select(
                'a.aspek_id',
                'a.nama_aspek',
                'p.pertanyaan_id',
                'p.teks_pertanyaan',
                'p.urutan'
            )
            ->distinct()
            ->orderBy('a.aspek_id')
            ->orderBy('p.urutan')
            ->orderBy('p.pertanyaan_id')
            ->get();

        return $data
            ->groupBy('aspek_id')
            ->map(function ($items) {
                return [
                    'aspek' => $items->first()->nama_aspek,
                    'pertanyaan' => $items->map(function ($item) {
                        return [
                            'id' => $item->pertanyaan_id,
                            'teks' => $item->teks_pertanyaan,
                        ];
                    })->values()->all(),
                ];
            })
            ->values()
            ->all();
    }

    public static function semuaId(string $kategori): array
    {
        return collect(self::pertanyaan($kategori))
            ->pluck('pertanyaan')
            ->flatten(1)
            ->pluck('id')
            ->all();
    }
}
