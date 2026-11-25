<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 4 aspek survei wajib: Sarana Prasarana, Kurikulum, Kesiswaan, Layanan.
 *
 * ID sengaja disesuaikan dengan Database View yang sudah ada:
 *   v_hasil_survei_sarpras    -> aspek_id = 4
 *   v_hasil_survei_kesiswaan  -> aspek_id IN (5, 6)
 *   v_hasil_survei_kurikulum  -> aspek_id IN (7, 8)
 * Aspek "Layanan" memakai ID 1 (ID <= 3 diproteksi trigger agar tidak bisa dihapus).
 */
class AspekSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = '2026-11-21 00:50:00';

        $aspek = [
            [1, 'Layanan', 'Penilaian terhadap kualitas pelayanan tata usaha, administrasi, dan keterbukaan informasi sekolah kepada publik.'],
            [4, 'Sarana Prasarana', 'Penilaian terhadap kondisi, kebersihan, kelengkapan, dan kenyamanan sarana serta prasarana SMA Negeri 2 Medan.'],
            [5, 'Kesiswaan', 'Penilaian terhadap pembinaan karakter, kedisiplinan, ekstrakurikuler, dan pengembangan prestasi siswa.'],
            [7, 'Kurikulum', 'Penilaian terhadap proses pembelajaran, pelaksanaan kurikulum, penjadwalan, dan sistem penilaian.'],
        ];

        foreach ($aspek as [$id, $nama, $deskripsi]) {
            DB::table('aspek')->insert([
                'aspek_id' => $id,
                'nama_aspek' => $nama,
                'bobot' => 1.00,
                'created_at' => $timestamp,
                'deskripsi' => $deskripsi,
                'bersama' => 1,
            ]);
        }
    }
}
