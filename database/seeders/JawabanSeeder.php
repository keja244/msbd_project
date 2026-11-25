<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Jawaban dibuat dinamis dari data yang sudah ada: setiap partisipasi menjawab pertanyaan survei-nya
 * yang diizinkan untuk kategori respondennya (tabel pertanyaan_kategori).
 *
 * Aturan trigger validasi jenis jawaban:
 *  - Skala   : skor terisi (1-4), opsi_id dan isian NULL
 *  - Pilihan : opsi_id terisi, skor dan isian NULL
 *  - Esai    : isian terisi, skor dan opsi_id NULL
 */
class JawabanSeeder extends Seeder
{
    public function run(): void
    {
        // Pola skor (1-4) per aspek agar tiap aspek punya rata-rata berbeda:
        // Layanan ~3,6 | Kurikulum ~3,5 | Kesiswaan ~3,3 | Sarana Prasarana ~2,7
        $polaSkor = [
            1 => [4, 4, 3, 4, 3, 4, 4, 3, 4, 3],
            7 => [4, 3, 4, 3, 4, 3, 3, 4, 4, 3],
            5 => [3, 4, 3, 3, 4, 3, 4, 2, 3, 4],
            4 => [3, 2, 3, 2, 1, 3, 2, 3, 3, 2],
        ];

        $poolEsai = [
            'Pelayanan tata usaha sudah baik, semoga waktu pengurusan dokumen dapat dipersingkat.',
            'Informasi sekolah sebaiknya diperbarui lebih cepat di website dan media sosial.',
            'Perlu loket pengaduan atau kotak saran yang mudah diakses oleh siswa dan orang tua.',
            'Mohon jam layanan administrasi diperpanjang pada hari-hari sibuk.',
            'Sistem antrean layanan perlu dibuat lebih tertib dan jelas.',
            'Secara umum layanan sudah memuaskan, tolong dipertahankan dan terus ditingkatkan.',
        ];

        // Daftar opsi per pertanyaan Pilihan
        $opsiPerPertanyaan = [];
        foreach (DB::select('SELECT pertanyaan_id, opsi_id FROM pertanyaan_opsi ORDER BY pertanyaan_id, urutan') as $opsi) {
            $opsiPerPertanyaan[$opsi->pertanyaan_id][] = $opsi->opsi_id;
        }

        $sqlPertanyaan = 'SELECT q.pertanyaan_id, q.aspek_id, q.jenis
            FROM pertanyaan q
            JOIN pertanyaan_kategori pk ON pk.pertanyaan_id = q.pertanyaan_id
            WHERE q.survei_id = ? AND pk.kategori_id = ? AND q.aktif = 1 AND q.deleted_at IS NULL
            ORDER BY q.urutan';

        $partisipasi = DB::select('SELECT partisipasi_id, survei_id, kategori_id FROM partisipasi ORDER BY partisipasi_id');

        foreach ($partisipasi as $p) {
            $baris = [];

            foreach (DB::select($sqlPertanyaan, [$p->survei_id, $p->kategori_id]) as $q) {
                $row = [
                    'survei_id' => $p->survei_id,
                    'partisipasi_id' => $p->partisipasi_id,
                    'pertanyaan_id' => $q->pertanyaan_id,
                    'opsi_id' => null,
                    'kategori_id' => $p->kategori_id,
                    'skor' => null,
                    'isian' => null,
                ];

                if ($q->jenis === 'Skala') {
                    $pola = $polaSkor[$q->aspek_id];
                    $row['skor'] = $pola[($p->partisipasi_id * 7 + $q->pertanyaan_id * 3) % count($pola)];
                } elseif ($q->jenis === 'Pilihan') {
                    $daftarOpsi = $opsiPerPertanyaan[$q->pertanyaan_id];
                    $row['opsi_id'] = $daftarOpsi[($p->partisipasi_id + $q->pertanyaan_id) % count($daftarOpsi)];
                } else {
                    $row['isian'] = $poolEsai[($p->partisipasi_id + $q->pertanyaan_id) % count($poolEsai)];
                }

                $baris[] = $row;
            }

            if (!empty($baris)) {
                DB::table('jawaban')->insert($baris);
            }
        }
    }
}
