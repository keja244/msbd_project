<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAspekSeeder extends Seeder
{
    public function run(): void
    {
        // Aspek: 1 = Layanan, 4 = Sarana Prasarana, 5 = Kesiswaan, 7 = Kurikulum
        $akses = [
            1 => [1, 4, 5, 7], // Super Admin
            2 => [1, 4, 5, 7], // Humas (seluruh aspek)
            3 => [4],          // Sarpras
            4 => [5],          // Kesiswaan
            5 => [7],          // Kurikulum
        ];

        foreach ($akses as $roleId => $aspekIds) {
            foreach ($aspekIds as $aspekId) {
                DB::table('role_aspek')->insert([
                    'role_id' => $roleId,
                    'aspek_id' => $aspekId,
                ]);
            }
        }
    }
}
