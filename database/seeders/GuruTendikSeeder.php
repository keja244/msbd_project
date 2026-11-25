<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruTendikSeeder extends Seeder
{
    public function run(): void
    {
        // [tendik_id, user_id, nip, nama_lengkap, jk, jabatan, bidang_studi, no_telepon]
        $guru = [
            [1, 7, '197508122000122001', 'Dra. Rosmawati Siregar, M.Pd.', 'P', 'Kepala Sekolah', 'Bahasa Indonesia', '081265001001'],
            [2, null, '197803152003121004', 'Drs. Bambang Hermanto, M.Si.', 'L', 'Wakil Kepala Sekolah Bidang Kurikulum', 'Matematika', '081265001002'],
            [3, null, '198001202005012003', 'Hj. Rina Marlina Nasution, S.Pd.', 'P', 'Wakil Kepala Sekolah Bidang Kesiswaan', 'Bahasa Inggris', '081265001003'],
            [4, null, '197609092002121002', 'Ir. Poltak Manurung, M.M.', 'L', 'Wakil Kepala Sekolah Bidang Sarpras', 'Fisika', '081265001004'],
            [5, null, '198205252008012011', 'Sri Wahyuni, S.Pd.', 'P', 'Guru Mata Pelajaran', 'Biologi', '081265001005'],
            [6, null, '198809172014021001', 'Andi Surya Wijaya, S.Kom.', 'L', 'Guru Mata Pelajaran', 'Informatika', '081265001006'],
            [7, null, '198507012010012019', 'Lestari Handayani, M.Pd.', 'P', 'Guru Mata Pelajaran', 'Bahasa Inggris', '081265001007'],
            [8, null, '198311102009031003', 'Hotman Sihombing, S.Pd.', 'L', 'Guru Mata Pelajaran', 'Pendidikan Jasmani', '081265001008'],
            [9, null, '197912052006042005', 'Fitri Yani Lubis, S.Sos.', 'P', 'Kepala Tata Usaha', null, '081265001009'],
            [10, null, '199002182015031002', 'Ruli Tampubolon, A.Md.', 'L', 'Staf Tata Usaha', null, '081265001010'],
            [11, null, '198106232007011004', 'Syahrial Pulungan, S.Pd.', 'L', 'Guru Mata Pelajaran', 'Sejarah', '081265001011'],
            [12, null, '198704142012122002', 'Melisa Chandra, S.Pd.', 'P', 'Guru Mata Pelajaran', 'Kimia', '081265001012'],
        ];

        foreach ($guru as [$id, $userId, $nip, $nama, $jk, $jabatan, $bidang, $telp]) {
            DB::table('guru_tendik')->insert([
                'tendik_id' => $id,
                'user_id' => $userId,
                'nip' => $nip,
                'nama_lengkap' => $nama,
                'jenis_kelamin' => $jk,
                'jabatan' => $jabatan,
                'bidang_studi' => $bidang,
                'no_telepon' => $telp,
                'created_at' => '2026-11-21 01:15:00',
                'updated_at' => '2026-11-21 01:15:00',
                'deleted_at' => null,
            ]);
        }
    }
}
