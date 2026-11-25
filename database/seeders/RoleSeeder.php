<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = '2026-11-21 00:47:02';

        $roles = [
            [1, 'Super Admin', 'Memiliki hak akses penuh untuk mengelola seluruh fitur, data, pengguna, role, dan seluruh aktivitas sistem website sekolah.'],
            [2, 'Humas', 'Mengelola berita sekolah, menambahkan data guru dan tenaga kependidikan (tendik), mengunggah survei, serta melihat hasil survei dari seluruh aspek.'],
            [3, 'Sarpras', 'Mengelola informasi sarana dan prasarana sekolah, mengunggah gambar dan penjelasan sarpras, membuat pertanyaan survei aspek sarpras, serta melihat hasil survei khusus aspek sarpras.'],
            [4, 'Kesiswaan', 'Mengelola data siswa, alumni, dan prestasi siswa, membuat pertanyaan survei aspek kesiswaan, serta melihat hasil survei khusus aspek kesiswaan.'],
            [5, 'Kurikulum', 'Mengelola seluruh proses PPDB dan data akademik sekolah, membuat pertanyaan survei aspek kurikulum, serta melihat hasil survei khusus aspek kurikulum.'],
            [6, 'Ekstrakulikuler', 'Mengelola kegiatan, prestasi, dan berita yang berkaitan dengan kegiatan ekstrakurikuler sekolah.'],
            [7, 'Guru dan Tendik', 'Memiliki akses untuk melihat halaman website sekolah, mengisi survei, serta melihat hasil survei yang telah dipublikasikan oleh pengelola.'],
            [8, 'Siswa', 'Memiliki akses untuk melihat halaman website sekolah, mengisi survei, serta melihat hasil survei yang telah dipublikasikan oleh pengelola.'],
        ];

        foreach ($roles as [$id, $nama, $deskripsi]) {
            DB::table('roles')->insert([
                'role_id' => $id,
                'nama_role' => $nama,
                'deskripsi' => $deskripsi,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
