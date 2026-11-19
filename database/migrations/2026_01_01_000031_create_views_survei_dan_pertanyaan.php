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
            CREATE OR REPLACE VIEW `v_monitor_survei_berjalan` AS
            SELECT
                `survei`.`survei_id` AS `survei_id`,
                `survei`.`judul_survei` AS `judul_survei`,
                `survei`.`tanggal_mulai` AS `tanggal_mulai`,
                `survei`.`tanggal_selesai` AS `tanggal_selesai`,
                `survei`.`status` AS `status`,
                if(((`survei`.`status` = 'Aktif') and (curdate() between `survei`.`tanggal_mulai` and `survei`.`tanggal_selesai`)),'Sedang Berlangsung','Tidak Aktif') AS `status_waktu_riil`
            FROM `survei`
            WHERE (`survei`.`deleted_at` is null)
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_ringkasan_progres_survei` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                count(`p`.`partisipasi_id`) AS `total_masuk`,
                `s`.`tanggal_mulai` AS `tanggal_mulai`,
                `s`.`tanggal_selesai` AS `tanggal_selesai`
            FROM (`survei` `s` left join `partisipasi` `p` on((`s`.`survei_id` = `p`.`survei_id`)))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`, `s`.`tanggal_mulai`, `s`.`tanggal_selesai`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_statistik_partisipasi_responden` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                `s`.`status` AS `status_survei`,
                count(`p`.`partisipasi_id`) AS `total_responden_masuk`
            FROM (`survei` `s` left join `partisipasi` `p` on((`s`.`survei_id` = `p`.`survei_id`)))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`, `s`.`status`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_analisis_target_partisipasi_survei` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                count(`p`.`partisipasi_id`) AS `total_responden`,
                (case when (count(`p`.`partisipasi_id`) >= 50) then 'Target Tercapai (Optimal)' else 'Perlu Perluasan Publikasi' end) AS `status_target`
            FROM (`survei` `s` left join `partisipasi` `p` on((`p`.`survei_id` = `s`.`survei_id`)))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_rekap_partisipasi_per_kategori_responden` AS
            SELECT
                `j`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                `kr`.`kategori_id` AS `kategori_id`,
                `kr`.`nama` AS `kategori_responden`,
                count(`j`.`jawaban_id`) AS `jumlah_partisipasi`
            FROM ((`jawaban` `j` join `survei` `s` on((`j`.`survei_id` = `s`.`survei_id`))) join `kategori_responden` `kr` on((`j`.`kategori_id` = `kr`.`kategori_id`)))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `j`.`survei_id`, `s`.`judul_survei`, `kr`.`kategori_id`, `kr`.`nama`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_pertanyaan_kesiswaan` AS
            SELECT
                `pertanyaan`.`pertanyaan_id` AS `pertanyaan_id`,
                `pertanyaan`.`survei_id` AS `survei_id`,
                `pertanyaan`.`aspek_id` AS `aspek_id`,
                `pertanyaan`.`teks_pertanyaan` AS `teks_pertanyaan`,
                `pertanyaan`.`jenis` AS `jenis`,
                `pertanyaan`.`urutan` AS `urutan`,
                `pertanyaan`.`created_at` AS `created_at`,
                `pertanyaan`.`updated_at` AS `updated_at`,
                `pertanyaan`.`inti` AS `inti`,
                `pertanyaan`.`aktif` AS `aktif`,
                `pertanyaan`.`deleted_at` AS `deleted_at`
            FROM `pertanyaan`
            WHERE (`pertanyaan`.`aspek_id` in (5,6))
            WITH CASCADED CHECK OPTION
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_pertanyaan_kurikulum` AS
            SELECT
                `pertanyaan`.`pertanyaan_id` AS `pertanyaan_id`,
                `pertanyaan`.`survei_id` AS `survei_id`,
                `pertanyaan`.`aspek_id` AS `aspek_id`,
                `pertanyaan`.`teks_pertanyaan` AS `teks_pertanyaan`,
                `pertanyaan`.`jenis` AS `jenis`,
                `pertanyaan`.`urutan` AS `urutan`,
                `pertanyaan`.`created_at` AS `created_at`,
                `pertanyaan`.`updated_at` AS `updated_at`,
                `pertanyaan`.`inti` AS `inti`,
                `pertanyaan`.`aktif` AS `aktif`,
                `pertanyaan`.`deleted_at` AS `deleted_at`
            FROM `pertanyaan`
            WHERE (`pertanyaan`.`aspek_id` in (7,8))
            WITH CASCADED CHECK OPTION
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_pertanyaan_sarpras` AS
            SELECT
                `pertanyaan`.`pertanyaan_id` AS `pertanyaan_id`,
                `pertanyaan`.`survei_id` AS `survei_id`,
                `pertanyaan`.`aspek_id` AS `aspek_id`,
                `pertanyaan`.`teks_pertanyaan` AS `teks_pertanyaan`,
                `pertanyaan`.`jenis` AS `jenis`,
                `pertanyaan`.`urutan` AS `urutan`,
                `pertanyaan`.`created_at` AS `created_at`,
                `pertanyaan`.`updated_at` AS `updated_at`,
                `pertanyaan`.`inti` AS `inti`,
                `pertanyaan`.`aktif` AS `aktif`,
                `pertanyaan`.`deleted_at` AS `deleted_at`
            FROM `pertanyaan`
            WHERE (`pertanyaan`.`aspek_id` = 4)
            WITH CASCADED CHECK OPTION
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS `v_pertanyaan_sarpras`');
        DB::unprepared('DROP VIEW IF EXISTS `v_pertanyaan_kurikulum`');
        DB::unprepared('DROP VIEW IF EXISTS `v_pertanyaan_kesiswaan`');
        DB::unprepared('DROP VIEW IF EXISTS `v_rekap_partisipasi_per_kategori_responden`');
        DB::unprepared('DROP VIEW IF EXISTS `v_analisis_target_partisipasi_survei`');
        DB::unprepared('DROP VIEW IF EXISTS `v_statistik_partisipasi_responden`');
        DB::unprepared('DROP VIEW IF EXISTS `v_ringkasan_progres_survei`');
        DB::unprepared('DROP VIEW IF EXISTS `v_monitor_survei_berjalan`');
    }
};
