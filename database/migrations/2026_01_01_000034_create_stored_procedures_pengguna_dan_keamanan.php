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
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_aktivitas_user_summary`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_aktivitas_user_summary` (IN `p_user_id` INT, IN `p_tgl_mulai` DATE, IN `p_tgl_selesai` DATE) BEGIN
              SELECT
                u.username,
                r.nama_role,
                COUNT(l.log_id) AS total_aktivitas,
                MAX(l.created_at) AS aktivitas_terakhir
              FROM users u
              JOIN roles r ON u.role_id = r.role_id
              LEFT JOIN log_aktivitas l
                ON u.user_id = l.user_id
               AND l.created_at >= p_tgl_mulai
               AND l.created_at <  p_tgl_selesai + INTERVAL 1 DAY
              WHERE u.user_id = p_user_id
                AND u.deleted_at IS NULL
              GROUP BY u.user_id, u.username, r.nama_role;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_bersihkan_log_lama`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_bersihkan_log_lama` (IN `p_hari` INT) BEGIN
              batch_loop: LOOP
                DELETE FROM log_aktivitas
                WHERE created_at < NOW() - INTERVAL p_hari DAY
                LIMIT 1000;
                IF ROW_COUNT() = 0 THEN
                  LEAVE batch_loop;
                END IF;
              END LOOP;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_buat_akun_otomatis_siswa`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_buat_akun_otomatis_siswa` (IN `p_siswa_id` INT, IN `p_role_id` INT, IN `p_username` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255)) BEGIN
                DECLARE v_new_user_id INT;
                
                -- 1. Buat akun di tabel users sesuai kolom struktur baru
                INSERT INTO users (role_id, username, email, password, status)
                VALUES (p_role_id, p_username, p_email, p_password, 'Aktif');
                
                -- 2. Ambil ID user yang baru saja dibuat
                SET v_new_user_id = LAST_INSERT_ID();
                
                -- 3. Tautkan user_id tersebut ke baris data siswa terkait
                UPDATE siswa 
                SET user_id = v_new_user_id 
                WHERE siswa_id = p_siswa_id AND deleted_at IS NULL;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_catat_percobaan_login`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_catat_percobaan_login` (IN `p_user_id` INT, IN `p_identifier_hash` CHAR(64), IN `p_ip_address` VARCHAR(45), IN `p_berhasil` TINYINT) BEGIN
              DECLARE v_gagal INT DEFAULT 0;
              INSERT INTO login_attempts(user_id, identifier_hash, ip_address, berhasil)
              VALUES(p_user_id, p_identifier_hash, p_ip_address, p_berhasil);
              IF p_user_id IS NOT NULL AND p_berhasil = 0 THEN
                SELECT COUNT(*) INTO v_gagal FROM login_attempts
                WHERE user_id = p_user_id AND berhasil = 0
                  AND attempted_at >= NOW() - INTERVAL 15 MINUTE;
                IF v_gagal >= 5 THEN
                  UPDATE users SET status = 'Nonaktif' WHERE user_id = p_user_id AND deleted_at IS NULL;
                  INSERT INTO log_aktivitas(user_id, aksi, tabel_terkait, record_id, ip_address)
                  VALUES(p_user_id, 'SECURITY: akun dinonaktifkan sementara setelah 5 login gagal dalam 15 menit', 'users', p_user_id, p_ip_address);
                END IF;
              END IF;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_pulihkan_akun_user`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_pulihkan_akun_user` (IN `p_user_id` INT) BEGIN
                UPDATE users 
                SET status = 'Aktif',
                    deleted_at = NULL 
                WHERE user_id = p_user_id;
                
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (p_user_id, 'SECURITY: Akun berhasil dipulihkan / dibuka kuncinya oleh Admin', 'users', p_user_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_reset_password_user`');

        DB::unprepared(<<<SQL
            CREATE PROCEDURE `sp_reset_password_user` (IN `p_user_id` INT, IN `p_new_password` VARCHAR(255)) BEGIN
                UPDATE users 
                SET password = p_new_password 
                WHERE user_id = p_user_id AND deleted_at IS NULL;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_reset_password_user`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_pulihkan_akun_user`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_catat_percobaan_login`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_buat_akun_otomatis_siswa`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_bersihkan_log_lama`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_aktivitas_user_summary`');
    }
};
