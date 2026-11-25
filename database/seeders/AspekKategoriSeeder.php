<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspekKategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Setiap pasangan (aspek, survei) wajib ada di sini karena menjadi
        // target foreign key fk_pertanyaan_aspek_survei dari tabel pertanyaan.
        $aspekIds = [4, 7, 5, 1]; // Sarana Prasarana, Kurikulum, Kesiswaan, Layanan

        foreach ([1, 2, 3] as $surveiId) {
            foreach ($aspekIds as $aspekId) {
                DB::table('aspek_kategori')->insert([
                    'aspek_id' => $aspekId,
                    'survei_id' => $surveiId,
                    'kategori_id' => null, // null = berlaku untuk seluruh kategori responden (dibatasi lewat pertanyaan_kategori)
                ]);
            }
        }
    }
}
