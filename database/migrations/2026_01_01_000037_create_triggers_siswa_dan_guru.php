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
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_hapus_guru_tendik`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_delete_hapus_guru_tendik` AFTER DELETE ON `guru_tendik` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('DIREKTORI: Data guru/tendik "', OLD.nama_lengkap, '" telah dihapus permanen dari sistem.'), 'guru_tendik', OLD.tendik_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_perubahan_data_siswa`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_update_perubahan_data_siswa` AFTER UPDATE ON `siswa` FOR EACH ROW BEGIN
                IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NULL, CONCAT('SISWA: Data siswa ID ', NEW.siswa_id, ' (', NEW.nama_lengkap, ') dihapus sementara (soft delete).'), 'siswa', NEW.siswa_id, '127.0.0.1');
                ELSEIF OLD.nama_lengkap != NEW.nama_lengkap OR OLD.kelas != NEW.kelas THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NULL, CONCAT('SISWA: Biodata siswa ID ', NEW.siswa_id, ' (', NEW.nama_lengkap, ') telah diperbarui.'), 'siswa', NEW.siswa_id, '127.0.0.1');
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_status_siswa`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_update_status_siswa` AFTER UPDATE ON `siswa` FOR EACH ROW BEGIN
                IF OLD.status != NEW.status THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NULL, CONCAT('SISWA: Status siswa ', NEW.nama_lengkap, ' berubah dari ', OLD.status, ' menjadi ', NEW.status), 'siswa', NEW.siswa_id, '127.0.0.1');
                END IF;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_status_siswa`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_perubahan_data_siswa`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_hapus_guru_tendik`');
    }
};
