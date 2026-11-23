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
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_cek_status_akun`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_cek_status_akun` (`p_user_id` INT) RETURNS VARCHAR(20) CHARSET utf8mb4 READS SQL DATA SQL SECURITY INVOKER BEGIN
              DECLARE v_deleted_at TIMESTAMP;
              DECLARE v_db_status VARCHAR(20);
              SELECT deleted_at, status INTO v_deleted_at, v_db_status
              FROM users WHERE user_id = p_user_id;
              IF v_deleted_at IS NOT NULL THEN RETURN 'Terkunci';
              ELSEIF v_db_status = 'Nonaktif' THEN RETURN 'Nonaktif';
              ELSEIF v_db_status = 'Aktif' THEN RETURN 'Aktif';
              ELSE RETURN 'Tidak Ditemukan';
              END IF;
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_jumlah_siswa_per_kelas`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_hitung_jumlah_siswa_per_kelas` (`p_kelas` VARCHAR(20)) RETURNS INT READS SQL DATA SQL SECURITY INVOKER BEGIN
              DECLARE v_total INT;
              SELECT COUNT(*) INTO v_total FROM siswa
              WHERE kelas = p_kelas AND status = 'Aktif' AND deleted_at IS NULL;
              RETURN v_total;
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_rata_ikm`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_hitung_rata_ikm` (`p_survei_id` INT) RETURNS DECIMAL(4,2) READS SQL DATA SQL SECURITY INVOKER BEGIN
              DECLARE v_rata DECIMAL(4,2);
              SELECT COALESCE(AVG(skor), 0.00) INTO v_rata FROM jawaban
              WHERE survei_id = p_survei_id AND skor IS NOT NULL;
              RETURN v_rata;
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_rata_skor_fleksibel`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_hitung_rata_skor_fleksibel` (`p_survei_id` INT, `p_aspek_id` INT) RETURNS DECIMAL(4,2) READS SQL DATA SQL SECURITY INVOKER BEGIN
              DECLARE v_rata DECIMAL(4,2);
              IF p_aspek_id IS NULL THEN
                SELECT COALESCE(AVG(skor), 0.00) INTO v_rata FROM jawaban
                WHERE survei_id = p_survei_id AND skor IS NOT NULL;
              ELSE
                SELECT COALESCE(AVG(j.skor), 0.00) INTO v_rata
                FROM jawaban j
                JOIN pertanyaan p ON j.pertanyaan_id = p.pertanyaan_id
                WHERE j.survei_id = p_survei_id AND p.aspek_id = p_aspek_id
                  AND j.skor IS NOT NULL;
              END IF;
              RETURN v_rata;
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_sisa_hari_survei`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_hitung_sisa_hari_survei` (`p_survei_id` INT) RETURNS INT READS SQL DATA SQL SECURITY INVOKER BEGIN
              DECLARE v_sisa INT;
              SELECT DATEDIFF(tanggal_selesai, CURDATE()) INTO v_sisa
              FROM survei WHERE survei_id = p_survei_id AND deleted_at IS NULL;
              RETURN COALESCE(v_sisa, 0);
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_is_survei_berjalan`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_is_survei_berjalan` (`p_survei_id` INT) RETURNS TINYINT READS SQL DATA SQL SECURITY INVOKER BEGIN
              RETURN EXISTS(
                SELECT 1 FROM survei
                WHERE survei_id = p_survei_id AND status = 'Aktif'
                  AND deleted_at IS NULL
                  AND CURDATE() BETWEEN tanggal_mulai AND tanggal_selesai
              );
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_konversi_ikm_both`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_konversi_ikm_both` (`p_skor` DECIMAL(8,4)) RETURNS DECIMAL(8,2) DETERMINISTIC BEGIN
              IF p_skor IS NULL OR p_skor < 1 OR p_skor > 4 THEN RETURN NULL; END IF;
              RETURN ROUND(p_skor * 25.00, 2);
            END
            SQL);

        DB::unprepared('DROP FUNCTION IF EXISTS `fn_konversi_predikat_mutu`');

        DB::unprepared(<<<SQL
            CREATE FUNCTION `fn_konversi_predikat_mutu` (`p_skor` DECIMAL(4,2)) RETURNS VARCHAR(15) CHARSET utf8mb4 DETERMINISTIC BEGIN
                DECLARE v_predikat VARCHAR(15);
                
                IF p_skor >= 3.50 THEN
                    SET v_predikat = 'Sangat Baik';
                ELSEIF p_skor >= 2.50 THEN
                    SET v_predikat = 'Baik';
                ELSEIF p_skor >= 1.50 THEN
                    SET v_predikat = 'Cukup';
                ELSEIF p_skor >= 1.00 THEN
                    SET v_predikat = 'Kurang';
                ELSE
                    SET v_predikat = 'Belum Dinilai';
                END IF;
                
                RETURN v_predikat;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_konversi_predikat_mutu`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_konversi_ikm_both`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_is_survei_berjalan`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_sisa_hari_survei`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_rata_skor_fleksibel`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_rata_ikm`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_hitung_jumlah_siswa_per_kelas`');
        DB::unprepared('DROP FUNCTION IF EXISTS `fn_cek_status_akun`');
    }
};
