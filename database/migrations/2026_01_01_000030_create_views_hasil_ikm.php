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
            CREATE OR REPLACE VIEW `v_rekap_rata_rata_ikm_per_aspek` AS
            SELECT
                `j`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                `a`.`aspek_id` AS `aspek_id`,
                `a`.`nama_aspek` AS `nama_aspek`,
                count(`j`.`jawaban_id`) AS `total_respon`,
                round(avg(`j`.`skor`),2) AS `rata_rata_skor`
            FROM (((`jawaban` `j` join `survei` `s` on((`j`.`survei_id` = `s`.`survei_id`))) join `pertanyaan` `p` on((`j`.`pertanyaan_id` = `p`.`pertanyaan_id`))) join `aspek` `a` on((`p`.`aspek_id` = `a`.`aspek_id`)))
            WHERE ((`j`.`skor` is not null) AND (`s`.`deleted_at` is null))
            GROUP BY `j`.`survei_id`, `s`.`judul_survei`, `a`.`aspek_id`, `a`.`nama_aspek`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_rekap_ikm_both` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                `s`.`metode_ikm` AS `metode_ikm`,
                count(`j`.`jawaban_id`) AS `jumlah_jawaban`,
                round(avg(`j`.`skor`),2) AS `ikm_internal_skala_4`,
                round((avg(`j`.`skor`) * `s`.`faktor_konversi`),2) AS `ikm_konversi_25_100`,
                (case when (count(`j`.`jawaban_id`) = 0) then 'Belum Dinilai' when (avg(`j`.`skor`) >= 3.50) then 'Sangat Baik' when (avg(`j`.`skor`) >= 2.50) then 'Baik' when (avg(`j`.`skor`) >= 1.50) then 'Cukup' else 'Kurang' end) AS `predikat_mutu`
            FROM (`survei` `s` left join `jawaban` `j` on(((`j`.`survei_id` = `s`.`survei_id`) and (`j`.`skor` is not null))))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`, `s`.`metode_ikm`, `s`.`faktor_konversi`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_ikm_both_per_kategori` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                `kr`.`kategori_id` AS `kategori_id`,
                `kr`.`nama` AS `kategori_responden`,
                count(`j`.`jawaban_id`) AS `jumlah_jawaban`,
                round(avg(`j`.`skor`),2) AS `ikm_internal_skala_4`,
                round((avg(`j`.`skor`) * `s`.`faktor_konversi`),2) AS `ikm_konversi_25_100`
            FROM ((`survei` `s` join `jawaban` `j` on(((`j`.`survei_id` = `s`.`survei_id`) and (`j`.`skor` is not null)))) join `kategori_responden` `kr` on((`kr`.`kategori_id` = `j`.`kategori_id`)))
            WHERE (`s`.`deleted_at` is null)
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`, `kr`.`kategori_id`, `kr`.`nama`, `s`.`faktor_konversi`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_hasil_survei_kesiswaan` AS
            SELECT
                `v_rekap_rata_rata_ikm_per_aspek`.`survei_id` AS `survei_id`,
                `v_rekap_rata_rata_ikm_per_aspek`.`judul_survei` AS `judul_survei`,
                `v_rekap_rata_rata_ikm_per_aspek`.`aspek_id` AS `aspek_id`,
                `v_rekap_rata_rata_ikm_per_aspek`.`nama_aspek` AS `nama_aspek`,
                `v_rekap_rata_rata_ikm_per_aspek`.`total_respon` AS `total_respon`,
                `v_rekap_rata_rata_ikm_per_aspek`.`rata_rata_skor` AS `rata_rata_skor`
            FROM `v_rekap_rata_rata_ikm_per_aspek`
            WHERE (`v_rekap_rata_rata_ikm_per_aspek`.`aspek_id` in (5,6))
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_hasil_survei_kurikulum` AS
            SELECT
                `v_rekap_rata_rata_ikm_per_aspek`.`survei_id` AS `survei_id`,
                `v_rekap_rata_rata_ikm_per_aspek`.`judul_survei` AS `judul_survei`,
                `v_rekap_rata_rata_ikm_per_aspek`.`aspek_id` AS `aspek_id`,
                `v_rekap_rata_rata_ikm_per_aspek`.`nama_aspek` AS `nama_aspek`,
                `v_rekap_rata_rata_ikm_per_aspek`.`total_respon` AS `total_respon`,
                `v_rekap_rata_rata_ikm_per_aspek`.`rata_rata_skor` AS `rata_rata_skor`
            FROM `v_rekap_rata_rata_ikm_per_aspek`
            WHERE (`v_rekap_rata_rata_ikm_per_aspek`.`aspek_id` in (7,8))
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_hasil_survei_sarpras` AS
            SELECT
                `v_rekap_rata_rata_ikm_per_aspek`.`survei_id` AS `survei_id`,
                `v_rekap_rata_rata_ikm_per_aspek`.`judul_survei` AS `judul_survei`,
                `v_rekap_rata_rata_ikm_per_aspek`.`aspek_id` AS `aspek_id`,
                `v_rekap_rata_rata_ikm_per_aspek`.`nama_aspek` AS `nama_aspek`,
                `v_rekap_rata_rata_ikm_per_aspek`.`total_respon` AS `total_respon`,
                `v_rekap_rata_rata_ikm_per_aspek`.`rata_rata_skor` AS `rata_rata_skor`
            FROM `v_rekap_rata_rata_ikm_per_aspek`
            WHERE (`v_rekap_rata_rata_ikm_per_aspek`.`aspek_id` = 4)
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_hasil_survei_publik` AS
            SELECT
                `r`.`survei_id` AS `survei_id`,
                `r`.`judul_survei` AS `judul_survei`,
                `r`.`metode_ikm` AS `metode_ikm`,
                `r`.`jumlah_jawaban` AS `jumlah_jawaban`,
                `r`.`ikm_internal_skala_4` AS `ikm_internal_skala_4`,
                `r`.`ikm_konversi_25_100` AS `ikm_konversi_25_100`,
                `r`.`predikat_mutu` AS `predikat_mutu`
            FROM (`v_rekap_ikm_both` `r` join `survei` `s` on((`r`.`survei_id` = `s`.`survei_id`)))
            WHERE ((`s`.`status` = 'Selesai') AND (`s`.`deleted_at` is null))
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_rekap_predikat_mutu_survei` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                round(avg(`j`.`skor`),2) AS `rata_rata_skor`,
                round((avg(`j`.`skor`) * `s`.`faktor_konversi`),2) AS `indeks_konversi`,
                (case when (avg(`j`.`skor`) >= 3.50) then 'Sangat Memuaskan (Mutu A)' when (avg(`j`.`skor`) >= 2.50) then 'Memuaskan (Mutu B)' when (avg(`j`.`skor`) >= 1.50) then 'Cukup (Mutu C)' else 'Perlu Evaluasi (Mutu D)' end) AS `predikat_mutu_sekolah`
            FROM (`survei` `s` join `jawaban` `j` on((`j`.`survei_id` = `s`.`survei_id`)))
            WHERE ((`j`.`skor` is not null) AND (`s`.`deleted_at` is null))
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`, `s`.`faktor_konversi`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_ranking_aspek_ikm` AS
            SELECT
                `a`.`aspek_id` AS `aspek_id`,
                `a`.`nama_aspek` AS `nama_aspek`,
                round(avg(`j`.`skor`),2) AS `skor_global`
            FROM ((`aspek` `a` join `pertanyaan` `p` on((`a`.`aspek_id` = `p`.`aspek_id`))) join `jawaban` `j` on(((`p`.`pertanyaan_id` = `j`.`pertanyaan_id`) and (`j`.`skor` is not null))))
            GROUP BY `a`.`aspek_id`, `a`.`nama_aspek`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_perbandingan_skor_per_kategori` AS
            SELECT
                `j`.`survei_id` AS `survei_id`,
                `kr`.`nama` AS `kategori_responden`,
                round(avg(`j`.`skor`),2) AS `rata_rata_skor`
            FROM (`jawaban` `j` join `kategori_responden` `kr` on((`j`.`kategori_id` = `kr`.`kategori_id`)))
            WHERE (`j`.`skor` is not null)
            GROUP BY `j`.`survei_id`, `kr`.`nama`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_distribusi_skor_jawaban` AS
            SELECT
                `jawaban`.`survei_id` AS `survei_id`,
                `jawaban`.`skor` AS `skor`,
                count(0) AS `jumlah_pemilih`
            FROM `jawaban`
            WHERE (`jawaban`.`skor` is not null)
            GROUP BY `jawaban`.`survei_id`, `jawaban`.`skor`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_evaluasi_beban_pertanyaan_kritis` AS
            SELECT
                `p`.`pertanyaan_id` AS `pertanyaan_id`,
                `p`.`teks_pertanyaan` AS `teks_pertanyaan`,
                round(`j`.`rata`,2) AS `rata_rata_pertanyaan`,
                (case when (`j`.`rata` < 3.00) then 'Prioritas Perbaikan (Merah)' else 'Aman / Standar Baik' end) AS `status_evaluasi`
            FROM (`pertanyaan` `p` left join (select `jawaban`.`pertanyaan_id` AS `pertanyaan_id`,avg(`jawaban`.`skor`) AS `rata` from `jawaban` where (`jawaban`.`skor` is not null) group by `jawaban`.`pertanyaan_id`) `j` on((`j`.`pertanyaan_id` = `p`.`pertanyaan_id`)))
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_evaluasi_pertanyaan_terendah` AS
            SELECT
                `p`.`pertanyaan_id` AS `pertanyaan_id`,
                `a`.`nama_aspek` AS `nama_aspek`,
                `p`.`teks_pertanyaan` AS `teks_pertanyaan`,
                round(avg(`j`.`skor`),2) AS `rata_rata_skor`
            FROM ((`pertanyaan` `p` join `aspek` `a` on((`p`.`aspek_id` = `a`.`aspek_id`))) join `jawaban` `j` on(((`p`.`pertanyaan_id` = `j`.`pertanyaan_id`) and (`j`.`skor` is not null))))
            GROUP BY `p`.`pertanyaan_id`, `a`.`nama_aspek`, `p`.`teks_pertanyaan`
            SQL);

        DB::unprepared(<<<SQL
            CREATE OR REPLACE VIEW `v_riwayat_skor_antar_survei` AS
            SELECT
                `s`.`survei_id` AS `survei_id`,
                `s`.`judul_survei` AS `judul_survei`,
                `s`.`tanggal_mulai` AS `tanggal_mulai`,
                round(avg(`j`.`skor`),2) AS `rata_rata_keseluruhan`
            FROM (`survei` `s` left join `jawaban` `j` on((`s`.`survei_id` = `j`.`survei_id`)))
            WHERE ((`j`.`skor` is not null) AND (`s`.`deleted_at` is null))
            GROUP BY `s`.`survei_id`, `s`.`judul_survei`, `s`.`tanggal_mulai`
            SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS `v_riwayat_skor_antar_survei`');
        DB::unprepared('DROP VIEW IF EXISTS `v_evaluasi_pertanyaan_terendah`');
        DB::unprepared('DROP VIEW IF EXISTS `v_evaluasi_beban_pertanyaan_kritis`');
        DB::unprepared('DROP VIEW IF EXISTS `v_distribusi_skor_jawaban`');
        DB::unprepared('DROP VIEW IF EXISTS `v_perbandingan_skor_per_kategori`');
        DB::unprepared('DROP VIEW IF EXISTS `v_ranking_aspek_ikm`');
        DB::unprepared('DROP VIEW IF EXISTS `v_rekap_predikat_mutu_survei`');
        DB::unprepared('DROP VIEW IF EXISTS `v_hasil_survei_publik`');
        DB::unprepared('DROP VIEW IF EXISTS `v_hasil_survei_sarpras`');
        DB::unprepared('DROP VIEW IF EXISTS `v_hasil_survei_kurikulum`');
        DB::unprepared('DROP VIEW IF EXISTS `v_hasil_survei_kesiswaan`');
        DB::unprepared('DROP VIEW IF EXISTS `v_ikm_both_per_kategori`');
        DB::unprepared('DROP VIEW IF EXISTS `v_rekap_ikm_both`');
        DB::unprepared('DROP VIEW IF EXISTS `v_rekap_rata_rata_ikm_per_aspek`');
    }
};
