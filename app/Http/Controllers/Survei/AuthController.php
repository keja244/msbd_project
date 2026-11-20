<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private const RESPONDEN = ['siswa', 'guru', 'tendik'];
    private const PENGELOLA = ['admin', 'kepsek', 'humas', 'kurikulum', 'sarpras', 'kesiswaan'];

    // MODE DEMO (tanpa database): username = nama role, kata sandi bebas.
    // Nanti diganti dengan pengecekan ke tabel akun.
    public function login(Request $request)
    {
        $data = $request->validate(['username' => 'required|string', 'password' => 'required|string']);
        $role = strtolower(trim($data['username']));

        if (! in_array($role, [...self::RESPONDEN, ...self::PENGELOLA], true)) {
            return back()->withInput($request->only('username'))
                ->withErrors(['username' => 'Mode demo: isi username dengan nama role, mis. siswa, guru, tendik, admin.']);
        }

        $request->session()->regenerate();
        $request->session()->put('survei.role', $role);

        return in_array($role, self::RESPONDEN, true)
            ? redirect()->route('survei.isi')
            : redirect()->route('survei.dashboard.index');
    }

    public function tamu(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|in:orang_tua,masyarakat',
            'nama' => 'required|string|max:100',
            'kontak' => 'required|string|max:20',
        ]);

        $request->session()->regenerate();
        $request->session()->put('survei.role', 'tamu');
        $request->session()->put('survei.kategori', $data['kategori']);

        return redirect()->route('survei.isi');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['survei.role', 'survei.kategori', 'survei.selesai', 'survei.jawaban']);

        return redirect()->route('survei.welcome');
    }
}