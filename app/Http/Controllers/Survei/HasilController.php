<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use App\Support\DataHasil;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('survei.role');

        return view('survei.dashboard.hasil', [
            'role' => $role,
            'semester' => DataHasil::SEMESTER,
            'aspek' => DataHasil::untukRole($role),
            'rinci' => DataHasil::bolehRinci($role), // humas: hanya rata-rata per aspek
            'kategori' => DataHasil::KATEGORI,
        ]);
    }

    public function show(Request $request, $aspek)
    {
        $role = $request->session()->get('survei.role');

        abort_unless(isset(DataHasil::ASPEK[$aspek]), 404);
        abort_unless(DataHasil::bolehRinci($role) && DataHasil::boleh($role, $aspek), 403);

        $data = DataHasil::ringkas($aspek);

        return view('survei.dashboard.hasil-detail', [
            'a' => $data,
            'kategori' => DataHasil::KATEGORI,
            'semester' => DataHasil::SEMESTER,
            'distribusi' => $data['rata'] !== null ? DataHasil::distribusi($data['rata']) : null,
            'teks' => DataHasil::bolehTeks($role, $aspek) ? DataHasil::teks($aspek) : null,
        ]);
    }
}