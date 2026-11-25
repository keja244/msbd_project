<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkskulGaleriSeeder extends Seeder
{
    public function run(): void
    {
        // [ekskul_id, nama_file, caption]
        $galeri = [
            [1, 'pramuka-persami-1.jpg', 'Anggota Pramuka mendirikan tenda saat perkemahan Sabtu-Minggu.'],
            [2, 'pmr-p3k-1.jpg', 'Anggota PMR mempraktikkan teknik pembalutan luka.'],
            [3, 'paskibra-latihan-1.jpg', 'Latihan baris-berbaris Paskibra di halaman sekolah.'],
            [4, 'basket-liga-1.jpg', 'Tim basket putra saat bertanding pada Liga Pelajar Kota Medan.'],
            [5, 'futsal-turnamen-1.jpg', 'Pertandingan final turnamen futsal antarkelas.'],
            [6, 'english-club-speech-1.jpg', 'Peserta English Speech Contest tampil di depan juri.'],
            [7, 'robotik-workshop-1.jpg', 'Peserta workshop merakit rangkaian mikrokontroler.'],
            [8, 'kir-pelatihan-1.jpg', 'Anggota KIR berdiskusi menyusun proposal penelitian.'],
            [9, 'paduan-suara-1.jpg', 'Penampilan paduan suara pada upacara sekolah.'],
            [10, 'seni-tari-1.jpg', 'Penari membawakan tari tradisional Melayu pada pentas seni.'],
        ];

        foreach ($galeri as [$ekskulId, $file, $caption]) {
            DB::table('ekskul_galeri')->insert([
                'ekskul_id' => $ekskulId,
                'path_file' => 'ekskul/galeri/' . $file,
                'caption' => $caption,
                'created_at' => '2026-11-21 01:40:00',
                'file_foto' => $file,
                'keterangan' => $caption,
            ]);
        }
    }
}
