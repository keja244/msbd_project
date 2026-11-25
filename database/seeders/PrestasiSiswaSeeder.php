<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSiswaSeeder extends Seeder
{
    public function run(): void
    {
        // [prestasi_id, siswa_id]
        $relasi = [
            [1, 9],
            [2, 5],
            [2, 3],
            [3, 10],
            [3, 4],
            [4, 7],
            [5, 8],
            [6, 6],
            [7, 6],
            [8, 9],
            [9, 9],
            [9, 14],
            [10, 11],
            [11, 13],
            [12, 12],
        ];

        foreach ($relasi as [$prestasiId, $siswaId]) {
            DB::table('prestasi_siswa')->insert([
                'prestasi_id' => $prestasiId,
                'siswa_id' => $siswaId,
            ]);
        }
    }
}
