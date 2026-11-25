<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        // [id, nama_kejuaraan, tingkat, juara, tahun, penyelenggara, ekskul_id, nama_kegiatan, keterangan]
        $prestasi = [
            [1, 'Olimpiade Sains Nasional Bidang Matematika', 'Provinsi', 'Juara 2', 2026, 'Dinas Pendidikan Provinsi Sumatera Utara', null, 'Seleksi OSN Tingkat Provinsi', 'Prestasi akademik bidang matematika tingkat provinsi.'],
            [2, 'Liga Pelajar Basket Kota Medan', 'Kabupaten', 'Juara 3', 2026, 'Dinas Pendidikan Kota Medan', 4, 'Liga Basket Pelajar Putra', 'Tim basket putra meraih peringkat ketiga tingkat kota.'],
            [3, 'Lomba Karya Tulis Ilmiah Remaja Sumatera Utara', 'Provinsi', 'Juara 1', 2025, 'Balai Penelitian Daerah Sumatera Utara', 8, 'LKTI Remaja Tingkat Provinsi', 'Karya tulis bertema pengelolaan sampah plastik rumah tangga.'],
            [4, 'Kompetisi Robotik Pelajar Nasional', 'Nasional', 'Juara Harapan 1', 2025, 'Kementerian Pendidikan Dasar dan Menengah', 7, 'Kompetisi Robot Line Follower', 'Tim robotik sekolah masuk lima besar kategori line follower.'],
            [5, 'Lomba Pidato Bahasa Inggris Tingkat Provinsi', 'Provinsi', 'Juara 2', 2025, 'Dewan Pendidikan Sumatera Utara', 6, 'English Speech Competition', 'Peserta mengangkat tema pendidikan karakter.'],
            [6, 'Festival Paduan Suara Pelajar Medan', 'Kabupaten', 'Juara 1', 2024, 'Dinas Kebudayaan Kota Medan', 9, 'Festival Paduan Suara Pelajar', 'Meraih medali emas kategori paduan suara campuran.'],
            [7, 'Lomba Tari Kreasi Melayu', 'Provinsi', 'Juara 3', 2024, 'Dinas Kebudayaan Provinsi Sumatera Utara', 10, 'Festival Tari Kreasi Melayu', 'Tari kreasi bertema pesisir Sumatera Timur.'],
            [8, 'Lomba Tingkat Penggalang dan Penegak Pramuka', 'Provinsi', 'Juara 2', 2024, 'Kwartir Daerah Sumatera Utara', 1, 'Lomba Tingkat (LT) Pramuka', 'Regu penegak meraih juara 2 tingkat provinsi.'],
            [9, 'Olimpiade Sains Nasional Bidang Kimia', 'Nasional', 'Medali Perunggu', 2024, 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', null, 'OSN Tingkat Nasional', 'Peserta mewakili Provinsi Sumatera Utara.'],
            [10, 'Kejuaraan Futsal Pelajar Kota Medan', 'Kabupaten', 'Juara 2', 2023, 'Asosiasi Futsal Kota Medan', 5, 'Kejuaraan Futsal Pelajar', 'Tim futsal putra menjadi runner-up tingkat kota.'],
            [11, 'Lomba Karya Inovasi Teknologi Tepat Guna', 'Nasional', 'Juara Harapan 2', 2023, 'Balai Inovasi dan Teknologi Pendidikan', 8, 'Lomba Inovasi Teknologi', 'Inovasi alat penyaring air sederhana berbasis arang aktif.'],
            [12, 'Olimpiade Sains Provinsi Bidang Biologi', 'Provinsi', 'Juara 1', 2023, 'Dinas Pendidikan Provinsi Sumatera Utara', null, 'OSP Biologi', 'Juara 1 tingkat provinsi bidang biologi.'],
        ];

        foreach ($prestasi as [$id, $kejuaraan, $tingkat, $juara, $tahun, $penyelenggara, $ekskulId, $kegiatan, $keterangan]) {
            DB::table('prestasi')->insert([
                'prestasi_id' => $id,
                'nama_kejuaraan' => $kejuaraan,
                'tingkat' => $tingkat,
                'juara' => $juara,
                'tahun' => $tahun,
                'penyelenggara' => $penyelenggara,
                'created_at' => '2026-11-21 01:45:00',
                'updated_at' => '2026-11-21 01:45:00',
                'deleted_at' => null,
                'ekskul_id' => $ekskulId,
                'nama_kegiatan' => $kegiatan,
                'keterangan' => $keterangan,
            ]);
        }
    }
}
