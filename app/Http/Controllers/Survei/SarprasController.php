<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SarprasController extends Controller
{
    /**
     * Tampilkan daftar fasilitas sarana dan prasarana.
     */
    public function index()
    {
        $fasilitas = DB::table('sarana_prasarana')
            ->whereNull('deleted_at')
            ->orderByDesc('sarpras_id')
            ->get();

        $totalFasilitas = $fasilitas->count();
        $totalBaik = $fasilitas->where('kondisi', 'Baik')->count();
        $totalRusakRingan = $fasilitas->where('kondisi', 'Rusak Ringan')->count();
        $totalRusakBerat = $fasilitas->where('kondisi', 'Rusak Berat')->count();

        return view('survei.dashboard.sarpras.fasilitas-index', compact(
            'fasilitas',
            'totalFasilitas',
            'totalBaik',
            'totalRusakRingan',
            'totalRusakBerat'
        ));
    }

    /**
     * Form tambah fasilitas sarana dan prasarana.
     */
    public function create()
    {
        return view('survei.dashboard.sarpras.fasilitas-create');
    }

    /**
     * Simpan fasilitas baru beserta upload foto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'kategori.required' => 'Kategori fasilitas wajib diisi.',
            'kondisi.required' => 'Kondisi wajib dipilih.',
            'jumlah.required' => 'Jumlah unit wajib diisi minimal 1.',
            'deskripsi.required' => 'Penjelasan/deskripsi fasilitas wajib diisi.',
            'foto.image' => 'File harus berupa gambar (JPG, PNG, WEBP).',
            'foto.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($validated['nama_fasilitas']) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/sarpras');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $fotoPath = 'uploads/sarpras/' . $filename;
        }

        $userId = session('survei.user_id');

        DB::table('sarana_prasarana')->insert([
            'nama_fasilitas' => $validated['nama_fasilitas'],
            'kategori' => $validated['kategori'],
            'kondisi' => $validated['kondisi'],
            'jumlah' => $validated['jumlah'],
            'keterangan' => $validated['keterangan'] ?? null,
            'deskripsi' => $validated['deskripsi'],
            'foto' => $fotoPath,
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('survei.dashboard.sarpras.index')
            ->with('success', 'Fasilitas sarpras dan foto berhasil disimpan ke database.');
    }

    /**
     * Form edit fasilitas.
     */
    public function edit(int $id)
    {
        $fasilitas = DB::table('sarana_prasarana')
            ->where('sarpras_id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (! $fasilitas) {
            return redirect()
                ->route('survei.dashboard.sarpras.index')
                ->with('error', 'Fasilitas tidak ditemukan.');
        }

        return view('survei.dashboard.sarpras.fasilitas-edit', compact('fasilitas'));
    }

    /**
     * Update data fasilitas dan ganti foto jika ada.
     */
    public function update(Request $request, int $id)
    {
        $fasilitas = DB::table('sarana_prasarana')
            ->where('sarpras_id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (! $fasilitas) {
            return redirect()
                ->route('survei.dashboard.sarpras.index')
                ->with('error', 'Fasilitas tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $fotoPath = $fasilitas->foto;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($validated['nama_fasilitas']) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/sarpras');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $fotoPath = 'uploads/sarpras/' . $filename;
        }

        DB::table('sarana_prasarana')
            ->where('sarpras_id', $id)
            ->update([
                'nama_fasilitas' => $validated['nama_fasilitas'],
                'kategori' => $validated['kategori'],
                'kondisi' => $validated['kondisi'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'] ?? null,
                'deskripsi' => $validated['deskripsi'],
                'foto' => $fotoPath,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('survei.dashboard.sarpras.index')
            ->with('success', 'Data fasilitas sarpras berhasil diperbarui.');
    }

    /**
     * Hapus fasilitas (soft delete).
     */
    public function destroy(int $id)
    {
        DB::table('sarana_prasarana')
            ->where('sarpras_id', $id)
            ->update([
                'deleted_at' => now(),
            ]);

        return redirect()
            ->route('survei.dashboard.sarpras.index')
            ->with('success', 'Fasilitas sarpras berhasil dihapus.');
    }

    /**
     * Tampilkan daftar pertanyaan survei khusus aspek Sarpras.
     */
    public function pertanyaanIndex()
    {
        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        $pertanyaan = collect();
        if ($periode) {
            $pertanyaan = DB::table('pertanyaan')
                ->where('survei_id', $periode->survei_id)
                ->where('aspek_id', 4) // Aspek Sarana dan Prasarana
                ->whereNull('deleted_at')
                ->orderBy('urutan')
                ->orderBy('pertanyaan_id')
                ->get();
        }

        return view('survei.dashboard.sarpras.pertanyaan-index', compact('periode', 'pertanyaan'));
    }

    /**
     * Form tambah pertanyaan survei aspek Sarpras.
     */
    public function pertanyaanCreate()
    {
        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        $aspekSarpras = DB::table('aspek')->where('aspek_id', 4)->first();

        // Cari urutan berikutnya
        $urutanBerikutnya = 1;
        if ($periode) {
            $last = DB::table('pertanyaan')
                ->where('survei_id', $periode->survei_id)
                ->where('aspek_id', 4)
                ->max('urutan');
            $urutanBerikutnya = ($last ?? 0) + 1;
        }

        return view('survei.dashboard.sarpras.pertanyaan-create', compact('periode', 'aspekSarpras', 'urutanBerikutnya'));
    }

    /**
     * Simpan pertanyaan survei baru untuk aspek Sarpras.
     */
    public function pertanyaanStore(Request $request)
    {
        $validated = $request->validate([
            'teks_pertanyaan' => 'required|string|max:1000',
            'jenis' => 'required|in:Skala,Esai,Pilihan',
            'urutan' => 'nullable|integer|min:1',
            'inti' => 'nullable|boolean',
        ], [
            'teks_pertanyaan.required' => 'Teks pertanyaan survei wajib diisi.',
            'jenis.required' => 'Jenis pertanyaan wajib dipilih.',
        ]);

        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        if (! $periode) {
            return back()->with('error', 'Tidak ada periode survei aktif saat ini.');
        }

        // Pastikan relasi aspek_kategori ada untuk memenuhi foreign key fk_pertanyaan_aspek_survei
        DB::table('aspek_kategori')->updateOrInsert(
            ['aspek_id' => 4, 'survei_id' => $periode->survei_id],
            ['kategori_id' => 1]
        );

        $urutan = $validated['urutan'] ?? (
            (DB::table('pertanyaan')
                ->where('survei_id', $periode->survei_id)
                ->where('aspek_id', 4)
                ->max('urutan') ?? 0) + 1
        );

        DB::table('pertanyaan')->insert([
            'survei_id' => $periode->survei_id,
            'aspek_id' => 4, // Khusus aspek Sarana dan Prasarana
            'teks_pertanyaan' => $validated['teks_pertanyaan'],
            'jenis' => $validated['jenis'],
            'urutan' => $urutan,
            'inti' => $request->boolean('inti'),
            'aktif' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('survei.dashboard.sarpras.pertanyaan')
            ->with('success', 'Pertanyaan survei aspek sarpras berhasil dibuat dan disimpan ke database.');
    }

    /**
     * Form edit pertanyaan survei aspek Sarpras.
     */
    public function pertanyaanEdit(int $id)
    {
        $pertanyaan = DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->where('aspek_id', 4)
            ->whereNull('deleted_at')
            ->first();

        if (! $pertanyaan) {
            return redirect()
                ->route('survei.dashboard.sarpras.pertanyaan')
                ->with('error', 'Pertanyaan survei tidak ditemukan.');
        }

        return view('survei.dashboard.sarpras.pertanyaan-edit', compact('pertanyaan'));
    }

    /**
     * Update pertanyaan survei aspek Sarpras.
     */
    public function pertanyaanUpdate(Request $request, int $id)
    {
        $pertanyaan = DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->where('aspek_id', 4)
            ->whereNull('deleted_at')
            ->first();

        if (! $pertanyaan) {
            return redirect()
                ->route('survei.dashboard.sarpras.pertanyaan')
                ->with('error', 'Pertanyaan survei tidak ditemukan.');
        }

        $validated = $request->validate([
            'teks_pertanyaan' => 'required|string|max:1000',
            'jenis' => 'required|in:Skala,Esai,Pilihan',
            'urutan' => 'required|integer|min:1',
            'aktif' => 'nullable|boolean',
            'inti' => 'nullable|boolean',
        ]);

        DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->update([
                'teks_pertanyaan' => $validated['teks_pertanyaan'],
                'jenis' => $validated['jenis'],
                'urutan' => $validated['urutan'],
                'aktif' => $request->boolean('aktif'),
                'inti' => $request->boolean('inti'),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('survei.dashboard.sarpras.pertanyaan')
            ->with('success', 'Pertanyaan survei berhasil diperbarui.');
    }

    /**
     * Hapus pertanyaan survei aspek Sarpras (soft delete).
     */
    public function pertanyaanDestroy(int $id)
    {
        DB::table('pertanyaan')
            ->where('pertanyaan_id', $id)
            ->where('aspek_id', 4)
            ->update([
                'deleted_at' => now(),
            ]);

        return redirect()
            ->route('survei.dashboard.sarpras.pertanyaan')
            ->with('success', 'Pertanyaan survei aspek sarpras berhasil dihapus.');
    }
}
