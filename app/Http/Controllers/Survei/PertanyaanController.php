<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
    // Mengambil aspek yang boleh dikelola berdasarkan role.
    private function aspekIdsPengelola(): array
    {
        $role = session('survei.role');

        // Super Admin memiliki akses ke semua aspek.
        if ($role === 'admin') {
            return DB::table('aspek')
                ->pluck('aspek_id')
                ->map(fn ($id) => (int) $id)
                ->all();
        }

        $namaRole = [
            'humas' => 'Humas',
            'kurikulum' => 'Kurikulum',
            'sarpras' => 'Sarpras',
            'kesiswaan' => 'Kesiswaan',
        ][$role] ?? null;

        abort_if(!$namaRole, 403);

        return DB::table('role_aspek as ra')
            ->join('roles as r', 'r.role_id', '=', 'ra.role_id')
            ->where('r.nama_role', $namaRole)
            ->pluck('ra.aspek_id')
            ->map(fn ($id) => (int) $id)
            ->all();
    }

    // Memastikan aspek terdaftar pada periode survei.
    private function validasiAspekSurvei(int $aspekId, int $surveiId): void
    {
        abort_unless(
            in_array($aspekId, $this->aspekIdsPengelola(), true),
            403,
            'Anda tidak memiliki akses untuk mengelola aspek ini.'
        );

        $terdaftar = DB::table('aspek_kategori')
            ->where('aspek_id', $aspekId)
            ->where('survei_id', $surveiId)
            ->exists();

        abort_unless(
            $terdaftar,
            422,
            'Aspek tersebut belum terdaftar pada periode survei yang dipilih.'
        );
    }

    public function index()
    {
        $aspekIds = $this->aspekIdsPengelola();

        $pertanyaan = DB::table('pertanyaan as p')
            ->join('survei as s', 's.survei_id', '=', 'p.survei_id')
            ->join('aspek as a', 'a.aspek_id', '=', 'p.aspek_id')
            ->whereIn('p.aspek_id', $aspekIds)
            ->whereNull('p.deleted_at')
            ->whereNull('s.deleted_at')
            ->select('p.*', 's.judul_survei', 'a.nama_aspek')
            ->orderByDesc('p.survei_id')
            ->orderBy('p.urutan')
            ->paginate(15);

        return view('survei.pengelola.pertanyaan', [
            'mode' => 'index',
            'pertanyaan' => $pertanyaan,
        ]);
    }

    public function create()
    {
        $aspekIds = $this->aspekIdsPengelola();

        $survei = DB::table('survei')
            ->whereNull('deleted_at')
            ->whereExists(function ($query) use ($aspekIds) {
                $query->selectRaw('1')
                    ->from('aspek_kategori as ak')
                    ->whereColumn('ak.survei_id', 'survei.survei_id')
                    ->whereIn('ak.aspek_id', $aspekIds);
            })
            ->orderByDesc('survei_id')
            ->get();

        $aspek = DB::table('aspek')
            ->whereIn('aspek_id', $aspekIds)
            ->orderBy('nama_aspek')
            ->get();

        return view('survei.pengelola.pertanyaan', [
            'mode' => 'create',
            'survei' => $survei,
            'aspek' => $aspek,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'survei_id' => 'required|exists:survei,survei_id',
            'aspek_id' => 'required|exists:aspek,aspek_id',
            'teks_pertanyaan' => 'required|string',
            'jenis' => 'required|in:Skala,Pilihan,Esai',
            'urutan' => 'required|integer|min:1',
        ]);

        $this->validasiAspekSurvei(
            (int) $data['aspek_id'],
            (int) $data['survei_id']
        );

        $data['inti'] = $request->boolean('inti');
        $data['aktif'] = $request->boolean('aktif');
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('pertanyaan')->insert($data);

        return redirect()
            ->route('survei.dashboard.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $aspekIds = $this->aspekIdsPengelola();

        $pertanyaanData = DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->whereIn('aspek_id', $aspekIds)
            ->whereNull('deleted_at')
            ->first();

        abort_if(!$pertanyaanData, 404);

        $survei = DB::table('survei')
            ->whereNull('deleted_at')
            ->whereExists(function ($query) use ($aspekIds) {
                $query->selectRaw('1')
                    ->from('aspek_kategori as ak')
                    ->whereColumn('ak.survei_id', 'survei.survei_id')
                    ->whereIn('ak.aspek_id', $aspekIds);
            })
            ->orderByDesc('survei_id')
            ->get();

        $aspek = DB::table('aspek')
            ->whereIn('aspek_id', $aspekIds)
            ->orderBy('nama_aspek')
            ->get();

        return view('survei.pengelola.pertanyaan', [
            'mode' => 'edit',
            'pertanyaanData' => $pertanyaanData,
            'survei' => $survei,
            'aspek' => $aspek,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $aspekIds = $this->aspekIdsPengelola();

        $pertanyaanData = DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->whereIn('aspek_id', $aspekIds)
            ->whereNull('deleted_at')
            ->first();

        abort_if(!$pertanyaanData, 404);

        $data = $request->validate([
            'survei_id' => 'required|exists:survei,survei_id',
            'aspek_id' => 'required|exists:aspek,aspek_id',
            'teks_pertanyaan' => 'required|string',
            'jenis' => 'required|in:Skala,Pilihan,Esai',
            'urutan' => 'required|integer|min:1',
        ]);

        $this->validasiAspekSurvei(
            (int) $data['aspek_id'],
            (int) $data['survei_id']
        );

        $data['inti'] = $request->boolean('inti');
        $data['aktif'] = $request->boolean('aktif');
        $data['updated_at'] = now();

        DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->update($data);

        return redirect()
            ->route('survei.dashboard.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $aspekIds = $this->aspekIdsPengelola();

        $pertanyaan = DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->whereIn('aspek_id', $aspekIds)
            ->whereNull('deleted_at')
            ->first();

        abort_if(!$pertanyaan, 404);

        DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->update([
                'deleted_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('survei.dashboard.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
