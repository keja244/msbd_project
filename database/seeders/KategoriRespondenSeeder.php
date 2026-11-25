<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriRespondenSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
<<<<<<< HEAD
            [1, 'Siswa Aktif', 'Peserta didik yang berstatus aktif di SMA Negeri 2 Medan.', 1],
            [2, 'Guru dan Tenaga Kependidikan', 'Guru, staf tata usaha, dan tenaga kependidikan SMA Negeri 2 Medan.', 1],
            [3, 'Orang Tua/Wali', 'Orang tua atau wali dari peserta didik SMA Negeri 2 Medan.', 0],
            [4, 'Masyarakat Umum', 'Masyarakat sekitar dan pihak eksternal yang berinteraksi dengan sekolah.', 0],
            [5, 'Alumni', 'Lulusan SMA Negeri 2 Medan dari berbagai angkatan.', 0],
        ];

        foreach ($kategori as [$id, $nama, $deskripsi, $wajib]) {
            DB::table('kategori_responden')->insert([
                'kategori_id' => $id,
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'wajib' => $wajib,
            ]);
        }
    }
}
=======
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
>>>>>>> main
