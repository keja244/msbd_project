<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanOpsiSeeder extends Seeder
{
    public function run(): void
    {
        $opsi = [
            'Website resmi sekolah',
            'Instagram sekolah',
            'Grup WhatsApp kelas atau orang tua',
            'Papan pengumuman sekolah',
        ];

        $pertanyaanPilihan = DB::select("SELECT pertanyaan_id FROM pertanyaan WHERE jenis = 'Pilihan' ORDER BY pertanyaan_id");

        foreach ($pertanyaanPilihan as $pertanyaan) {
            foreach ($opsi as $indeks => $teks) {
                DB::table('pertanyaan_opsi')->insert([
                    'pertanyaan_id' => $pertanyaan->pertanyaan_id,
                    'teks_opsi' => $teks,
                    'urutan' => $indeks + 1,
                ]);
            }
        }
    }
}
