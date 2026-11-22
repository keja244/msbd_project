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
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_aspek_baru`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_aspek_baru` AFTER INSERT ON `aspek` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('ASPEK: Aspek penilaian baru ditambahkan: ', NEW.nama_aspek), 'aspek', NEW.aspek_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_aspek_utama`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_delete_proteksi_aspek_utama` BEFORE DELETE ON `aspek` FOR EACH ROW BEGIN
                IF OLD.aspek_id <= 3 THEN
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Gagal: Aspek utama penilaian sistem tidak boleh dihapus!';
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_audit_survei_masuk`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_audit_survei_masuk` AFTER INSERT ON `jawaban` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('SURVEI AUDIT: Menerima entri jawaban baru untuk survei_id: ', NEW.survei_id), 'jawaban', NEW.jawaban_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_validasi_jenis_jawaban_insert`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_validasi_jenis_jawaban_insert` BEFORE INSERT ON `jawaban` FOR EACH ROW BEGIN
                DECLARE v_jenis VARCHAR(20);

                SELECT jenis
                INTO v_jenis
                FROM pertanyaan
                WHERE pertanyaan_id = NEW.pertanyaan_id;

                IF v_jenis = 'Skala' THEN
                    IF NEW.skor IS NULL
                       OR NEW.opsi_id IS NOT NULL
                       OR NEW.isian IS NOT NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Jawaban Skala harus menggunakan skor saja';
                    END IF;

                ELSEIF v_jenis = 'Pilihan' THEN
                    IF NEW.skor IS NOT NULL
                       OR NEW.opsi_id IS NULL
                       OR NEW.isian IS NOT NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Jawaban Pilihan harus menggunakan opsi_id saja';
                    END IF;

                ELSEIF v_jenis = 'Esai' THEN
                    IF NEW.skor IS NOT NULL
                       OR NEW.opsi_id IS NOT NULL
                       OR NEW.isian IS NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Jawaban Esai harus menggunakan isian saja';
                    END IF;
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_validasi_jenis_jawaban_update`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_validasi_jenis_jawaban_update` BEFORE UPDATE ON `jawaban` FOR EACH ROW BEGIN
                DECLARE v_jenis VARCHAR(20);

                SELECT jenis
                INTO v_jenis
                FROM pertanyaan
                WHERE pertanyaan_id = NEW.pertanyaan_id;

                IF v_jenis = 'Skala' THEN
                    IF NEW.skor IS NULL
                       OR NEW.opsi_id IS NOT NULL
                       OR NEW.isian IS NOT NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Jawaban Skala harus menggunakan skor saja';
                    END IF;

                ELSEIF v_jenis = 'Pilihan' THEN
                    IF NEW.skor IS NOT NULL
                       OR NEW.opsi_id IS NULL
                       OR NEW.isian IS NOT NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Jawaban Pilihan harus menggunakan opsi_id saja';
                    END IF;

                ELSEIF v_jenis = 'Esai' THEN
                    IF NEW.skor IS NOT NULL
                       OR NEW.opsi_id IS NOT NULL
                       OR NEW.isian IS NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Jawaban Esai harus menggunakan isian saja';
                    END IF;
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_kategori_terikat`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_delete_proteksi_kategori_terikat` BEFORE DELETE ON `kategori_responden` FOR EACH ROW BEGIN
                IF OLD.kategori_id = 1 THEN
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Gagal: Kategori responden Siswa Aktif tidak boleh dihapus dari sistem!';
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_hapus_partisipasi`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_delete_hapus_partisipasi` AFTER DELETE ON `partisipasi` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('SECURITY ALERT: Data partisipasi survei_id ', OLD.survei_id, ' telah dihapus.'), 'partisipasi', OLD.partisipasi_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_insert_validasi_model_responden`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_insert_validasi_model_responden` BEFORE INSERT ON `partisipasi` FOR EACH ROW BEGIN
              IF NEW.responden_tipe = 'SISWA' AND (NEW.siswa_id IS NULL OR NEW.guru_tendik_id IS NOT NULL OR NEW.identitas_hash IS NOT NULL) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Responden SISWA wajib memiliki siswa_id saja';
              ELSEIF NEW.responden_tipe = 'GURU_TENDIK' AND (NEW.guru_tendik_id IS NULL OR NEW.siswa_id IS NOT NULL OR NEW.identitas_hash IS NOT NULL) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Responden GURU_TENDIK wajib memiliki guru_tendik_id saja';
              ELSEIF NEW.responden_tipe = 'ANONIM' AND (NEW.identitas_hash IS NULL OR NEW.siswa_id IS NOT NULL OR NEW.guru_tendik_id IS NOT NULL) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Responden ANONIM wajib memiliki HMAC hash dan tanpa identitas langsung';
              END IF;
              IF NEW.responden_tipe = 'ANONIM' AND CHAR_LENGTH(NEW.identitas_hash) <> 64 THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'identitas_hash anonim harus berupa SHA-256/HMAC 64 karakter';
              END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_insert_validasi_waktu_isi_survei`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_insert_validasi_waktu_isi_survei` BEFORE INSERT ON `partisipasi` FOR EACH ROW BEGIN
              DECLARE v_ok INT DEFAULT 0;
              SELECT COUNT(*) INTO v_ok
              FROM survei
              WHERE survei_id = NEW.survei_id
                AND status = 'Aktif'
                AND deleted_at IS NULL
                AND CURDATE() BETWEEN tanggal_mulai AND tanggal_selesai;
              IF v_ok = 0 THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Gagal: Periode survei tidak aktif, sudah ditutup, atau tidak ditemukan!';
              END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_kunci_partisipasi`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_update_kunci_partisipasi` BEFORE UPDATE ON `partisipasi` FOR EACH ROW BEGIN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Data partisipasi yang sudah dikirim tidak boleh diubah';
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_validasi_model_responden`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_update_validasi_model_responden` BEFORE UPDATE ON `partisipasi` FOR EACH ROW BEGIN
              IF NEW.responden_tipe = 'SISWA' AND (NEW.siswa_id IS NULL OR NEW.guru_tendik_id IS NOT NULL OR NEW.identitas_hash IS NOT NULL) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Responden SISWA wajib memiliki siswa_id saja';
              ELSEIF NEW.responden_tipe = 'GURU_TENDIK' AND (NEW.guru_tendik_id IS NULL OR NEW.siswa_id IS NOT NULL OR NEW.identitas_hash IS NOT NULL) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Responden GURU_TENDIK wajib memiliki guru_tendik_id saja';
              ELSEIF NEW.responden_tipe = 'ANONIM' AND (NEW.identitas_hash IS NULL OR NEW.siswa_id IS NOT NULL OR NEW.guru_tendik_id IS NOT NULL) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Responden ANONIM wajib memiliki HMAC hash dan tanpa identitas langsung';
              END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_hapus_pertanyaan`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_delete_hapus_pertanyaan` AFTER DELETE ON `pertanyaan` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('KUESIONER: Pertanyaan dengan ID ', OLD.pertanyaan_id, ' telah dihapus.'), 'pertanyaan', OLD.pertanyaan_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_pertanyaan_baru`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_insert_pertanyaan_baru` AFTER INSERT ON `pertanyaan` FOR EACH ROW BEGIN
                INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                VALUES (NULL, CONCAT('KUESIONER: Pertanyaan baru ditambahkan pada aspek_id: ', NEW.aspek_id), 'pertanyaan', NEW.pertanyaan_id, '127.0.0.1');
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_status_survei`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_after_update_status_survei` AFTER UPDATE ON `survei` FOR EACH ROW BEGIN
                IF OLD.status != NEW.status THEN
                    INSERT INTO log_aktivitas (user_id, aksi, tabel_terkait, record_id, ip_address)
                    VALUES (NEW.created_by, CONCAT('SURVEI: Status periode survei "', NEW.judul_survei, '" diubah dari ', OLD.status, ' menjadi ', NEW.status), 'survei', NEW.survei_id, '127.0.0.1');
                END IF;
            END
            SQL);

        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_kunci_survei_selesai`');

        DB::unprepared(<<<SQL
            CREATE TRIGGER `trg_before_update_kunci_survei_selesai` BEFORE UPDATE ON `survei` FOR EACH ROW BEGIN
                IF OLD.status = 'Selesai' AND NEW.status != 'Selesai' THEN
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Gagal: Survei yang sudah berstatus Selesai tidak dapat diubah kembali!';
                END IF;
            END
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_kunci_survei_selesai`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_update_status_survei`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_pertanyaan_baru`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_hapus_pertanyaan`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_validasi_model_responden`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_update_kunci_partisipasi`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_insert_validasi_waktu_isi_survei`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_insert_validasi_model_responden`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_delete_hapus_partisipasi`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_kategori_terikat`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_validasi_jenis_jawaban_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_validasi_jenis_jawaban_insert`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_audit_survei_masuk`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_before_delete_proteksi_aspek_utama`');
        DB::unprepared('DROP TRIGGER IF EXISTS `trg_after_insert_aspek_baru`');
    }
};
