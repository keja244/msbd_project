<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'jabatan' => 'nullable|in:guru,tendik',
        ]);

        $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('users.username', $data['username'])
            ->where('users.status', 'Aktif')
            ->whereNull('users.deleted_at')
            ->select(
                'users.user_id',
                'users.username',
                'users.password',
                'users.nama_lengkap',
                'users.role_id',
                'roles.nama_role'
            )
            ->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ]);
        }
        
        $role = match ($user->nama_role) {
            'Super Admin' => 'admin',
            'Humas' => 'humas',
            'Sarpras' => 'sarpras',
            'Kesiswaan' => 'kesiswaan',
            'Kurikulum' => 'kurikulum',
            'Ekstrakulikuler' => 'ekstrakurikuler',
            'Siswa' => 'siswa',
            'Masyarakat' => 'masyarakat',
            'Guru dan Tendik' => 'guru_tendik',
            default => null,
        };

        if ($role === 'guru_tendik' && empty($data['jabatan'])) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'jabatan' => 'Silakan pilih jabatan Guru atau Tendik.',
                ]);
        }

        if (! $role) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Role akun belum memiliki akses ke sistem survei.',
                ]);
        }

        $request->session()->regenerate();

        $request->session()->put([
            'survei.user_id' => $user->user_id,
            'survei.username' => $user->username,
            'survei.nama' => $user->nama_lengkap,
            'survei.role' => $role === 'guru_tendik'
                ? $data['jabatan']
                : $role,
        ]);

        return in_array($role, ['siswa', 'guru_tendik'], true)
            ? redirect()->route('survei.isi')
            : redirect()->route('survei.dashboard.index');
    }

    private function roleGuruTendik(int $userId): string
    {
        $jabatan = DB::table('guru_tendik')
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->value('jabatan');

        if (! $jabatan) {
            return '';
        }

        return str_contains(strtolower($jabatan), 'guru')
            ? 'guru'
            : 'tendik';
    }

    public function tamu(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|in:3',
            'nama' => 'required|string|max:100',
            'kontak' => 'required|string|max:20',
        ]);

        $request->session()->regenerate();

        $request->session()->put([
            'survei.role' => 'tamu',
            'survei.kategori' => 3,
            'survei.nama' => $data['nama'],
            'survei.kontak' => $data['kontak'],
        ]);

        return redirect()->route('survei.isi');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'survei.user_id',
            'survei.username',
            'survei.nama',
            'survei.kontak',
            'survei.role',
            'survei.kategori',
            'survei.selesai',
            'survei.jawaban',
        ]);

        $request->session()->regenerate();

        return redirect()->route('survei.welcome');
    }
}
