<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordResetTokenSeeder extends Seeder
{
    public function run(): void
    {
        // [user_id, jam_lalu_dibuat, sudah_dipakai]
        $token = [
            [7, 72, true],
            [8, 48, true],
            [9, 30, false],
            [2, 5, false],
            [4, 1, false],
        ];

        foreach ($token as $n => [$userId, $jamLalu, $dipakai]) {
            $dibuat = Carbon::now()->subHours($jamLalu);

            DB::table('password_reset_tokens')->insert([
                'user_id' => $userId,
                'token_hash' => hash('sha256', 'seeder-reset-token-' . ($n + 1)),
                'expires_at' => $dibuat->copy()->addHour()->toDateTimeString(),
                'used_at' => $dipakai ? $dibuat->copy()->addMinutes(12)->toDateTimeString() : null,
                'created_at' => $dibuat->toDateTimeString(),
            ]);
        }
    }
}
