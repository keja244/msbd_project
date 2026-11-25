<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Trigger `trg_before_insert_validasi_waktu_isi_survei` pada tabel partisipasi hanya mengizinkan
 * pengisian ke survei berstatus 'Aktif' yang periodenya mencakup CURDATE(). Karena itu survei 1 dan 2
 * (periode lampau) dibuat dulu dengan status 'Aktif' + periode yang mencakup hari ini, lalu
 * dirapikan menjadi 'Arsip' / 'Selesai' beserta tanggal aslinya oleh DatabaseSeeder
 * setelah seluruh partisipasi dan jawaban masuk.
 */
class SurveiSeeder extends Seeder
{
    public function run(): void
    {
        $sementaraMulai = Carbon::today()->subDays(30)->toDateString();
        $sementaraSelesai = Carbon::today()->addDays(30)->toDateString();

        $survei = [
            [
                'survei_id' => 1,
                'judul_survei' => 'Survei Kepuasan Publik SMA Negeri 2 Medan Semester Genap 2024/2025',
                'deskripsi' => 'Survei kepuasan terhadap sarana prasarana, kurikulum, kesiswaan, dan layanan sekolah pada semester genap tahun ajaran 2024/2025.',
                'tahun_ajaran' => '2024/2025',
                'semester' => 2,
                'tanggal_mulai' => $sementaraMulai,
                'tanggal_selesai' => $sementaraSelesai,
                'status' => 'Aktif', // dirapikan menjadi 'Arsip' oleh DatabaseSeeder
                'created_by' => 2,
                'created_at' => '2025-02-24 09:00:00',
            ],
            [
                'survei_id' => 2,
                'judul_survei' => 'Survei Kepuasan Publik SMA Negeri 2 Medan Semester Ganjil 2025/2026',
                'deskripsi' => 'Survei kepuasan terhadap sarana prasarana, kurikulum, kesiswaan, dan layanan sekolah pada semester ganjil tahun ajaran 2025/2026.',
                'tahun_ajaran' => '2025/2026',
                'semester' => 1,
                'tanggal_mulai' => $sementaraMulai,
                'tanggal_selesai' => $sementaraSelesai,
                'status' => 'Aktif', // dirapikan menjadi 'Selesai' oleh DatabaseSeeder
                'created_by' => 2,
                'created_at' => '2025-09-29 09:00:00',
            ],
            [
                'survei_id' => 3,
                'judul_survei' => 'Survei Kepuasan Publik SMA Negeri 2 Medan Semester Ganjil 2026/2027',
                'deskripsi' => 'Survei kepuasan terhadap sarana prasarana, kurikulum, kesiswaan, dan layanan sekolah pada semester ganjil tahun ajaran 2026/2027.',
                'tahun_ajaran' => '2026/2027',
                'semester' => 1,
                'tanggal_mulai' => Carbon::today()->subDays(14)->toDateString(),
                'tanggal_selesai' => Carbon::today()->addDays(30)->toDateString(),
                'status' => 'Aktif',
                'created_by' => 2,
                'created_at' => '2026-11-02 09:00:00',
            ],
        ];

        foreach ($survei as $row) {
            DB::table('survei')->insert($row + [
                'updated_at' => $row['created_at'],
                'deleted_at' => null,
                'metode_ikm' => 'BOTH',
                'skala_min' => 1,
                'skala_max' => 4,
                'faktor_konversi' => 25.00,
            ]);
        }
    }
}
