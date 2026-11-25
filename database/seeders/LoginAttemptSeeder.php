<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginAttemptSeeder extends Seeder
{
    public function run(): void
    {
        // [user_id, identifier, ip, berhasil, menit_lalu]
        $percobaan = [
            [1, 'superadmin@sekolah.sch.id', '127.0.0.1', 1, 4300],
            [2, 'humas@sekolah.sch.id', '10.20.1.15', 1, 2900],
            [2, 'humas@sekolah.sch.id', '10.20.1.15', 1, 1450],
            [3, 'sarpras@sekolah.sch.id', '10.20.1.21', 0, 1300],
            [3, 'sarpras@sekolah.sch.id', '10.20.1.21', 1, 1297],
            [null, 'admin@sekolah.sch.id', '36.68.112.45', 0, 980],
            [null, 'tamu@contoh.com', '36.68.112.45', 0, 975],
            [4, 'kesiswaan@sekolah.sch.id', '10.20.1.33', 1, 620],
            [8, 'siswa@sekolah.sch.id', '10.20.2.52', 1, 240],
            [5, 'kurikulum@sekolah.sch.id', '10.20.1.40', 1, 95],
        ];

        foreach ($percobaan as [$userId, $identifier, $ip, $berhasil, $menitLalu]) {
            DB::table('login_attempts')->insert([
                'user_id' => $userId,
                'identifier_hash' => hash('sha256', $identifier),
                'ip_address' => $ip,
                'berhasil' => $berhasil,
                'attempted_at' => Carbon::now()->subMinutes($menitLalu)->toDateTimeString(),
            ]);
        }
    }
}
