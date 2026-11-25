<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriRespondenSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama' => 'Guru dan Tendik',
                'deskripsi' => 'Responden dari kalangan guru dan tenaga kependidikan.',
                'wajib' => 0,
            ],
            [
                'nama' => 'Siswa',
                'deskripsi' => 'Responden dari kalangan siswa.',
                'wajib' => 0,
            ],
            [
                'nama' => 'Orang Tua/Masyarakat',
                'deskripsi' => 'Responden dari kalangan orang tua siswa atau masyarakat umum.',
                'wajib' => 0,
            ],
        ];

        foreach ($kategori as $data) {
            DB::table('kategori_responden')->updateOrInsert(
                ['nama' => $data['nama']],
                $data
            );
        }
    }
}