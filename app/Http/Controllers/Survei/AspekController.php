<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AspekController extends Controller
{
    // Mengambil daftar divisi yang boleh mengelola pertanyaan.
    private function daftarRolePengelola()
    {
        return DB::table('roles')
            ->whereIn('nama_role', [
                'Humas',
                'Kurikulum',
                'Sarpras',
                'Kesiswaan',
            ])
            ->orderBy('nama_role')
            ->get();
    }

    // Memeriksa pilihan divisi sesuai jenis aspek.
    private function validasiRoleIds(array $roleIds, int $bersama): array
    {
        $roleIds = array_map('intval', $roleIds);

        $allowedIds = $this->daftarRolePengelola()
            ->pluck('role_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        if (count(array_diff($roleIds, $allowedIds)) > 0) {
            throw ValidationException::withMessages([
                'role_ids' => 'Pilihan divisi tidak valid.',
            ]);
        }

        if ($bersama === 0 && count($roleIds) > 1) {
            throw ValidationException::withMessages([
                'role_ids' => 'Aspek khusus hanya boleh ditugaskan kepada satu divisi.',
            ]);
        }

        return array_values(array_unique($roleIds));
    }

    public function index()
    {
        $aspek = DB::table('aspek')
            ->orderBy('nama_aspek')
            ->get();

        return view('survei.pengelola.aspek', [
            'mode' => 'index',
            'aspek' => $aspek,
        ]);
    }

    public function create()
    {
        return view('survei.pengelola.aspek', [
            'mode' => 'create',
            'roles' => $this->daftarRolePengelola(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_aspek' => 'required|string|max:100|unique:aspek,nama_aspek',
            'bobot' => 'nullable|numeric|min:0|max:999.99',
            'deskripsi' => 'nullable|string',
            'bersama' => 'required|boolean',
            'role_ids' => 'required|array|min:1',
            'role_ids.*' => 'required|integer|distinct|exists:roles,role_id',
        ]);

        $roleIds = $this->validasiRoleIds(
            $data['role_ids'],
            (int) $data['bersama']
        );

        unset($data['role_ids']);

        DB::transaction(function () use ($data, $roleIds) {
            $aspekId = DB::table('aspek')->insertGetId(
                [
                    'nama_aspek' => $data['nama_aspek'],
                    'bobot' => $data['bobot'] ?? 1.00,
                    'deskripsi' => $data['deskripsi'] ?? null,
                    'bersama' => $data['bersama'],
                ],
                'aspek_id'
            );

            foreach ($roleIds as $roleId) {
                DB::table('role_aspek')->insert([
                    'role_id' => $roleId,
                    'aspek_id' => $aspekId,
                ]);
            }
        });

        return redirect()
            ->route('survei.dashboard.aspek.index')
            ->with('success', 'Aspek berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $aspekData = DB::table('aspek')
            ->where('aspek_id', $id)
            ->first();

        abort_if(!$aspekData, 404);

        $selectedRoleIds = DB::table('role_aspek')
            ->where('aspek_id', $id)
            ->pluck('role_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('survei.pengelola.aspek', [
            'mode' => 'edit',
            'aspekData' => $aspekData,
            'roles' => $this->daftarRolePengelola(),
            'selectedRoleIds' => $selectedRoleIds,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $aspekData = DB::table('aspek')
            ->where('aspek_id', $id)
            ->first();

        abort_if(!$aspekData, 404);

        $data = $request->validate([
            'nama_aspek' => 'required|string|max:100|unique:aspek,nama_aspek,' . $id . ',aspek_id',
            'bobot' => 'nullable|numeric|min:0|max:999.99',
            'deskripsi' => 'nullable|string',
            'bersama' => 'required|boolean',
            'role_ids' => 'required|array|min:1',
            'role_ids.*' => 'required|integer|distinct|exists:roles,role_id',
        ]);

        $roleIds = $this->validasiRoleIds(
            $data['role_ids'],
            (int) $data['bersama']
        );

        unset($data['role_ids']);

        DB::transaction(function () use ($data, $roleIds, $id) {
            DB::table('aspek')
                ->where('aspek_id', $id)
                ->update([
                    'nama_aspek' => $data['nama_aspek'],
                    'bobot' => $data['bobot'] ?? 1.00,
                    'deskripsi' => $data['deskripsi'] ?? null,
                    'bersama' => $data['bersama'],
                ]);

            DB::table('role_aspek')
                ->where('aspek_id', $id)
                ->delete();

            foreach ($roleIds as $roleId) {
                DB::table('role_aspek')->insert([
                    'role_id' => $roleId,
                    'aspek_id' => $id,
                ]);
            }
        });

        return redirect()
            ->route('survei.dashboard.aspek.index')
            ->with('success', 'Aspek berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $aspekData = DB::table('aspek')
            ->where('aspek_id', $id)
            ->first();

        abort_if(!$aspekData, 404);

        DB::transaction(function () use ($id) {
            DB::table('role_aspek')
                ->where('aspek_id', $id)
                ->delete();

            DB::table('aspek')
                ->where('aspek_id', $id)
                ->delete();
        });

        return redirect()
            ->route('survei.dashboard.aspek.index')
            ->with('success', 'Aspek berhasil dihapus.');
    }
}
