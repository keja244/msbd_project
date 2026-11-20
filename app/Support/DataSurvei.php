<?php

namespace App\Support;

/**
 * DATA SEMENTARA (tanpa database). Nanti diganti query ke tabel aspek/pertanyaan.
 * Pertanyaan di sini hanya placeholder, daftar aslinya menyusul.
 */
class DataSurvei
{
    public const NAMA = [
        'siswa' => 'Siswa', 'guru' => 'Guru', 'tendik' => 'Tendik / Pegawai',
        'orang_tua' => 'Orang Tua / Wali', 'masyarakat' => 'Masyarakat',
    ];

    private const ASPEK = [
        'siswa' => ['Sarana dan Prasarana', 'Lingkungan', 'Layanan Tata Usaha', 'Proses Pembelajaran',
            'Manajemen dan Kebijakan Sekolah', 'Perpustakaan', 'Kantin', 'Layanan BK'],
        'guru' => ['Sarana dan Prasarana', 'Lingkungan', 'Layanan Tendik', 'Manajemen dan Kebijakan',
            'Dukungan Sarana Mengajar'],
        'tendik' => ['Sarana dan Prasarana', 'Lingkungan Kerja', 'Manajemen dan Kebijakan',
            'Beban Kerja dan Dukungan Sistem Informasi'],
        'orang_tua' => ['Komunikasi Sekolah', 'Layanan Administrasi', 'Keamanan Lingkungan',
            'Informasi dan Website Sekolah', 'Manajemen dan Kebijakan'],
        'masyarakat' => ['Lingkungan Sekitar Sekolah', 'Citra Sekolah', 'Layanan Informasi Publik'],
    ];

    /** @return array<int, array{aspek:string, pertanyaan:array<int, array{id:int, teks:string}>}> */
    public static function pertanyaan(string $kategori): array
    {
        $id = 0;
        $hasil = [];
        foreach (self::ASPEK[$kategori] ?? [] as $aspek) {
            $nama = mb_strtolower($aspek);
            $hasil[] = ['aspek' => $aspek, 'pertanyaan' => [
                ['id' => ++$id, 'teks' => "Secara umum, saya puas dengan {$nama} di SMAN 2 Medan."],
                ['id' => ++$id, 'teks' => "{$aspek} sudah mendukung kebutuhan saya."],
            ]];
        }

        return $hasil;
    }

    public static function semuaId(string $kategori): array
    {
        return collect(self::pertanyaan($kategori))->pluck('pertanyaan')->flatten(1)->pluck('id')->all();
    }
}