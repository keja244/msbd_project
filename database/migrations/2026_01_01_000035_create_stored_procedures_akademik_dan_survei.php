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
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_ambil_saran_per_aspek`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_ambil_saran_per_aspek` (IN `p_survei_id` INT, IN `p_aspek_id` INT) BEGIN
                SELECT 
                    j.jawaban_id,
                    kr.nama AS kategori_responden,
                    p.teks_pertanyaan AS pertanyaan,
                    j.isian AS kritik_saran
                FROM jawaban j
                JOIN pertanyaan p ON j.pertanyaan_id = p.pertanyaan_id
                JOIN kategori_responden kr ON j.kategori_id = kr.kategori_id
                WHERE j.survei_id = p_survei_id 
                  AND p.aspek_id = p_aspek_id 
                  AND j.isian IS NOT NULL;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_arsip_berita_kadaluarsa`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_arsip_berita_kadaluarsa` (IN `p_bulan` INT) BEGIN
                UPDATE berita 
                SET status = 'Draft' 
                WHERE status = 'Published' 
                  AND deleted_at IS NULL
                  AND created_at < NOW() - INTERVAL p_bulan MONTH;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_cek_status_kelulusan_siswa`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_cek_status_kelulusan_siswa` (IN `p_nisn` VARCHAR(20), OUT `p_nama_siswa` VARCHAR(100), OUT `p_status_kelulusan` VARCHAR(20)) BEGIN
              SET p_nama_siswa = NULL;
              SET p_status_kelulusan = 'Tidak Ditemukan';
              SELECT nama_lengkap, status INTO p_nama_siswa, p_status_kelulusan
              FROM siswa
              WHERE nisn = p_nisn AND deleted_at IS NULL;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_laporan_prestasi_sekolah`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_laporan_prestasi_sekolah` (IN `p_tingkat` VARCHAR(50)) BEGIN
                SELECT 
                    p.prestasi_id,
                    p.nama_kejuaraan,
                    p.juara,
                    p.tingkat,
                    p.tahun,
                    p.penyelenggara
                FROM prestasi p
                WHERE (p.tingkat = p_tingkat OR p_tingkat IS NULL)
                  AND p.deleted_at IS NULL
                ORDER BY p.tahun DESC;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_mutasi_siswa_ke_alumni`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_mutasi_siswa_ke_alumni` (IN `p_angkatan` INT, IN `p_tahun_lulus` YEAR, IN `p_perguruan_tinggi` VARCHAR(150), IN `p_jenjang_lanjutan` VARCHAR(100), IN `p_jurusan_lanjutan` VARCHAR(100), IN `p_jalur_masuk` VARCHAR(100)) BEGIN
              DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN ROLLBACK; RESIGNAL; END;
              START TRANSACTION;

              UPDATE siswa
              SET status = 'Alumni'
              WHERE angkatan = p_angkatan AND status = 'Aktif' AND deleted_at IS NULL;

              INSERT INTO alumni
                (siswa_id, tahun_lulus, perguruan_tinggi, jenjang_lanjutan,
                 jurusan_lanjutan, jalur_masuk)
              SELECT siswa_id, p_tahun_lulus, p_perguruan_tinggi, p_jenjang_lanjutan,
                     p_jurusan_lanjutan, p_jalur_masuk
              FROM siswa
              WHERE angkatan = p_angkatan AND status = 'Alumni' AND deleted_at IS NULL
              ON DUPLICATE KEY UPDATE
                tahun_lulus        = VALUES(tahun_lulus),
                perguruan_tinggi   = VALUES(perguruan_tinggi),
                jenjang_lanjutan   = VALUES(jenjang_lanjutan),
                jurusan_lanjutan   = VALUES(jurusan_lanjutan),
                jalur_masuk        = VALUES(jalur_masuk);

              COMMIT;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_mutasi_siswa_lulus`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_mutasi_siswa_lulus` (IN `p_tahun_masuk` YEAR) BEGIN
                UPDATE siswa 
                SET status = 'Lulus'
                WHERE tahun_masuk = p_tahun_masuk 
                  AND status = 'Aktif' 
                  AND deleted_at IS NULL;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_proses_kenaikan_tingkat_kelas`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_proses_kenaikan_tingkat_kelas` (IN `p_siswa_id` INT, INOUT `p_tahun_masuk` INT) BEGIN
                SET p_tahun_masuk = p_tahun_masuk + 1;
                
                UPDATE siswa 
                SET tahun_masuk = p_tahun_masuk 
                WHERE siswa_id = p_siswa_id AND deleted_at IS NULL;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_rekap_nilai_ikm`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_rekap_nilai_ikm` (IN `p_survei_id` INT) BEGIN
                SELECT 
                    a.nama_aspek,
                    COUNT(j.jawaban_id) AS total_responden_aspek,
                    ROUND(AVG(j.skor), 2) AS rata_rata_skor
                FROM jawaban j
                JOIN pertanyaan p ON j.pertanyaan_id = p.pertanyaan_id
                JOIN aspek a ON p.aspek_id = a.aspek_id
                WHERE j.survei_id = p_survei_id AND j.skor IS NOT NULL
                GROUP BY a.aspek_id, a.nama_aspek;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_salin_pertanyaan_survei`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_salin_pertanyaan_survei` (IN `p_survei_id` INT, IN `p_aspek_sumber_id` INT, IN `p_teks_baru` TEXT, IN `p_jenis` VARCHAR(10), IN `p_urutan` INT) BEGIN
                INSERT INTO pertanyaan (survei_id, aspek_id, teks_pertanyaan, jenis, urutan)
                VALUES (p_survei_id, p_aspek_sumber_id, p_teks_baru, p_jenis, p_urutan);
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_submit_partisipasi_mixed`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_submit_partisipasi_mixed` (IN `p_survei_id` INT, IN `p_kategori_id` INT, IN `p_responden_tipe` VARCHAR(20), IN `p_siswa_id` INT, IN `p_guru_tendik_id` INT, IN `p_identitas_hash` CHAR(64), IN `p_ip_address` VARCHAR(45), IN `p_pertanyaan_id` INT, IN `p_skor` TINYINT, IN `p_isian` TEXT, OUT `p_partisipasi_id` INT) BEGIN
              DECLARE v_survei INT DEFAULT 0;
              DECLARE v_pid INT DEFAULT NULL;
              DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN ROLLBACK; RESIGNAL; END;

              START TRANSACTION;

              IF p_skor IS NOT NULL AND (p_skor < 1 OR p_skor > 4) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Skor harus 1 sampai 4';
              END IF;

              SELECT COUNT(*) INTO v_survei FROM survei
              WHERE survei_id = p_survei_id AND status = 'Aktif'
                AND deleted_at IS NULL
                AND CURDATE() BETWEEN tanggal_mulai AND tanggal_selesai;
              IF v_survei = 0 THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Survei tidak aktif atau di luar periode';
              END IF;

              -- Reuse existing partisipasi (locked) or create it; unique keys backstop races
              SELECT partisipasi_id INTO v_pid
              FROM partisipasi
              WHERE survei_id = p_survei_id
                AND responden_tipe = p_responden_tipe
                AND ( (p_responden_tipe = 'SISWA'       AND siswa_id        <=> p_siswa_id)
                   OR (p_responden_tipe = 'GURU_TENDIK' AND guru_tendik_id  <=> p_guru_tendik_id)
                   OR (p_responden_tipe = 'ANONIM'      AND identitas_hash  <=> p_identitas_hash) )
              FOR UPDATE;

              IF v_pid IS NULL THEN
                INSERT INTO partisipasi
                  (survei_id, kategori_id, siswa_id, guru_tendik_id,
                   identitas_hash, responden_tipe, ip_address)
                VALUES
                  (p_survei_id, p_kategori_id, p_siswa_id, p_guru_tendik_id,
                   p_identitas_hash, p_responden_tipe, p_ip_address);
                SET v_pid = LAST_INSERT_ID();
              END IF;

              SET p_partisipasi_id = v_pid;

              INSERT INTO jawaban (survei_id, partisipasi_id, pertanyaan_id, kategori_id, skor, isian)
              VALUES (p_survei_id, v_pid, p_pertanyaan_id, p_kategori_id, p_skor, p_isian);

              COMMIT;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_submit_partisipasi_mixed`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_salin_pertanyaan_survei`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_rekap_nilai_ikm`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_proses_kenaikan_tingkat_kelas`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_mutasi_siswa_lulus`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_mutasi_siswa_ke_alumni`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_laporan_prestasi_sekolah`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_cek_status_kelulusan_siswa`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_arsip_berita_kadaluarsa`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_ambil_saran_per_aspek`');
    }
};
