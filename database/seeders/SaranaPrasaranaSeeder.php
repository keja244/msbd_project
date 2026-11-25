<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaranaPrasaranaSeeder extends Seeder
{
    public function run(): void
    {
        // [id, nama_fasilitas, kategori, kondisi, jumlah, keterangan, deskripsi, foto]
        $sarpras = [
            [1, 'Ruang Kelas Reguler', 'Ruang Pembelajaran', 'Baik', 36, 'Dilengkapi proyektor dan pendingin ruangan pada sebagian kelas.', 'Ruang kelas X, XI, dan XII yang digunakan untuk kegiatan belajar mengajar sehari-hari.', 'sarpras/ruang-kelas.jpg'],
            [2, 'Laboratorium Komputer', 'Laboratorium', 'Baik', 2, 'Telah direvitalisasi pada Oktober 2026.', 'Laboratorium dengan komputer terhubung jaringan untuk pembelajaran informatika dan ekskul robotik.', 'sarpras/lab-komputer.jpg'],
            [3, 'Laboratorium Fisika', 'Laboratorium', 'Baik', 1, 'Alat praktikum lengkap untuk materi kelas X sampai XII.', 'Laboratorium untuk praktikum mekanika, optik, dan listrik dasar.', 'sarpras/lab-fisika.jpg'],
            [4, 'Laboratorium Kimia', 'Laboratorium', 'Rusak Ringan', 1, 'Beberapa lemari asam memerlukan perbaikan ventilasi.', 'Laboratorium praktikum kimia dengan peralatan gelas dan bahan praktikum.', 'sarpras/lab-kimia.jpg'],
            [5, 'Laboratorium Biologi', 'Laboratorium', 'Baik', 1, 'Mikroskop dan preparat tersedia untuk satu kelas penuh.', 'Laboratorium praktikum biologi dan pengamatan sel serta jaringan.', 'sarpras/lab-biologi.jpg'],
            [6, 'Perpustakaan Sekolah', 'Perpustakaan', 'Baik', 1, 'Koleksi buku dan sudut baca digital.', 'Perpustakaan dengan ruang baca, rak koleksi, dan area diskusi.', 'sarpras/perpustakaan.jpg'],
            [7, 'Lapangan Basket dan Futsal', 'Olahraga', 'Rusak Ringan', 2, 'Permukaan lapangan sebagian retak dan perlu pengecatan ulang.', 'Lapangan serbaguna untuk pelajaran jasmani, ekstrakurikuler, dan pertandingan.', 'sarpras/lapangan.jpg'],
            [8, 'Masjid Sekolah', 'Ibadah', 'Baik', 1, 'Kapasitas sekitar 300 jamaah.', 'Tempat ibadah dan kegiatan keagamaan siswa serta guru.', 'sarpras/masjid.jpg'],
            [9, 'Unit Kesehatan Sekolah (UKS)', 'Kesehatan', 'Baik', 1, 'Dilengkapi tempat tidur pasien dan kotak P3K.', 'Ruang pertolongan pertama dan pemeriksaan kesehatan siswa.', 'sarpras/uks.jpg'],
            [10, 'Toilet Siswa', 'Sanitasi', 'Rusak Ringan', 20, 'Beberapa keran dan pintu bilik perlu diganti.', 'Fasilitas toilet putra dan putri di beberapa titik gedung sekolah.', 'sarpras/toilet.jpg'],
            [11, 'Aula Serbaguna', 'Ruang Kegiatan', 'Baik', 1, 'Kapasitas sekitar 400 orang dengan sistem tata suara.', 'Aula untuk upacara tertutup, rapat, seminar, dan pentas seni.', 'sarpras/aula.jpg'],
            [12, 'Kantin Sekolah', 'Penunjang', 'Rusak Berat', 1, 'Atap dan instalasi air memerlukan perbaikan besar.', 'Area kantin tempat siswa dan guru makan serta berbelanja kebutuhan harian.', 'sarpras/kantin.jpg'],
        ];

        foreach ($sarpras as [$id, $nama, $kategori, $kondisi, $jumlah, $keterangan, $deskripsi, $foto]) {
            DB::table('sarana_prasarana')->insert([
                'sarpras_id' => $id,
                'nama_fasilitas' => $nama,
                'kategori' => $kategori,
                'kondisi' => $kondisi,
                'jumlah' => $jumlah,
                'keterangan' => $keterangan,
                'created_at' => '2026-11-21 01:50:00',
                'updated_at' => '2026-11-21 01:50:00',
                'deleted_at' => null,
                'user_id' => 3,
                'deskripsi' => $deskripsi,
                'foto' => $foto,
            ]);
        }
    }
}
