<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 6 responden untuk tiap survei: 3 siswa, 1 guru/tendik, 1 orang tua/wali, 1 masyarakat.
 *
 * Aturan trigger yang dipatuhi:
 *  - SISWA       : hanya siswa_id terisi (guru_tendik_id dan identitas_hash NULL)
 *  - GURU_TENDIK : hanya guru_tendik_id terisi
 *  - ANONIM      : hanya identitas_hash (64 karakter) terisi
 *  - Survei harus berstatus 'Aktif' dan periodenya mencakup hari ini saat baris dimasukkan
 *    (status akhir survei 1 dan 2 dirapikan oleh DatabaseSeeder setelah semua data masuk).
 */
class PartisipasiSeeder extends Seeder
{
    public function run(): void
    {
        $waktuIsi = [
            1 => ['2025-03-05 08:15:00', '2025-03-06 09:40:00', '2025-03-07 10:05:00', '2025-03-10 13:20:00', '2025-03-12 19:45:00', '2025-03-14 16:30:00'],
            2 => ['2025-10-08 08:20:00', '2025-10-09 09:10:00', '2025-10-13 10:30:00', '2025-10-15 13:00:00', '2025-10-18 20:10:00', '2025-10-22 15:45:00'],
            3 => [
                Carbon::now()->subDays(12)->toDateTimeString(),
                Carbon::now()->subDays(10)->toDateTimeString(),
                Carbon::now()->subDays(8)->toDateTimeString(),
                Carbon::now()->subDays(6)->toDateTimeString(),
                Carbon::now()->subDays(4)->toDateTimeString(),
                Carbon::now()->subDays(2)->toDateTimeString(),
            ],
        ];

        // Siswa yang sudah terdaftar pada masing-masing periode survei
        $siswaResponden = [1 => [9, 10, 11], 2 => [5, 6, 9], 3 => [2, 7, 10]];
        $guruResponden = [1 => 2, 2 => 3, 3 => 6];

        // [nama, no_hp, saran]
        $orangTua = [
            1 => ['Sahat Simanjuntak', '081360010001', 'Mohon fasilitas toilet dan kantin diperbaiki agar lebih nyaman dan higienis.'],
            2 => ['Rahmawati Lubis', '081360010002', 'Komunikasi wali kelas kepada orang tua sudah baik, mohon dipertahankan.'],
            3 => ['Hendra Tarigan', '081360010003', 'Mohon laporan perkembangan siswa dapat diakses lewat website sekolah.'],
        ];
        $masyarakat = [
            1 => ['Siti Aminah Harahap', '081360020001', 'Informasi kegiatan sekolah sebaiknya lebih sering diunggah di media sosial.'],
            2 => ['Bonar Nainggolan', '081360020002', 'Sekolah perlu menambah rambu lalu lintas di sekitar gerbang saat jam masuk dan pulang.'],
            3 => ['Dewi Sartika Siregar', '081360020003', 'Kegiatan bakti sosial sekolah bersama warga sekitar perlu diperbanyak.'],
        ];
        $saranGuru = [
            1 => 'Perlu penambahan proyektor di beberapa ruang kelas.',
            2 => 'Koneksi internet di ruang guru perlu ditingkatkan.',
            3 => 'Jadwal rapat sebaiknya dikirim lebih awal agar persiapan lebih matang.',
        ];

        $id = 1;

        foreach ([1, 2, 3] as $surveiId) {
            $waktu = $waktuIsi[$surveiId];
            $ip = '10.20.' . $surveiId . '.';

            // 3 responden siswa
            foreach ($siswaResponden[$surveiId] as $n => $siswaId) {
                DB::table('partisipasi')->insert([
                    'partisipasi_id' => $id++,
                    'survei_id' => $surveiId,
                    'kategori_id' => 1,
                    'siswa_id' => $siswaId,
                    'tanggal_isi' => $waktu[$n],
                    'ip_address' => $ip . (10 + $n),
                    'guru_tendik_id' => null,
                    'identitas_hash' => null,
                    'responden_tipe' => 'SISWA',
                    'jenis_responden_eksternal' => null,
                    'nama_responden' => null,
                    'no_hp' => null,
                    'saran' => null,
                ]);
            }

            // 1 responden guru/tendik
            DB::table('partisipasi')->insert([
                'partisipasi_id' => $id++,
                'survei_id' => $surveiId,
                'kategori_id' => 2,
                'siswa_id' => null,
                'tanggal_isi' => $waktu[3],
                'ip_address' => $ip . '20',
                'guru_tendik_id' => $guruResponden[$surveiId],
                'identitas_hash' => null,
                'responden_tipe' => 'GURU_TENDIK',
                'jenis_responden_eksternal' => null,
                'nama_responden' => null,
                'no_hp' => null,
                'saran' => $saranGuru[$surveiId],
            ]);

            // 1 responden orang tua/wali (anonim, kategori 3)
            [$nama, $noHp, $saran] = $orangTua[$surveiId];
            DB::table('partisipasi')->insert([
                'partisipasi_id' => $id++,
                'survei_id' => $surveiId,
                'kategori_id' => 3,
                'siswa_id' => null,
                'tanggal_isi' => $waktu[4],
                'ip_address' => $ip . '30',
                'guru_tendik_id' => null,
                'identitas_hash' => hash_hmac('sha256', 'ortu-survei-' . $surveiId, 'smanda2-medan-seeder'),
                'responden_tipe' => 'ANONIM',
                'jenis_responden_eksternal' => 'Orang Tua/Wali',
                'nama_responden' => $nama,
                'no_hp' => $noHp,
                'saran' => $saran,
            ]);

            // 1 responden masyarakat (anonim, kategori 3 yang sama dengan orang tua/wali; dibedakan oleh jenis_responden_eksternal)
            [$nama, $noHp, $saran] = $masyarakat[$surveiId];
            DB::table('partisipasi')->insert([
                'partisipasi_id' => $id++,
                'survei_id' => $surveiId,
                'kategori_id' => 3,
                'siswa_id' => null,
                'tanggal_isi' => $waktu[5],
                'ip_address' => $ip . '40',
                'guru_tendik_id' => null,
                'identitas_hash' => hash_hmac('sha256', 'masyarakat-survei-' . $surveiId, 'smanda2-medan-seeder'),
                'responden_tipe' => 'ANONIM',
                'jenis_responden_eksternal' => 'Masyarakat',
                'nama_responden' => $nama,
                'no_hp' => $noHp,
                'saran' => $saran,
            ]);
        }
    }
}
