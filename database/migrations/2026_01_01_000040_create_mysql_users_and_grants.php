<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ambil nama database dan host dari konfigurasi koneksi Laravel (.env)
        $db = config('database.connections.mysql.database', 'msbd_project');
        $host = 'localhost'; // Sesuaikan ke '%' jika akses dari container/remote host

        // =========================================================================
        // 1. BUAT VIEW KHUSUS UNTUK PEMBATASAN AKSES PER ASPEK & KATEGORI (RLS)
        // =========================================================================
        
        // Role SARPRAS (Aspek 4)
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_pertanyaan_sarpras` AS
            SELECT * FROM `{$db}`.`pertanyaan` WHERE `aspek_id` = 4
            WITH CHECK OPTION;
        ");
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_hasil_survei_sarpras` AS
            SELECT * FROM `{$db}`.`v_rekap_rata_rata_ikm_per_aspek` WHERE `aspek_id` = 4;
        ");

        // Role KESISWAAN (Aspek 5 & 6)
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_pertanyaan_kesiswaan` AS
            SELECT * FROM `{$db}`.`pertanyaan` WHERE `aspek_id` IN (5, 6)
            WITH CHECK OPTION;
        ");
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_hasil_survei_kesiswaan` AS
            SELECT * FROM `{$db}`.`v_rekap_rata_rata_ikm_per_aspek` WHERE `aspek_id` IN (5, 6);
        ");

        // Role KURIKULUM (Aspek 7 & 8)
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_pertanyaan_kurikulum` AS
            SELECT * FROM `{$db}`.`pertanyaan` WHERE `aspek_id` IN (7, 8)
            WITH CHECK OPTION;
        ");
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_hasil_survei_kurikulum` AS
            SELECT * FROM `{$db}`.`v_rekap_rata_rata_ikm_per_aspek` WHERE `aspek_id` IN (7, 8);
        ");

        // Role EKSTRAKURIKULER (Berita & Prestasi khusus Ekskul)
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_berita_ekskul` AS
            SELECT * FROM `{$db}`.`berita` WHERE `kategori` = 'Ekstrakurikuler'
            WITH CHECK OPTION;
        ");
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_prestasi_ekskul` AS
            SELECT * FROM `{$db}`.`prestasi` WHERE `ekskul_id` IS NOT NULL
            WITH CHECK OPTION;
        ");

        // Role PUBLIK / RESPONDEN (Hasil survei yang sudah Selesai/Dipublikasikan)
        DB::unprepared("
            CREATE OR REPLACE SQL SECURITY DEFINER VIEW `{$db}`.`v_hasil_survei_publik` AS
            SELECT r.* 
            FROM `{$db}`.`v_rekap_ikm_both` r
            JOIN `{$db}`.`survei` s ON r.`survei_id` = s.`survei_id`
            WHERE s.`status` = 'Selesai' AND s.`deleted_at` IS NULL;
        ");

        // =========================================================================
        // 2. PEMBUATAN USER MYSQL
        // =========================================================================
        $users = [
            'u_superadmin'  => 'SuperAdmin#2026!',
            'u_humas'       => 'Humas#2026!',
            'u_sarpras'     => 'Sarpras#2026!',
            'u_kesiswaan'   => 'Kesiswaan#2026!',
            'u_kurikulum'   => 'Kurikulum#2026!',
            'u_ekskul'      => 'Ekskul#2026!',
            'u_guru_tendik' => 'GuruTendik#2026!',
            'u_siswa'       => 'Siswa#2026!',
            'u_masyarakat'  => 'Masyarakat#2026!',
        ];

        foreach ($users as $username => $password) {
            DB::unprepared("DROP USER IF EXISTS '{$username}'@'{$host}';");
            DB::unprepared("CREATE USER '{$username}'@'{$host}' IDENTIFIED BY '{$password}';");
        }

        // =========================================================================
        // 3. GRANT ACCESS (HAK AKSES) SESUAI ARAHAN ROLE
        // =========================================================================

        // --- A. SUPER ADMIN (Kelola Semua) ---
        DB::unprepared("GRANT ALL PRIVILEGES ON `{$db}`.* TO 'u_superadmin'@'{$host}' WITH GRANT OPTION;");

        // --- B. HUMAS ---
        $humasGrants = [
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`berita` TO 'u_humas'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`berita_foto` TO 'u_humas'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_arsip_berita_kadaluarsa` TO 'u_humas'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`guru_tendik` TO 'u_humas'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`survei` TO 'u_humas'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`aspek_kategori` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`aspek` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`pertanyaan` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`pertanyaan_opsi` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`kategori_responden` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_rekap_ikm_both` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_rekap_rata_rata_ikm_per_aspek` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_rekap_predikat_mutu_survei` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_ikm_both_per_kategori` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_ranking_aspek_ikm` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_statistik_partisipasi_responden` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_ringkasan_progres_survei` TO 'u_humas'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_analisis_target_partisipasi_survei` TO 'u_humas'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_rekap_nilai_ikm` TO 'u_humas'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_ambil_saran_per_aspek` TO 'u_humas'@'{$host}'",
        ];
        foreach ($humasGrants as $sql) {
            DB::unprepared($sql);
        }

        // --- C. SARPRAS ---
        $sarprasGrants = [
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`sarana_prasarana` TO 'u_sarpras'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_inventaris_sarpras_aktif` TO 'u_sarpras'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`v_pertanyaan_sarpras` TO 'u_sarpras'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`pertanyaan_opsi` TO 'u_sarpras'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`survei` TO 'u_sarpras'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`aspek` TO 'u_sarpras'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_hasil_survei_sarpras` TO 'u_sarpras'@'{$host}'",
        ];
        foreach ($sarprasGrants as $sql) {
            DB::unprepared($sql);
        }

        // --- D. KESISWAAN ---
        $kesiswaanGrants = [
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`siswa` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`alumni` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`prestasi` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`prestasi_siswa` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_direktori_siswa_aktif_lengkap` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_rekapitulasi_prestasi_per_siswa` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_klasifikasi_prestasi_siswa_advanced` TO 'u_kesiswaan'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_mutasi_siswa_ke_alumni` TO 'u_kesiswaan'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_buat_akun_otomatis_siswa` TO 'u_kesiswaan'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_laporan_prestasi_sekolah` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`v_pertanyaan_kesiswaan` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`pertanyaan_opsi` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`survei` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`aspek` TO 'u_kesiswaan'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_hasil_survei_kesiswaan` TO 'u_kesiswaan'@'{$host}'",
        ];
        foreach ($kesiswaanGrants as $sql) {
            DB::unprepared($sql);
        }

        // --- E. KURIKULUM ---
        $kurikulumGrants = [
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`siswa` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`guru_tendik` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_rekap_jumlah_siswa_per_kelas` TO 'u_kurikulum'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_proses_kenaikan_tingkat_kelas` TO 'u_kurikulum'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_mutasi_siswa_lulus` TO 'u_kurikulum'@'{$host}'",
            "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_cek_status_kelulusan_siswa` TO 'u_kurikulum'@'{$host}'",
            "GRANT EXECUTE ON FUNCTION `{$db}`.`fn_hitung_jumlah_siswa_per_kelas` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`v_pertanyaan_kurikulum` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`pertanyaan_opsi` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`survei` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`aspek` TO 'u_kurikulum'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`v_hasil_survei_kurikulum` TO 'u_kurikulum'@'{$host}'",
        ];
        foreach ($kurikulumGrants as $sql) {
            DB::unprepared($sql);
        }

        // --- F. EKSTRAKURIKULER ---
        $ekskulGrants = [
            "GRANT SELECT, INSERT, UPDATE ON `{$db}`.`ekskul_master` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`ekskul_aktivitas` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`ekskul_galeri` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`ekskul_organisasi` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`v_prestasi_ekskul` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`prestasi_siswa` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT ON `{$db}`.`siswa` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`v_berita_ekskul` TO 'u_ekskul'@'{$host}'",
            "GRANT SELECT, INSERT, UPDATE, DELETE ON `{$db}`.`berita_foto` TO 'u_ekskul'@'{$host}'",
        ];
        foreach ($ekskulGrants as $sql) {
            DB::unprepared($sql);
        }

        // --- G. GURU & TENDIK, SISWA, MASYARAKAT (Responden & Pengunjung Web) ---
        $respondenUsers = ['u_guru_tendik', 'u_siswa', 'u_masyarakat'];
        foreach ($respondenUsers as $rUser) {
            $respondenGrants = [
                "GRANT SELECT ON `{$db}`.`berita` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`berita_foto` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`v_inventaris_sarpras_aktif` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`ekskul_master` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`ekskul_aktivitas` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`ekskul_galeri` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`prestasi` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`survei` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`aspek` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`pertanyaan` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`pertanyaan_opsi` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`kategori_responden` TO '{$rUser}'@'{$host}'",
                "GRANT INSERT ON `{$db}`.`partisipasi` TO '{$rUser}'@'{$host}'",
                "GRANT INSERT ON `{$db}`.`jawaban` TO '{$rUser}'@'{$host}'",
                "GRANT EXECUTE ON PROCEDURE `{$db}`.`sp_submit_partisipasi_mixed` TO '{$rUser}'@'{$host}'",
                "GRANT SELECT ON `{$db}`.`v_hasil_survei_publik` TO '{$rUser}'@'{$host}'",
            ];
            foreach ($respondenGrants as $sql) {
                DB::unprepared($sql);
            }
        }

        DB::unprepared("FLUSH PRIVILEGES;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $db = config('database.connections.mysql.database', 'msbd_project');
        $host = 'localhost';

        // 1. Hapus semua user MySQL yang dibuat
        $users = [
            'u_superadmin',
            'u_humas',
            'u_sarpras',
            'u_kesiswaan',
            'u_kurikulum',
            'u_ekskul',
            'u_guru_tendik',
            'u_siswa',
            'u_masyarakat',
        ];

        foreach ($users as $username) {
            DB::unprepared("DROP USER IF EXISTS '{$username}'@'{$host}';");
        }

        // 2. Hapus semua View pembatas akses (RLS)
        $views = [
            'v_pertanyaan_sarpras',
            'v_hasil_survei_sarpras',
            'v_pertanyaan_kesiswaan',
            'v_hasil_survei_kesiswaan',
            'v_pertanyaan_kurikulum',
            'v_hasil_survei_kurikulum',
            'v_berita_ekskul',
            'v_prestasi_ekskul',
            'v_hasil_survei_publik',
        ];

        foreach ($views as $view) {
            DB::unprepared("DROP VIEW IF EXISTS `{$db}`.`{$view}`;");
        }

        DB::unprepared("FLUSH PRIVILEGES;");
    }
};