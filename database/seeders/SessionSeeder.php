<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    public function run(): void
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36';

        // [user_id, ip, detik_lalu]
        $sesi = [
            [1, '127.0.0.1', 120],
            [2, '10.20.1.15', 600],
            [3, '10.20.1.21', 1500],
            [null, '36.68.112.45', 2400],
            [8, '10.20.2.52', 3600],
        ];

        foreach ($sesi as [$userId, $ip, $detikLalu]) {
            $payload = serialize([
                '_token' => bin2hex(random_bytes(20)),
                '_previous' => ['url' => 'http://127.0.0.1:8000', 'route' => null],
                '_flash' => ['old' => [], 'new' => []],
            ]);

            DB::table('sessions')->insert([
                'id' => bin2hex(random_bytes(20)),
                'user_id' => $userId,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'payload' => base64_encode($payload),
                'last_activity' => time() - $detikLalu,
            ]);
        }
    }
}
