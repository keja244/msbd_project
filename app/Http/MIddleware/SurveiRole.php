<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SurveiRole
{
    // Sementara membaca role dari session('survei.role'). Nanti diganti dari tabel akun.
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $role = $request->session()->get('survei.role');

        if (! $role) {
            return redirect()->route('survei.welcome');
        }
        if (! in_array($role, $roles, true)) {
            abort(403, 'Role Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}