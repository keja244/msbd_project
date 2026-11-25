<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkskulAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        // [ekskul_id (= ekskul_master_id), nama, pembina_id, jadwal, deskripsi, judul_aktivitas, tanggal_kegiatan, foto]
        $aktivitas = [
            [1, 'Pramuka', 11, 'Jumat, 14.30 - 16.30 WIB', 'Latihan rutin kepramukaan untuk anggota penggalang dan penegak.', 'Perkemahan Sabtu-Minggu Gugus Depan', '2026-10-10', 'ekskul/kegiatan/persami.jpg'],
            [2, 'Palang Merah Remaja (PMR)', 5, 'Rabu, 14.30 - 16.00 WIB', 'Pelatihan pertolongan pertama dan kesehatan remaja.', 'Pelatihan Pertolongan Pertama untuk Siswa Baru', '2026-09-20', 'ekskul/kegiatan/pelatihan-p3k.jpg'],
            [3, 'Paskibra', 8, 'Selasa dan Kamis, 15.00 - 16.30 WIB', 'Latihan baris-berbaris dan pengibaran bendera.', 'Seleksi Anggota Paskibra Baru', '2026-08-05', 'ekskul/kegiatan/seleksi-paskibra.jpg'],
            [4, 'Basket', 8, 'Senin dan Kamis, 15.30 - 17.30 WIB', 'Latihan teknik dasar, strategi, dan pertandingan persahabatan.', 'Perempat Final Liga Pelajar Kota Medan', '2026-11-07', 'ekskul/kegiatan/liga-basket.jpg'],
            [5, 'Futsal', 4, 'Jumat, 15.30 - 17.30 WIB', 'Latihan teknik dasar futsal dan simulasi pertandingan.', 'Turnamen Futsal Antarkelas', '2026-09-12', 'ekskul/kegiatan/turnamen-futsal.jpg'],
            [6, 'English Club', 7, 'Rabu, 14.00 - 15.30 WIB', 'Latihan percakapan, debat, dan pidato bahasa Inggris.', 'English Speech Contest Antarkelas', '2026-10-24', 'ekskul/kegiatan/speech-contest.jpg'],
            [7, 'Robotik dan Coding', 6, 'Sabtu, 09.00 - 11.30 WIB', 'Praktik pemrograman dan perakitan robot sederhana.', 'Workshop Dasar Mikrokontroler', '2026-10-31', 'ekskul/kegiatan/workshop-robotik.jpg'],
            [8, 'Karya Ilmiah Remaja (KIR)', 12, 'Kamis, 14.30 - 16.00 WIB', 'Bimbingan penyusunan proposal dan karya tulis ilmiah.', 'Pelatihan Penulisan Karya Tulis Ilmiah', '2026-09-26', 'ekskul/kegiatan/pelatihan-kti.jpg'],
            [9, 'Paduan Suara', 3, 'Selasa, 14.30 - 16.00 WIB', 'Latihan vokal dan harmonisasi lagu wajib dan daerah.', 'Penampilan pada Upacara Hari Guru Nasional', '2026-11-25', 'ekskul/kegiatan/paduan-suara-hgn.jpg'],
            [10, 'Seni Tari dan Budaya Melayu', 2, 'Sabtu, 13.00 - 15.00 WIB', 'Latihan tari tradisional Melayu dan Batak.', 'Pentas Seni Budaya Pekan Kebudayaan Sekolah', '2026-10-17', 'ekskul/kegiatan/pentas-seni.jpg'],
        ];

        foreach ($aktivitas as [$id, $nama, $pembinaId, $jadwal, $deskripsi, $judul, $tanggal, $foto]) {
            DB::table('ekskul_aktivitas')->insert([
                'ekskul_id' => $id,
                'nama_ekskul' => $nama,
                'pembina_id' => $pembinaId,
                'jadwal' => $jadwal,
                'deskripsi' => $deskripsi,
                'created_at' => '2026-11-21 01:35:00',
                'updated_at' => '2026-11-21 01:35:00',
                'deleted_at' => null,
                'ekskul_master_id' => $id,
                'judul_aktivitas' => $judul,
                'tanggal_kegiatan' => $tanggal,
                'foto_kegiatan' => $foto,
            ]);
        }
    }
}
