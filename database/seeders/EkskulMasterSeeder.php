<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkskulMasterSeeder extends Seeder
{
    public function run(): void
    {
        // [id, nama, visi, misi, deskripsi, logo, pembina_id]
        $master = [
            [1, 'Pramuka', 'Membentuk generasi muda yang berkarakter, mandiri, dan cinta tanah air.', 'Melatih kedisiplinan, kepemimpinan, dan kepedulian sosial melalui kegiatan kepramukaan.', 'Kegiatan kepramukaan wajib bagi siswa kelas X dengan program latihan rutin, perkemahan, dan bakti sosial.', 'ekskul/logo/pramuka.png', 11],
            [2, 'Palang Merah Remaja (PMR)', 'Menjadi relawan remaja yang sigap, peduli, dan berjiwa kemanusiaan.', 'Membekali anggota dengan keterampilan pertolongan pertama dan kesehatan remaja.', 'Wadah pembinaan relawan kesehatan sekolah, mencakup pelatihan P3K, donor darah, dan kampanye hidup sehat.', 'ekskul/logo/pmr.png', 5],
            [3, 'Paskibra', 'Mencetak pasukan pengibar bendera yang disiplin, tangguh, dan nasionalis.', 'Melatih baris-berbaris, kedisiplinan, dan sikap kebangsaan anggota.', 'Pembinaan pasukan pengibar bendera untuk upacara sekolah dan kegiatan kedinasan.', 'ekskul/logo/paskibra.png', 8],
            [4, 'Basket', 'Mengembangkan prestasi olahraga bola basket yang sportif dan berkarakter.', 'Menyelenggarakan latihan terjadwal dan mengikuti kompetisi antarsekolah.', 'Latihan bola basket putra dan putri serta persiapan turnamen pelajar tingkat kota dan provinsi.', 'ekskul/logo/basket.png', 8],
            [5, 'Futsal', 'Menjadi tim futsal sekolah yang kompetitif dan menjunjung sportivitas.', 'Meningkatkan kemampuan teknik dan kerja sama tim melalui latihan rutin.', 'Latihan futsal serta keikutsertaan dalam liga pelajar.', 'ekskul/logo/futsal.png', 4],
            [6, 'English Club', 'Membangun siswa yang percaya diri berkomunikasi dalam bahasa Inggris.', 'Melatih speaking, debat, dan penulisan bahasa Inggris secara menyenangkan.', 'Klub bahasa Inggris dengan kegiatan English debate, speech contest, dan story telling.', 'ekskul/logo/english-club.png', 7],
            [7, 'Robotik dan Coding', 'Melahirkan inovator muda yang melek teknologi.', 'Mengenalkan pemrograman, elektronika dasar, dan rancang bangun robot.', 'Pembelajaran pemrograman dasar, mikrokontroler, dan persiapan kompetisi robotik pelajar.', 'ekskul/logo/robotik.png', 6],
            [8, 'Karya Ilmiah Remaja (KIR)', 'Menumbuhkan budaya meneliti dan berpikir kritis di kalangan siswa.', 'Membimbing penyusunan karya tulis ilmiah dan penelitian sederhana.', 'Wadah penelitian remaja untuk lomba karya ilmiah dan olimpiade penelitian.', 'ekskul/logo/kir.png', 12],
            [9, 'Paduan Suara', 'Menjadi paduan suara sekolah yang harmonis dan berprestasi.', 'Melatih teknik vokal dan penampilan di berbagai acara sekolah dan lomba.', 'Latihan vokal grup untuk upacara, perpisahan, dan festival paduan suara pelajar.', 'ekskul/logo/paduan-suara.png', 3],
            [10, 'Seni Tari dan Budaya Melayu', 'Melestarikan seni dan budaya daerah Sumatera Utara.', 'Melatih tari tradisional Melayu dan Batak serta tampil pada acara budaya.', 'Latihan tari tradisional dan pengenalan budaya Melayu, Batak, dan Nusantara.', 'ekskul/logo/seni-tari.png', 2],
        ];

        foreach ($master as [$id, $nama, $visi, $misi, $deskripsi, $logo, $pembinaId]) {
            DB::table('ekskul_master')->insert([
                'ekskul_master_id' => $id,
                'nama_ekskul' => $nama,
                'visi' => $visi,
                'misi' => $misi,
                'deskripsi' => $deskripsi,
                'logo' => $logo,
                'pembina_id' => $pembinaId,
                'status' => 'Aktif',
                'created_at' => '2026-11-21 01:30:00',
                'updated_at' => '2026-11-21 01:30:00',
                'deleted_at' => null,
            ]);
        }
    }
}
