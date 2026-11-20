<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use App\Support\DataHasil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('survei.role');
        $aspek = collect(DataHasil::untukRole($role))->filter(fn ($a) => $a['rata'] !== null)->sortByDesc('rata')->values();

        return view('survei.dashboard.index', [
            'role' => $role,
            'semester' => DataHasil::SEMESTER,
            'rataAll' => round($aspek->avg('rata'), 1),
            'jumlahAspek' => $aspek->count(),
            'tertinggi' => $aspek->take(3),
            'terendah' => $aspek->reverse()->take(3)->values(),
            'lihatPartisipasi' => in_array($role, ['admin', 'kepsek', 'humas'], true),
            'partisipasi' => DataHasil::partisipasi(),
            'total' => DataHasil::partisipasiTotal(),
        ]);
    }
}