<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanKategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori responden: 1 = Siswa Aktif, 2 = Guru dan Tendik, 3 = Orang Tua/Wali dan Masyarakat
        // Seluruh aspek dapat dinilai oleh ketiga kategori responden tersebut.
        $kategoriPerAspek = [
            4 => [1, 2, 3],
            1 => [1, 2, 3],
            7 => [1, 2, 3],
            5 => [1, 2, 3],
        ];

        $pertanyaan = DB::select('SELECT pertanyaan_id, aspek_id FROM pertanyaan ORDER BY pertanyaan_id');

        foreach ($pertanyaan as $item) {
            foreach ($kategoriPerAspek[$item->aspek_id] as $kategoriId) {
                DB::table('pertanyaan_kategori')->insert([
                    'pertanyaan_id' => $item->pertanyaan_id,
                    'kategori_id' => $kategoriId,
                ]);
            }
        }
    }
}
