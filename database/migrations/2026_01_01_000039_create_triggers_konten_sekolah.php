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
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_berita_published`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_berita_published` AFTER INSERT ON `berita` FOR EACH ROW BEGIN
              INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
              VALUES (NEW.user_id,
                      CONCAT('BERITA: Artikel baru dipublikasikan dengan judul: "', NEW.judul, '"'),
                      'berita', NEW.berita_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_edit_berita`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_update_edit_berita` AFTER UPDATE ON `berita` FOR EACH ROW BEGIN
              IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL THEN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NEW.user_id,
                        CONCAT('BERITA: Artikel "', NEW.judul, '" telah dihapus sementara (soft delete).'),
                        'berita', NEW.berita_id, '127.0.0.1');
              ELSEIF OLD.judul <> NEW.judul OR OLD.konten <> NEW.konten THEN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NEW.user_id,
                        CONCAT('BERITA: Artikel "', NEW.judul, '" telah direvisi oleh editor.'),
                        'berita', NEW.berita_id, '127.0.0.1');
              END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_galeri_berita`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_galeri_berita` AFTER INSERT ON `berita_foto` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('MEDIA: Foto galeri baru ditambahkan untuk berita_id: ', NEW.berita_id), 'berita_foto', NEW.foto_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_ekskul_aktivitas`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_ekskul_aktivitas` AFTER INSERT ON `ekskul_aktivitas` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('EKSKUL: Ekstrakurikuler baru ditambahkan - "', NEW.nama_ekskul, '"'), 'ekskul_aktivitas', NEW.ekskul_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_galeri_ekskul`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_galeri_ekskul` AFTER INSERT ON `ekskul_galeri` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('EKSKUL: Foto galeri baru diunggah untuk ekskul_id: ', NEW.ekskul_id), 'ekskul_galeri', NEW.galeri_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_insert_validasi_tahun_prestasi`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_insert_validasi_tahun_prestasi` BEFORE INSERT ON `prestasi` FOR EACH ROW BEGIN
                IF NEW.tahun > YEAR(NOW()) THEN
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Gagal: Tahun prestasi tidak boleh melebihi tahun saat ini!';
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_prestasi_siswa`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_prestasi_siswa` AFTER INSERT ON `prestasi_siswa` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('PRESTASI: Siswa ID ', NEW.siswa_id, ' dihubungkan dengan prestasi ID ', NEW.prestasi_id), 'prestasi_siswa', NEW.id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_sarpras_baru`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_sarpras_baru` AFTER INSERT ON `sarana_prasarana` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('SARPRAS: Fasilitas baru ditambahkan: ', NEW.nama_fasilitas), 'sarana_prasarana', NEW.sarpras_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_ubah_fasilitas_sarpras`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_update_ubah_fasilitas_sarpras` AFTER UPDATE ON `sarana_prasarana` FOR EACH ROW BEGIN
                IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NULL, CONCAT('SARPRAS: Fasilitas "', OLD.nama_fasilitas, '" dihapus sementara (soft delete).'), 'sarana_prasarana', NEW.sarpras_id, '127.0.0.1');
                ELSEIF OLD.nama_fasilitas != NEW.nama_fasilitas THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NULL, CONCAT('SARPRAS: Data fasilitas diperbarui dari "', OLD.nama_fasilitas, '" menjadi "', NEW.nama_fasilitas, '"'), 'sarana_prasarana', NEW.sarpras_id, '127.0.0.1');
                END IF;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_ubah_fasilitas_sarpras`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_sarpras_baru`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_prestasi_siswa`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_insert_validasi_tahun_prestasi`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_galeri_ekskul`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_ekskul_aktivitas`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_galeri_berita`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_edit_berita`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_berita_published`');
    }
};
