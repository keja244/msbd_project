<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Dijalankan paling akhir. Banyak trigger sudah mengisi log_aktivitas secara otomatis
 * (akun baru, berita, survei, jawaban, dsb.); seeder ini menambah jejak aktivitas manual
 * pengguna seperti login, logout, dan ekspor laporan.
 */
class LogAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        // [user_id, aksi, tabel_terkait, record_id, ip, jam_lalu]
        $log = [
            [1, 'AUTH: Super Admin berhasil login ke dashboard.', 'users', 1, '127.0.0.1', 50],
            [2, 'AUTH: Admin Humas berhasil login ke dashboard.', 'users', 2, '10.20.1.15', 46],
            [2, 'BERITA: Admin Humas membuka halaman pengelolaan berita.', 'berita', null, '10.20.1.15', 45],
            [3, 'SARPRAS: Admin Sarpras memperbarui kondisi fasilitas Lapangan Basket dan Futsal.', 'sarana_prasarana', 7, '10.20.1.21', 30],
            [4, 'SISWA: Admin Kesiswaan mengekspor daftar siswa aktif.', 'siswa', null, '10.20.1.33', 26],
            [5, 'KURIKULUM: Admin Kurikulum melihat rekap hasil survei aspek Kurikulum.', 'survei', 3, '10.20.1.40', 20],
            [6, 'EKSKUL: Admin Ekstrakurikuler mengunggah foto galeri kegiatan Paduan Suara.', 'ekskul_galeri', 9, '10.20.1.47', 14],
            [2, 'SURVEI: Admin Humas mengunduh laporan hasil survei semester ganjil 2025/2026.', 'survei', 2, '10.20.1.15', 8],
            [1, 'USER: Super Admin meninjau daftar pengguna dan role.', 'users', null, '127.0.0.1', 3],
            [1, 'AUTH: Super Admin logout dari dashboard.', 'users', 1, '127.0.0.1', 1],
        ];

        foreach ($log as [$userId, $aksi, $tabel, $recordId, $ip, $jamLalu]) {
            DB::table('log_aktivitas')->insert([
                'user_id' => $userId,
                'aksi' => $aksi,
                'tabel_terkait' => $tabel,
                'record_id' => $recordId,
                'ip_address' => $ip,
                'created_at' => Carbon::now()->subHours($jamLalu)->toDateTimeString(),
            ]);
        }
    }
}
