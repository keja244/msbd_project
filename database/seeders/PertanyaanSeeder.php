<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan aspek dalam kuesioner: 4 = Sarana Prasarana, 7 = Kurikulum, 5 = Kesiswaan, 1 = Layanan
        $urutanAspek = [4, 7, 5, 1];

        $pertanyaanSkala = [
            4 => [
                'Bagaimana tingkat kepuasan Anda terhadap kebersihan dan kenyamanan ruang kelas, toilet, serta lingkungan sekolah?',
                'Bagaimana tingkat kepuasan Anda terhadap kelengkapan dan kondisi fasilitas laboratorium, perpustakaan, dan sarana olahraga?',
            ],
            7 => [
                'Bagaimana tingkat kepuasan Anda terhadap kejelasan penyampaian materi dan metode pembelajaran oleh guru?',
                'Bagaimana tingkat kepuasan Anda terhadap kesesuaian jadwal pelajaran dan sistem penilaian dengan kebutuhan siswa?',
            ],
            5 => [
                'Bagaimana tingkat kepuasan Anda terhadap pembinaan karakter, kedisiplinan, dan penegakan tata tertib siswa?',
                'Bagaimana tingkat kepuasan Anda terhadap ketersediaan dan pembinaan kegiatan ekstrakurikuler serta pengembangan prestasi siswa?',
            ],
            1 => [
                'Bagaimana tingkat kepuasan Anda terhadap keramahan dan kecepatan petugas tata usaha dalam melayani kebutuhan administrasi?',
                'Bagaimana tingkat kepuasan Anda terhadap kemudahan memperoleh informasi sekolah melalui website, media sosial, dan papan pengumuman?',
            ],
        ];

        $dibuatPada = [
            1 => '2025-02-24 09:30:00',
            2 => '2025-09-29 09:30:00',
            3 => '2026-11-02 09:30:00',
        ];

        $id = 1;

        foreach ([1, 2, 3] as $surveiId) {
            $urutan = 1;

            // Pertanyaan skala (skor 1-4), dibagi rata: 2 pertanyaan untuk tiap aspek
            foreach ($urutanAspek as $aspekId) {
                foreach ($pertanyaanSkala[$aspekId] as $indeks => $teks) {
                    DB::table('pertanyaan')->insert([
                        'pertanyaan_id' => $id++,
                        'survei_id' => $surveiId,
                        'aspek_id' => $aspekId,
                        'teks_pertanyaan' => $teks,
                        'jenis' => 'Skala',
                        'urutan' => $urutan++,
                        'created_at' => $dibuatPada[$surveiId],
                        'updated_at' => $dibuatPada[$surveiId],
                        'inti' => $indeks === 0 ? 1 : 0,
                        'aktif' => 1,
                        'deleted_at' => null,
                    ]);
                }
            }

            // Survei berjalan (3) mendapat pertanyaan tambahan jenis Pilihan dan Esai pada aspek Layanan
            if ($surveiId === 3) {
                DB::table('pertanyaan')->insert([
                    'pertanyaan_id' => $id++,
                    'survei_id' => $surveiId,
                    'aspek_id' => 1,
                    'teks_pertanyaan' => 'Saluran informasi sekolah apa yang paling sering Anda gunakan?',
                    'jenis' => 'Pilihan',
                    'urutan' => $urutan++,
                    'created_at' => $dibuatPada[$surveiId],
                    'updated_at' => $dibuatPada[$surveiId],
                    'inti' => 0,
                    'aktif' => 1,
                    'deleted_at' => null,
                ]);

                DB::table('pertanyaan')->insert([
                    'pertanyaan_id' => $id++,
                    'survei_id' => $surveiId,
                    'aspek_id' => 1,
                    'teks_pertanyaan' => 'Apa saran Anda untuk meningkatkan kualitas layanan SMA Negeri 2 Medan?',
                    'jenis' => 'Esai',
                    'urutan' => $urutan++,
                    'created_at' => $dibuatPada[$surveiId],
                    'updated_at' => $dibuatPada[$surveiId],
                    'inti' => 0,
                    'aktif' => 1,
                    'deleted_at' => null,
                ]);
            }
        }
    }
}
