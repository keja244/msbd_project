<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // [siswa_id, user_id, nisn, nis, nama_lengkap, kelas, jk, tahun_masuk, status]
        $siswa = [
            // Kelas X (angkatan 2026)
            [1, 8, '0098123401', '2026-0001', 'Aditya Pratama Nasution', 'X-1', 'L', 2026, 'Aktif'],
            [2, null, '0098123402', '2026-0002', 'Siti Nurhaliza Lubis', 'X-2', 'P', 2026, 'Aktif'],
            [3, null, '0098123403', '2026-0003', 'Rafi Alamsyah Siregar', 'X-4', 'L', 2026, 'Aktif'],
            [4, null, '0098123404', '2026-0004', 'Grace Natalia Simanjuntak', 'X-3', 'P', 2026, 'Aktif'],
            // Kelas XI (angkatan 2025)
            [5, null, '0087234501', '2025-0001', 'Muhammad Fauzan Hasibuan', 'XI-1', 'L', 2025, 'Aktif'],
            [6, null, '0087234502', '2025-0002', 'Nabila Putri Ramadhani', 'XI-2', 'P', 2025, 'Aktif'],
            [7, null, '0087234503', '2025-0003', 'Kevin Alexander Tan', 'XI-5', 'L', 2025, 'Aktif'],
            [8, null, '0087234504', '2025-0004', 'Anisa Fitriani Harahap', 'XI-3', 'P', 2025, 'Aktif'],
            // Kelas XII (angkatan 2024)
            [9, null, '0076345601', '2024-0001', 'Dimas Anggara Putra', 'XII-1', 'L', 2024, 'Aktif'],
            [10, null, '0076345602', '2024-0002', 'Maria Magdalena Sitorus', 'XII-2', 'P', 2024, 'Aktif'],
            [11, null, '0076345603', '2024-0003', 'Rizky Maulana Tarigan', 'XII-4', 'L', 2024, 'Aktif'],
            // Alumni
            [12, null, '0065456701', '2020-0001', 'Putri Ayu Wulandari', 'XII-1', 'P', 2020, 'Alumni'],
            [13, null, '0065456702', '2021-0001', 'Fadhil Akbar Batubara', 'XII-2', 'L', 2021, 'Alumni'],
            [14, null, '0065456703', '2021-0002', 'Jessica Angelina Pane', 'XII-3', 'P', 2021, 'Alumni'],
            [15, null, '0065456704', '2022-0001', 'Ahmad Zulkarnain Dalimunthe', 'XII-1', 'L', 2022, 'Alumni'],
            [16, null, '0065456705', '2022-0002', 'Nadia Salsabila Pohan', 'XII-5', 'P', 2022, 'Alumni'],
        ];

        foreach ($siswa as [$id, $userId, $nisn, $nis, $nama, $kelas, $jk, $tahunMasuk, $status]) {
            DB::table('siswa')->insert([
                'siswa_id' => $id,
                'user_id' => $userId,
                'nisn' => $nisn,
                'nama_lengkap' => $nama,
                'kelas' => $kelas,
                'jenis_kelamin' => $jk,
                'tahun_masuk' => $tahunMasuk,
                'status' => $status,
                'created_at' => '2026-11-21 01:10:00',
                'updated_at' => '2026-11-21 01:10:00',
                'deleted_at' => null,
                'nis' => $nis,
                'angkatan' => $tahunMasuk,
            ]);
        }
    }
}
