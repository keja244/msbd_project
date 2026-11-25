<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // [alumni_id, siswa_id, tahun_lulus, perguruan_tinggi, jenjang, jurusan, jalur_masuk, pekerjaan]
        $alumni = [
            [1, 12, 2023, 'Universitas Sumatera Utara', 'S1', 'Pendidikan Dokter', 'SNBP', 'Mahasiswa'],
            [2, 13, 2024, 'Institut Teknologi Bandung', 'S1', 'Teknik Informatika', 'SNBT', 'Mahasiswa'],
            [3, 14, 2024, 'Universitas Indonesia', 'S1', 'Akuntansi', 'Mandiri', 'Mahasiswa'],
            [4, 15, 2025, 'Universitas Negeri Medan', 'S1', 'Pendidikan Matematika', 'SNBP', 'Mahasiswa'],
            [5, 16, 2025, 'Politeknik Negeri Medan', 'D4', 'Teknik Listrik', 'Mandiri', 'Mahasiswa dan pengajar bimbingan belajar'],
        ];

        foreach ($alumni as [$id, $siswaId, $tahun, $pt, $jenjang, $jurusan, $jalur, $pekerjaan]) {
            DB::table('alumni')->insert([
                'alumni_id' => $id,
                'siswa_id' => $siswaId,
                'tahun_lulus' => $tahun,
                'perguruan_tinggi' => $pt,
                'jenjang_lanjutan' => $jenjang,
                'jurusan_lanjutan' => $jurusan,
                'jalur_masuk' => $jalur,
                'pekerjaan_saat_ini' => $pekerjaan,
                'created_at' => '2026-11-21 01:20:00',
                'updated_at' => '2026-11-21 01:20:00',
                'deleted_at' => null,
            ]);
        }
    }
}
