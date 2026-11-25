<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkskulOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        // [ekskul_id (= ekskul_master_id), siswa_id, jabatan]
        $pengurus = [
            [1, 9, 'Ketua'],
            [1, 6, 'Sekretaris'],
            [2, 10, 'Ketua'],
            [2, 2, 'Bendahara'],
            [3, 11, 'Ketua'],
            [4, 5, 'Ketua'],
            [5, 3, 'Ketua'],
            [6, 8, 'Ketua'],
            [7, 7, 'Ketua'],
            [8, 4, 'Wakil Ketua'],
            [9, 1, 'Sekretaris'],
            [10, 6, 'Ketua'],
        ];

        foreach ($pengurus as [$ekskulId, $siswaId, $jabatan]) {
            DB::table('ekskul_organisasi')->insert([
                'ekskul_id' => $ekskulId,
                'siswa_id' => $siswaId,
                'jabatan' => $jabatan,
                'periode' => '2026/2027',
                'ekskul_master_id' => $ekskulId,
            ]);
        }
    }
}
