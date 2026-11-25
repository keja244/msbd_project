<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = '2026-11-21 00:47:30';

        $permissions = [
            [1, 'kelola_pengguna', 'Mengelola akun pengguna sistem.'],
            [2, 'kelola_role', 'Mengelola role dan hak akses pengguna.'],
            [3, 'lihat_log_aktivitas', 'Melihat log aktivitas dan audit sistem.'],
            [4, 'kelola_berita', 'Menambah, mengubah, dan menghapus berita sekolah.'],
            [5, 'kelola_guru_tendik', 'Mengelola data guru dan tenaga kependidikan.'],
            [6, 'kelola_survei', 'Membuat dan mengunggah periode survei kepuasan publik.'],
            [7, 'lihat_hasil_survei_semua', 'Melihat hasil survei dari seluruh aspek.'],
            [8, 'kelola_sarpras', 'Mengelola data dan foto sarana prasarana sekolah.'],
            [9, 'kelola_pertanyaan_sarpras', 'Membuat pertanyaan survei aspek Sarana Prasarana.'],
            [10, 'lihat_hasil_sarpras', 'Melihat hasil survei aspek Sarana Prasarana.'],
            [11, 'kelola_siswa', 'Mengelola data siswa.'],
            [12, 'kelola_alumni', 'Mengelola data alumni.'],
            [13, 'kelola_prestasi', 'Mengelola data prestasi siswa dan sekolah.'],
            [14, 'kelola_pertanyaan_kesiswaan', 'Membuat pertanyaan survei aspek Kesiswaan.'],
            [15, 'lihat_hasil_kesiswaan', 'Melihat hasil survei aspek Kesiswaan.'],
            [16, 'kelola_ppdb_akademik', 'Mengelola proses PPDB dan data akademik sekolah.'],
            [17, 'kelola_pertanyaan_kurikulum', 'Membuat pertanyaan survei aspek Kurikulum.'],
            [18, 'lihat_hasil_kurikulum', 'Melihat hasil survei aspek Kurikulum.'],
            [19, 'kelola_ekskul', 'Mengelola kegiatan dan galeri ekstrakurikuler.'],
            [20, 'kelola_berita_ekskul', 'Mengelola berita yang berkaitan dengan ekstrakurikuler.'],
            [21, 'lihat_halaman_publik', 'Melihat halaman website sekolah.'],
            [22, 'isi_survei', 'Mengisi survei kepuasan publik.'],
            [23, 'lihat_hasil_survei_publik', 'Melihat hasil survei yang telah dipublikasikan.'],
        ];

        foreach ($permissions as [$id, $nama, $deskripsi]) {
            DB::table('permissions')->insert([
                'permission_id' => $id,
                'nama_permission' => $nama,
                'deskripsi' => $deskripsi,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
