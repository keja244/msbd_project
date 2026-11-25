<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seluruh tabel yang diisi oleh seeder. Tabel `migrations` sengaja tidak disentuh
     * karena dikelola langsung oleh `php artisan migrate`.
     */
    private array $tabel = [
        'jawaban', 'partisipasi', 'pertanyaan_kategori', 'pertanyaan_opsi', 'pertanyaan',
        'aspek_kategori', 'survei', 'prestasi_siswa', 'prestasi', 'ekskul_organisasi',
        'ekskul_galeri', 'ekskul_aktivitas', 'ekskul_master', 'berita_foto', 'berita',
        'sarana_prasarana', 'alumni', 'guru_tendik', 'siswa', 'role_aspek', 'role_permissions',
        'password_reset_tokens', 'login_attempts', 'log_aktivitas', 'sessions', 'users',
        'kategori_responden', 'aspek', 'permissions', 'roles',
    ];

    public function run(): void
    {
        // Kosongkan data lama agar seeder aman dijalankan berulang (TRUNCATE tidak memicu trigger).
        Schema::disableForeignKeyConstraints();
        foreach ($this->tabel as $nama) {
            DB::table($nama)->truncate();
        }
        Schema::enableForeignKeyConstraints();

        // Urutan mengikuti dependensi foreign key: tabel induk -> tabel anak/relasi.
        $this->call([
            // 1. Akses & master data
            RoleSeeder::class,
            PermissionSeeder::class,
            AspekSeeder::class,
            KategoriRespondenSeeder::class,
            UserSeeder::class,
            RolePermissionSeeder::class,
            RoleAspekSeeder::class,

            // 2. Direktori sekolah
            SiswaSeeder::class,
            GuruTendikSeeder::class,
            AlumniSeeder::class,

            // 3. Survei kepuasan publik (induk -> anak)
            SurveiSeeder::class,
            AspekKategoriSeeder::class,

            // 4. Konten & kegiatan sekolah
            BeritaSeeder::class,
            BeritaFotoSeeder::class,
            EkskulMasterSeeder::class,
            EkskulAktivitasSeeder::class,
            EkskulGaleriSeeder::class,
            EkskulOrganisasiSeeder::class,
            PrestasiSeeder::class,
            PrestasiSiswaSeeder::class,
            SaranaPrasaranaSeeder::class,

            // 5. Kuesioner, partisipasi, dan jawaban
            PertanyaanSeeder::class,
            PertanyaanOpsiSeeder::class,
            PertanyaanKategoriSeeder::class,
            PartisipasiSeeder::class,
            JawabanSeeder::class,
        ]);

        $this->rapikanStatusSurvei();

        $this->call([
            // 6. Keamanan & log (log paling akhir karena trigger ikut mengisinya)
            LoginAttemptSeeder::class,
            PasswordResetTokenSeeder::class,
            SessionSeeder::class,
            LogAktivitasSeeder::class,
        ]);
    }

    /**
     * Partisipasi hanya bisa dimasukkan ke survei 'Aktif' yang periodenya mencakup hari ini (trigger),
     * sehingga survei lampau baru ditutup setelah seluruh partisipasi dan jawaban masuk.
     * Perubahan Aktif -> Arsip/Selesai diizinkan oleh trigger kunci survei.
     */
    private function rapikanStatusSurvei(): void
    {
        DB::table('survei')->where('survei_id', 1)->update([
            'status' => 'Arsip',
            'tanggal_mulai' => '2025-03-03',
            'tanggal_selesai' => '2025-03-28',
        ]);

        DB::table('survei')->where('survei_id', 2)->update([
            'status' => 'Selesai',
            'tanggal_mulai' => '2025-10-06',
            'tanggal_selesai' => '2025-11-07',
        ]);
    }
}
