<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Semua akun memakai password mentah yang sama: "password1234" (disimpan dalam bentuk hash).
        $password = Hash::make('password1234');

        // Skema pada database ini belum memiliki kolom remember_token.
        // Jika kolom tersebut ditambahkan kelak, nilainya otomatis diisi null.
        $punyaRememberToken = Schema::hasColumn('users', 'remember_token');

        $users = [
            [1, 1, 'superadmin', 'superadmin@sekolah.sch.id', 'Super Administrator', '2026-11-21 00:48:14', '2026-11-21 00:59:23'],
            [2, 2, 'humas', 'humas@sekolah.sch.id', 'Admin Humas', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
            [3, 3, 'sarpras', 'sarpras@sekolah.sch.id', 'Admin Sarana Prasarana', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
            [4, 4, 'kesiswaan', 'kesiswaan@sekolah.sch.id', 'Admin Kesiswaan', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
            [5, 5, 'kurikulum', 'kurikulum@sekolah.sch.id', 'Admin Kurikulum', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
            [6, 6, 'ekstrakurikuler', 'ekstrakurikuler@sekolah.sch.id', 'Admin Ekstrakurikuler', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
            [7, 7, 'guru_tendik', 'guru@sekolah.sch.id', 'Guru dan Tenaga Kependidikan', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
            [8, 8, 'siswa', 'siswa@sekolah.sch.id', 'Pengguna Siswa', '2026-11-21 00:48:14', '2026-11-21 01:01:13'],
        ];

        foreach ($users as [$id, $roleId, $username, $email, $nama, $createdAt, $updatedAt]) {
            $row = [
                'user_id' => $id,
                'role_id' => $roleId,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'status' => 'Aktif',
                'nama_lengkap' => $nama,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'deleted_at' => null,
            ];

            if ($punyaRememberToken) {
                $row['remember_token'] = null;
            }

            DB::table('users')->insert($row);
        }
    }
}
