<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriRespondenSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [1, 'Siswa Aktif', 'Peserta didik yang berstatus aktif di SMA Negeri 2 Medan.', 1],
            [2, 'Guru dan Tenaga Kependidikan', 'Guru, staf tata usaha, dan tenaga kependidikan SMA Negeri 2 Medan.', 1],
            [3, 'Orang Tua/Wali dan Masyarakat', 'Responden eksternal tanpa akun (orang tua/wali murid dan masyarakat umum). Pembedanya ada pada kolom jenis_responden_eksternal di tabel partisipasi.', 0],
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
