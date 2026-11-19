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
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_role_utama`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_delete_proteksi_role_utama` BEFORE DELETE ON `roles` FOR EACH ROW BEGIN
                IF OLD.role_id = 1 THEN
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Gagal: Role Admin Utama tidak boleh dihapus dari sistem!';
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_arsip_akun`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_delete_arsip_akun` AFTER DELETE ON `users` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('SECURITY WARNING: Akun dengan username "', OLD.username, '" telah dihapus permanen.'), 'users', OLD.user_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_user_log`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_user_log` AFTER INSERT ON `users` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NEW.user_id, CONCAT('AUTH: Akun baru berhasil didaftarkan dengan username: ', NEW.username), 'users', NEW.user_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_ganti_password`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_update_ganti_password` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
                IF OLD.password != NEW.password THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NEW.user_id, 'SECURITY: Password akun pengguna telah diperbarui.', 'users', NEW.user_id, '127.0.0.1');
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_admin_utama`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_delete_proteksi_admin_utama` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
              IF OLD.user_id = 1 THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Gagal: Super Admin Utama (user_id 1) tidak dapat dihapus!';
              END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_cegah_ubah_admin_sistem`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_update_cegah_ubah_admin_sistem` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
                IF OLD.user_id = 1 AND (NEW.username != OLD.username OR NEW.role_id != OLD.role_id) THEN
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Gagal: Kredensial Super Admin Utama (user_id 1) tidak diizinkan untuk diubah!';
                END IF;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_cegah_ubah_admin_sistem`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_admin_utama`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_ganti_password`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_user_log`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_arsip_akun`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_role_utama`');
    }
};
