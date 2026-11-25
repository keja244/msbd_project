<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaFotoSeeder extends Seeder
{
    public function run(): void
    {
        // [berita_id, nama_file, keterangan]
        $foto = [
            [1, 'ppdb-spanduk.jpg', 'Spanduk informasi penerimaan murid baru di gerbang sekolah'],
            [2, 'osn-penyerahan-piala.jpg', 'Penyerahan piala kepada siswa peraih juara'],
            [2, 'osn-bersama-pembina.jpg', 'Foto bersama guru pembina olimpiade'],
            [3, 'asesmen-ruang-kelas.jpg', 'Suasana asesmen sumatif di ruang kelas'],
            [4, 'lab-komputer-baru.jpg', 'Deretan komputer baru di laboratorium'],
            [5, 'basket-pertandingan.jpg', 'Pertandingan perempat final tim basket putra'],
            [6, 'pramuka-api-unggun.jpg', 'Api unggun pada malam perkemahan'],
            [7, 'alumni-diskusi.jpg', 'Diskusi bersama alumni di aula sekolah'],
            [8, 'pmr-praktik-pembalutan.jpg', 'Praktik pembalutan luka oleh siswa kelas X'],
            [8, 'pmr-bersama-pembina.jpg', 'Anggota PMR bersama pembina'],
        ];

        foreach ($foto as [$beritaId, $file, $keterangan]) {
            DB::table('berita_foto')->insert([
                'berita_id' => $beritaId,
                'path_file' => 'berita/galeri/' . $file,
                'keterangan' => $keterangan,
                'file_foto' => $file,
            ]);
        }
    }
}
