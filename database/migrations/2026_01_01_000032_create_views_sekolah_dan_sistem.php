<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_direktori_siswa_aktif_lengkap` AS
            SELECT
                `s`.`siswa_id` AS `siswa_id`,
                `s`.`nisn` AS `nisn`,
                `s`.`nama_lengkap` AS `nama_lengkap`,
                `s`.`kelas` AS `kelas`,
                `u`.`username` AS `username`,
                `u`.`created_at` AS `tanggal_akun_dibuat`
            FROM (`siswa` `s` left join `users` `u` on((`s`.`user_id` = `u`.`user_id`)))
            WHERE ((`s`.`status` = 'Aktif') AND (`s`.`deleted_at` is null))
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_rekap_jumlah_siswa_per_kelas` AS
            SELECT
                `siswa`.`kelas` AS `kelas`,
                `siswa`.`status` AS `status`,
                count(0) AS `total_siswa`
            FROM `siswa`
            WHERE (`siswa`.`deleted_at` is null)
            GROUP BY `siswa`.`kelas`, `siswa`.`status`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_rekapitulasi_prestasi_per_siswa` AS
            SELECT
                `s`.`siswa_id` AS `siswa_id`,
                `s`.`nisn` AS `nisn`,
                `s`.`nama_lengkap` AS `nama_lengkap`,
                `s`.`kelas` AS `kelas`,
                count(`ps`.`prestasi_id`) AS `total_prestasi_diraih`
            FROM (`siswa` `s` left join `prestasi_siswa` `ps` on((`s`.`siswa_id` = `ps`.`siswa_id`)))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `s`.`siswa_id`, `s`.`nisn`, `s`.`nama_lengkap`, `s`.`kelas`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_klasifikasi_prestasi_siswa_advanced` AS
            SELECT
                `s`.`siswa_id` AS `siswa_id`,
                `s`.`nisn` AS `nisn`,
                `s`.`nama_lengkap` AS `nama_lengkap`,
                `s`.`kelas` AS `kelas`,
                coalesce(`x`.`jumlah_medali`,0) AS `jumlah_medali`,
                (case when (coalesce(`x`.`jumlah_medali`,0) >= 3) then 'Siswa Berprestasi Utama' when (coalesce(`x`.`jumlah_medali`,0) between 1 and 2) then 'Siswa Aktif Berprestasi' else 'Belum Ada Rekor Kejuaraan' end) AS `kategori_prestasi`
            FROM (`siswa` `s` left join (select `prestasi_siswa`.`siswa_id` AS `siswa_id`,count(0) AS `jumlah_medali` from `prestasi_siswa` group by `prestasi_siswa`.`siswa_id`) `x` on((`x`.`siswa_id` = `s`.`siswa_id`)))
            WHERE ((`s`.`status` = 'Aktif') AND (`s`.`deleted_at` is null))
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_prestasi_ekskul` AS
            SELECT
                `prestasi`.`prestasi_id` AS `prestasi_id`,
                `prestasi`.`nama_kejuaraan` AS `nama_kejuaraan`,
                `prestasi`.`tingkat` AS `tingkat`,
                `prestasi`.`juara` AS `juara`,
                `prestasi`.`tahun` AS `tahun`,
                `prestasi`.`penyelenggara` AS `penyelenggara`,
                `prestasi`.`created_at` AS `created_at`,
                `prestasi`.`updated_at` AS `updated_at`,
                `prestasi`.`deleted_at` AS `deleted_at`,
                `prestasi`.`ekskul_id` AS `ekskul_id`,
                `prestasi`.`nama_kegiatan` AS `nama_kegiatan`,
                `prestasi`.`keterangan` AS `keterangan`
            FROM `prestasi`
            WHERE (`prestasi`.`ekskul_id` is not null)
            WITH CASCADED CHECK OPTION
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_berita_ekskul` AS
            SELECT
                `berita`.`berita_id` AS `berita_id`,
                `berita`.`judul` AS `judul`,
                `berita`.`slug` AS `slug`,
                `berita`.`konten` AS `konten`,
                `berita`.`kategori` AS `kategori`,
                `berita`.`status` AS `status`,
                `berita`.`created_at` AS `created_at`,
                `berita`.`updated_at` AS `updated_at`,
                `berita`.`deleted_at` AS `deleted_at`,
                `berita`.`user_id` AS `user_id`,
                `berita`.`gambar_utama` AS `gambar_utama`
            FROM `berita`
            WHERE (`berita`.`kategori` = 'Ekstrakurikuler')
            WITH CASCADED CHECK OPTION
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_inventaris_sarpras_aktif` AS
            SELECT
                `sarana_prasarana`.`sarpras_id` AS `sarpras_id`,
                `sarana_prasarana`.`nama_fasilitas` AS `nama_fasilitas`,
                `sarana_prasarana`.`kategori` AS `kategori`,
                `sarana_prasarana`.`kondisi` AS `kondisi`,
                `sarana_prasarana`.`jumlah` AS `jumlah`,
                `sarana_prasarana`.`keterangan` AS `keterangan`
            FROM `sarana_prasarana`
            WHERE (`sarana_prasarana`.`deleted_at` is null)
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_riwayat_aktivitas_pengguna_terbaru` AS
            SELECT
                `l`.`log_id` AS `log_id`,
                coalesce(`u`.`username`,'System / Guest') AS `username`,
                `l`.`aksi` AS `aksi`,
                `l`.`created_at` AS `created_at`,
                `l`.`ip_address` AS `ip_address`
            FROM (`log_aktivitas` `l` left join `users` `u` on((`l`.`user_id` = `u`.`user_id`)))
            ORDER BY `l`.`created_at` DESC
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_status_keaktifan_pengguna_sistem` AS
            SELECT
                `u`.`user_id` AS `user_id`,
                `u`.`username` AS `username`,
                `l`.`aktivitas_terakhir` AS `aktivitas_terakhir`,
                (case when (`l`.`aktivitas_terakhir` >= (now() - interval 7 day)) then 'Sangat Aktif' when (`l`.`aktivitas_terakhir` is not null) then 'Cukup Aktif' else 'Pasif / Belum Pernah Aktif' end) AS `status_keaktifan`
            FROM (`users` `u` left join (select `log_aktivitas`.`user_id` AS `user_id`,max(`log_aktivitas`.`created_at`) AS `aktivitas_terakhir` from `log_aktivitas` group by `log_aktivitas`.`user_id`) `l` on((`l`.`user_id` = `u`.`user_id`)))
            WHERE (`u`.`deleted_at` is null)
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS `v_status_keaktifan_pengguna_sistem`');
        DB::unprepared('DROP VIEW IF EXISTS `v_riwayat_aktivitas_pengguna_terbaru`');
        DB::unprepared('DROP VIEW IF EXISTS `v_inventaris_sarpras_aktif`');
        DB::unprepared('DROP VIEW IF EXISTS `v_berita_ekskul`');
        DB::unprepared('DROP VIEW IF EXISTS `v_prestasi_ekskul`');
        DB::unprepared('DROP VIEW IF EXISTS `v_klasifikasi_prestasi_siswa_advanced`');
        DB::unprepared('DROP VIEW IF EXISTS `v_rekapitulasi_prestasi_per_siswa`');
        DB::unprepared('DROP VIEW IF EXISTS `v_rekap_jumlah_siswa_per_kelas`');
        DB::unprepared('DROP VIEW IF EXISTS `v_direktori_siswa_aktif_lengkap`');
    }
};
