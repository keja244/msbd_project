<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = DB::table('survei')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->paginate(10);

        return view('survei.pengelola.periode', [
            'mode' => 'index',
            'periode' => $periode,
        ]);
    }

    public function create()
    {
        return view('survei.pengelola.periode', [
            'mode' => 'create',
            'aspek' => DB::table('aspek')->orderBy('nama_aspek')->get(),
            'kategori' => DB::table('kategori_responden')
                ->orderBy('kategori_id')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validasiPeriode($request);
        $relasi = $this->validasiRelasi($request);

        DB::transaction(function () use ($data, $relasi) {
            $data['created_at'] = now();
            $data['updated_at'] = now();

            $surveiId = DB::table('survei')->insertGetId($data);

            $this->simpanRelasi($surveiId, $relasi);
        });

        return redirect()
            ->route('survei.dashboard.periode.index')
            ->with('success', 'Periode survei berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $periodeData = DB::table('survei')
            ->where('survei_id', $id)
            ->whereNull('deleted_at')
            ->first();

        abort_if(!$periodeData, 404);

        $relasi = DB::table('aspek_kategori')
            ->where('survei_id', $id)
            ->get()
            ->groupBy('aspek_id');

        $aspekTerpilih = $relasi->keys()->map(fn ($id) => (int) $id)->all();

        $semuaKategori = [];
        $kategoriTerpilih = [];

        foreach ($relasi as $aspekId => $items) {
            if ($items->contains(fn ($item) => $item->kategori_id === null)) {
                $semuaKategori[] = (int) $aspekId;
            } else {
                $kategoriTerpilih[$aspekId] = $items
                    ->pluck('kategori_id')
                    ->map(fn ($id) => (int) $id)
                    ->all();
            }
        }

        return view('survei.pengelola.periode', [
            'mode' => 'edit',
            'periodeData' => $periodeData,
            'aspek' => DB::table('aspek')->orderBy('nama_aspek')->get(),
            'kategori' => DB::table('kategori_responden')
                ->orderBy('kategori_id')
                ->get(),
            'aspekTerpilih' => $aspekTerpilih,
            'semuaKategori' => $semuaKategori,
            'kategoriTerpilih' => $kategoriTerpilih,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $periodeData = DB::table('survei')
            ->where('survei_id', $id)
            ->whereNull('deleted_at')
            ->first();

        abort_if(!$periodeData, 404);

        $data = $this->validasiPeriode($request);
        $relasi = $this->validasiRelasi($request);

        DB::transaction(function () use ($id, $data, $relasi) {
            $data['updated_at'] = now();

            DB::table('survei')
                ->where('survei_id', $id)
                ->update($data);

            DB::table('aspek_kategori')
                ->where('survei_id', $id)
                ->delete();

            $this->simpanRelasi($id, $relasi);
        });

        return redirect()
            ->route('survei.dashboard.periode.index')
            ->with('success', 'Periode survei berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        DB::table('survei')
            ->where('survei_id', $id)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('survei.dashboard.periode.index')
            ->with('success', 'Periode survei berhasil dihapus.');
    }

    private function validasiPeriode(Request $request)
    {
        return $request->validate([
            'judul_survei' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|in:1,2',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Selesai,Arsip',
            'metode_ikm' => 'required|in:INTERNAL,KONVERSI,BOTH',
            'skala_min' => 'required|integer|min:1|max:10',
            'skala_max' => 'required|integer|min:2|max:10|gt:skala_min',
            'faktor_konversi' => 'required|numeric|min:0.01',
        ]);
    }

    private function validasiRelasi(Request $request)
    {
        $data = $request->validate([
            'aspek_ids' => 'required|array|min:1',
            'aspek_ids.*' => 'required|integer|distinct|exists:aspek,aspek_id',
            'semua_kategori' => 'nullable|array',
            'kategori_ids' => 'nullable|array',
        ]);

        $semuaKategori = $request->input('semua_kategori', []);
        $kategoriIds = $request->input('kategori_ids', []);

        $kategoriValid = DB::table('kategori_responden')
            ->pluck('kategori_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $relasi = [];

        foreach ($data['aspek_ids'] as $aspekId) {
            $aspekId = (int) $aspekId;

            if (isset($semuaKategori[$aspekId])) {
                $relasi[] = [
                    'aspek_id' => $aspekId,
                    'kategori_id' => null,
                ];

                continue;
            }

            $pilihan = array_map(
                'intval',
                $kategoriIds[$aspekId] ?? []
            );

            $pilihan = array_values(array_unique($pilihan));

            if (empty($pilihan)) {
                throw ValidationException::withMessages([
                    'aspek_ids' => 'Pilih semua kategori atau minimal satu kategori untuk setiap aspek yang dipilih.',
                ]);
            }

            foreach ($pilihan as $kategoriId) {
                if (!in_array($kategoriId, $kategoriValid, true)) {
                    throw ValidationException::withMessages([
                        'kategori_ids' => 'Kategori responden tidak valid.',
                    ]);
                }

                $relasi[] = [
                    'aspek_id' => $aspekId,
                    'kategori_id' => $kategoriId,
                ];
            }
        }

        return $relasi;
    }

    private function simpanRelasi($surveiId, array $relasi)
    {
        $waktu = now();

        $data = array_map(function ($item) use ($surveiId, $waktu) {
            return [
                'survei_id' => $surveiId,
                'aspek_id' => $item['aspek_id'],
                'kategori_id' => $item['kategori_id'],
            ];
        }, $relasi);

        DB::table('aspek_kategori')->insert($data);
    }
}
