<?php

namespace App\Support;

/**
 * DATA CONTOH (tanpa database). Nanti diganti query ke VIEW PostgreSQL per tingkat akses.
 * Angka dibuat deterministik supaya tampilan stabil saat dicoba.
 */
class DataHasil
{
    public const SEMESTER = 'Semester 1 · 2026/2027';
    public const SEMESTER_LALU = 'Semester 2 · 2025/2026';
    public const MIN_KELOMPOK = 5; // kelompok < 5 disembunyikan (HAVING COUNT(*) >= 5 di view nanti)

    public const KATEGORI = [
        'siswa' => 'Siswa', 'guru' => 'Guru', 'tendik' => 'Tendik',
        'orang_tua' => 'Orang Tua', 'masyarakat' => 'Masyarakat',
    ];

    // [jumlah seharusnya, sudah mengisi]
    public const PARTISIPASI = [
        'siswa' => [1200, 742], 'guru' => [80, 61], 'tendik' => [25, 19],
        'orang_tua' => [1200, 118], 'masyarakat' => [40, 4],
    ];

    public const ASPEK = [
        'sarpras' => ['nama' => 'Sarana dan Prasarana', 'bersama' => true, 'kategori' => ['siswa', 'guru', 'tendik']],
        'lingkungan' => ['nama' => 'Lingkungan', 'bersama' => true, 'kategori' => ['siswa', 'guru', 'tendik']],
        'manajemen' => ['nama' => 'Manajemen dan Kebijakan', 'bersama' => true, 'kategori' => ['siswa', 'guru', 'tendik', 'orang_tua']],
        'tata-usaha' => ['nama' => 'Layanan Tata Usaha', 'bersama' => false, 'kategori' => ['siswa']],
        'pembelajaran' => ['nama' => 'Proses Pembelajaran', 'bersama' => false, 'kategori' => ['siswa']],
        'perpustakaan' => ['nama' => 'Perpustakaan', 'bersama' => false, 'kategori' => ['siswa']],
        'kantin' => ['nama' => 'Kantin', 'bersama' => false, 'kategori' => ['siswa']],
        'bk' => ['nama' => 'Layanan BK', 'bersama' => false, 'kategori' => ['siswa']],
        'layanan-tendik' => ['nama' => 'Layanan Tendik', 'bersama' => false, 'kategori' => ['guru']],
        'sarana-mengajar' => ['nama' => 'Dukungan Sarana Mengajar', 'bersama' => false, 'kategori' => ['guru']],
        'beban-kerja' => ['nama' => 'Beban Kerja dan Dukungan Sistem Informasi', 'bersama' => false, 'kategori' => ['tendik']],
        'komunikasi' => ['nama' => 'Komunikasi Sekolah', 'bersama' => false, 'kategori' => ['orang_tua']],
        'administrasi' => ['nama' => 'Layanan Administrasi', 'bersama' => false, 'kategori' => ['orang_tua']],
        'keamanan' => ['nama' => 'Keamanan Lingkungan', 'bersama' => false, 'kategori' => ['orang_tua']],
        'website' => ['nama' => 'Informasi dan Website Sekolah', 'bersama' => false, 'kategori' => ['orang_tua']],
        'sekitar' => ['nama' => 'Lingkungan Sekitar Sekolah', 'bersama' => false, 'kategori' => ['masyarakat']],
        'citra' => ['nama' => 'Citra Sekolah', 'bersama' => false, 'kategori' => ['masyarakat']],
        'info-publik' => ['nama' => 'Layanan Informasi Publik', 'bersama' => false, 'kategori' => ['masyarakat']],
    ];

    // Usulan terakhir di handover (belum final). Nanti jadi tabel role_aspek.
    private const ROLE_ASPEK = [
        'kurikulum' => ['pembelajaran', 'sarana-mengajar'],
        'sarpras' => ['sarpras', 'lingkungan', 'perpustakaan'],
        'kesiswaan' => ['bk', 'kantin'],
    ];

    /** Aspek yang boleh dilihat. Admin, kepsek, humas: semua (humas hanya rata-rata). */
    public static function untukRole(string $role): array
    {
        $slugs = self::ROLE_ASPEK[$role] ?? array_keys(self::ASPEK);

        return array_map(fn ($s) => self::ringkas($s), $slugs);
    }

    public static function boleh(string $role, string $slug): bool
    {
        return isset(self::ASPEK[$slug]) && in_array($slug, self::ROLE_ASPEK[$role] ?? array_keys(self::ASPEK), true);
    }

    public static function bolehRinci(string $role): bool
    {
        return $role !== 'humas';
    }

    public static function bolehTeks(string $role, string $slug): bool
    {
        if (in_array($role, ['admin', 'kepsek'], true)) {
            return true;
        }

        return $role !== 'humas' && $slug !== 'bk'; // isian teks BK hanya admin dan kepsek
    }

    public static function ringkas(string $slug): array
    {
        $a = self::ASPEK[$slug];
        $kat = [];
        $jumlah = 0;
        $sum = 0;
        $sumLalu = 0;

        foreach ($a['kategori'] as $k) {
            $n = self::PARTISIPASI[$k][1];
            $tampil = $n >= self::MIN_KELOMPOK;
            $skor = $tampil ? self::skor($slug, $k, 0) : null;
            $lalu = $tampil ? self::skor($slug, $k, -1) : null;
            $kat[$k] = ['n' => $n, 'tampil' => $tampil, 'skor' => $skor];
            if ($tampil) {
                $sum += $skor * $n;
                $sumLalu += $lalu * $n;
                $jumlah += $n;
            }
        }

        $rata = $jumlah ? round($sum / $jumlah, 1) : null;
        $lalu = $jumlah ? round($sumLalu / $jumlah, 1) : null;

        return [
            'slug' => $slug, 'nama' => $a['nama'], 'bersama' => $a['bersama'], 'kategori' => $kat,
            'rata' => $rata, 'delta' => $rata !== null ? round($rata - $lalu, 1) : null, 'n' => $jumlah,
        ];
    }

    public static function distribusi(float $rata): array
    {
        $w = [];
        for ($i = 1; $i <= 5; $i++) {
            $w[$i] = exp(-(($i - $rata) ** 2) / 1.2);
        }
        $sum = array_sum($w);
        $p = array_map(fn ($x) => (int) round($x / $sum * 100), $w);
        $maks = array_search(max($p), $p);
        $p[$maks] += 100 - array_sum($p);

        return $p;
    }

    public static function teks(string $slug): array
    {
        $nama = mb_strtolower(self::ASPEK[$slug]['nama']);

        return ["Contoh isian: {$nama} sudah cukup baik, tetapi masih bisa ditingkatkan.",
            "Contoh isian: mohon perhatian lebih untuk {$nama}.", "Contoh isian: terima kasih, lanjutkan."];
    }

    public static function partisipasi(): array
    {
        $rows = [];
        foreach (self::PARTISIPASI as $k => [$total, $terisi]) {
            $rows[] = ['nama' => self::KATEGORI[$k], 'total' => $total, 'terisi' => $terisi,
                'persen' => round($terisi / $total * 100), 'wajib' => in_array($k, ['siswa', 'guru', 'tendik'], true)];
        }

        return $rows;
    }

    public static function partisipasiTotal(): array
    {
        $total = array_sum(array_column(self::PARTISIPASI, 0));
        $terisi = array_sum(array_column(self::PARTISIPASI, 1));

        return ['total' => $total, 'terisi' => $terisi, 'persen' => round($terisi / $total * 100)];
    }

    public static function warna(?float $skor): string
    {
        return match (true) {
            $skor === null => 'bg-gray-300 text-gray-700',
            $skor >= 4.0 => 'bg-smanda-green text-white',
            $skor >= 3.4 => 'bg-smanda-yellow text-gray-900',
            default => 'bg-smanda-red text-white',
        };
    }

    private static function skor(string $slug, string $k, int $sem): float
    {
        return round(3.0 + (crc32("$slug|$k|$sem") % 100) / 100 * 1.8, 1);
    }
}