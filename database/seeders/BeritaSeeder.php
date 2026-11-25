<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        // [berita_id, judul, slug, kategori, status, user_id, gambar_utama, created_at, konten]
        $berita = [
            [1, 'Penerimaan Murid Baru Tahun Ajaran 2027/2028 Segera Dibuka', 'penerimaan-murid-baru-tahun-ajaran-2027-2028-segera-dibuka', 'Pengumuman', 'Published', 2, 'berita/ppdb-2027.jpg', '2026-11-03 08:30:00',
                'Panitia PPDB SMA Negeri 2 Medan menginformasikan bahwa tahapan penerimaan murid baru tahun ajaran 2027/2028 akan segera dibuka. Calon peserta didik dan orang tua diminta memantau jadwal, persyaratan, serta alur pendaftaran melalui website resmi sekolah. Informasi lengkap akan diperbarui secara berkala oleh panitia.'],
            [2, 'Siswa SMA Negeri 2 Medan Raih Juara 2 Olimpiade Sains Tingkat Provinsi', 'siswa-sma-negeri-2-medan-raih-juara-2-olimpiade-sains-tingkat-provinsi', 'Prestasi', 'Published', 2, 'berita/osn-provinsi.jpg', '2026-10-27 10:15:00',
                'Salah satu siswa kelas XII berhasil meraih Juara 2 pada ajang olimpiade sains tingkat provinsi bidang matematika. Keberhasilan ini merupakan buah dari bimbingan intensif guru pembina dan latihan rutin setiap pekan. Pihak sekolah mengucapkan selamat dan berharap prestasi ini menginspirasi siswa lainnya.'],
            [3, 'Pelaksanaan Asesmen Sumatif Akhir Semester Ganjil Berjalan Lancar', 'pelaksanaan-asesmen-sumatif-akhir-semester-ganjil-berjalan-lancar', 'Akademik', 'Published', 5, 'berita/asesmen-sumatif.jpg', '2026-11-16 07:45:00',
                'Asesmen sumatif akhir semester ganjil dilaksanakan selama satu pekan penuh dengan tertib dan lancar. Seluruh siswa mengikuti asesmen sesuai jadwal yang telah ditetapkan oleh wakil kepala sekolah bidang kurikulum. Hasil asesmen akan dibagikan bersamaan dengan penyerahan laporan hasil belajar.'],
            [4, 'Revitalisasi Laboratorium Komputer Rampung, Siap Dipakai untuk Pembelajaran Informatika', 'revitalisasi-laboratorium-komputer-rampung-siap-dipakai-untuk-pembelajaran-informatika', 'Sarana Prasarana', 'Published', 3, 'berita/lab-komputer.jpg', '2026-10-19 13:00:00',
                'Laboratorium komputer SMA Negeri 2 Medan telah selesai direvitalisasi dengan penambahan unit komputer, perbaikan instalasi listrik, dan penataan ulang ruangan. Fasilitas ini akan digunakan untuk pembelajaran informatika serta kegiatan ekstrakurikuler robotik dan pemrograman.'],
            [5, 'Tim Basket Putra Melaju ke Semifinal Liga Pelajar Kota Medan', 'tim-basket-putra-melaju-ke-semifinal-liga-pelajar-kota-medan', 'Ekstrakurikuler', 'Published', 6, 'berita/basket-semifinal.jpg', '2026-11-09 16:20:00',
                'Tim basket putra SMA Negeri 2 Medan berhasil melaju ke babak semifinal Liga Pelajar Kota Medan setelah menang dalam laga perempat final. Pelatih menyampaikan bahwa kekompakan tim dan latihan rutin menjadi kunci keberhasilan. Dukungan dari seluruh warga sekolah sangat diharapkan pada pertandingan berikutnya.'],
            [6, 'Perkemahan Sabtu-Minggu Gugus Depan Pramuka Berlangsung Meriah', 'perkemahan-sabtu-minggu-gugus-depan-pramuka-berlangsung-meriah', 'Ekstrakurikuler', 'Published', 6, 'berita/persami-pramuka.jpg', '2026-10-12 18:00:00',
                'Gugus depan Pramuka SMA Negeri 2 Medan menggelar perkemahan Sabtu-Minggu yang diikuti puluhan anggota penggalang dan penegak. Kegiatan diisi dengan latihan baris-berbaris, tali-temali, kegiatan bakti lingkungan, dan api unggun. Pembina berharap kegiatan ini memperkuat karakter disiplin dan kepedulian sosial.'],
            [7, 'Kunjungan Edukasi Alumni: Berbagi Pengalaman Kuliah di Perguruan Tinggi Negeri', 'kunjungan-edukasi-alumni-berbagi-pengalaman-kuliah-di-perguruan-tinggi-negeri', 'Kegiatan Sekolah', 'Published', 2, 'berita/alumni-sharing.jpg', '2026-10-30 11:00:00',
                'Sejumlah alumni hadir di sekolah untuk berbagi pengalaman seputar jalur masuk perguruan tinggi, strategi belajar, dan kehidupan kampus. Siswa kelas XII antusias bertanya mengenai jalur SNBP, SNBT, dan seleksi mandiri. Kegiatan ini diselenggarakan oleh bidang kesiswaan bersama humas sekolah.'],
            [8, 'Tim PMR Gelar Pelatihan Pertolongan Pertama untuk Siswa Baru', 'tim-pmr-gelar-pelatihan-pertolongan-pertama-untuk-siswa-baru', 'Ekstrakurikuler', 'Published', 6, 'berita/pmr-pelatihan.jpg', '2026-09-22 09:40:00',
                'Palang Merah Remaja SMA Negeri 2 Medan mengadakan pelatihan pertolongan pertama bagi siswa kelas X. Materi mencakup penanganan luka ringan, teknik pembalutan, dan evakuasi sederhana. Para peserta mengikuti kegiatan dengan antusias dan praktik langsung didampingi pembina.'],
            [9, 'Jadwal Kegiatan Pembagian Laporan Hasil Belajar Semester Ganjil', 'jadwal-kegiatan-pembagian-laporan-hasil-belajar-semester-ganjil', 'Pengumuman', 'Draft', 2, null, '2026-11-20 14:10:00',
                'Pembagian laporan hasil belajar semester ganjil direncanakan akan dilaksanakan setelah seluruh proses penilaian selesai. Orang tua atau wali murid akan menerima undangan resmi melalui wali kelas masing-masing. Jadwal final masih menunggu keputusan rapat dewan guru.'],
            [10, 'Rencana Lomba Karya Ilmiah Remaja Antarkelas', 'rencana-lomba-karya-ilmiah-remaja-antarkelas', 'Ekstrakurikuler', 'Draft', 6, null, '2026-11-22 10:05:00',
                'Ekstrakurikuler Karya Ilmiah Remaja merencanakan lomba karya ilmiah antarkelas dengan tema lingkungan hidup dan teknologi tepat guna. Pendaftaran tim dan ketentuan lomba masih disusun oleh pembina bersama pengurus.'],
        ];

        foreach ($berita as [$id, $judul, $slug, $kategori, $status, $userId, $gambar, $createdAt, $konten]) {
            DB::table('berita')->insert([
                'berita_id' => $id,
                'judul' => $judul,
                'slug' => $slug,
                'konten' => $konten,
                'kategori' => $kategori,
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null,
                'user_id' => $userId,
                'gambar_utama' => $gambar,
            ]);
        }
    }
}
