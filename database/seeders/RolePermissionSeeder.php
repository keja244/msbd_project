<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = '2026-11-21 00:55:00';

        $akses = [
            1 => range(1, 23),                              // Super Admin: seluruh permission
            2 => [4, 5, 6, 7, 21, 22, 23],                  // Humas
            3 => [8, 9, 10, 21, 22, 23],                    // Sarpras
            4 => [11, 12, 13, 14, 15, 21, 22, 23],          // Kesiswaan
            5 => [16, 17, 18, 21, 22, 23],                  // Kurikulum
            6 => [13, 19, 20, 21],                          // Ekstrakurikuler
            7 => [21, 22, 23],                              // Guru dan Tendik
            8 => [21, 22, 23],                              // Siswa
        ];

        foreach ($akses as $roleId => $permissionIds) {
            foreach ($permissionIds as $permissionId) {
                DB::table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                    'created_at' => $timestamp,
                ]);
            }
        }
    }
}
