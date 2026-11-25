<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use App\Support\DataSurvei;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('survei.responden.selesai')) {
            return redirect()->route('survei.selesai');
        }

        $kategori = $this->kategori($request);

        $namaKategori = match ((string) $kategori) {
            '1', 'guru', 'tendik' => 'Guru / Tendik',
            '2', 'siswa' => 'Siswa',
            '3' => $request->session()->get('survei.jenis_responden_eksternal', 'Orang Tua/Wali'),
            default => 'Responden',
        };

<<<<<<< HEAD
        // Ambil periode survei aktif dari database
        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        $aspek = [];

        if ($periode) {
            $pertanyaanDb = DB::table('pertanyaan as p')
                ->join('aspek as a', 'p.aspek_id', '=', 'a.aspek_id')
                ->where('p.survei_id', $periode->survei_id)
                ->where('p.aktif', 1)
                ->where('p.jenis', 'Skala') // Pertanyaan skala nilai
                ->whereNull('p.deleted_at')
                ->select(
                    'p.pertanyaan_id as id',
                    'p.teks_pertanyaan as teks',
                    'p.jenis',
                    'a.aspek_id',
                    'a.nama_aspek'
                )
                ->orderBy('a.aspek_id')
                ->orderBy('p.urutan')
                ->get();

            if ($pertanyaanDb->isNotEmpty()) {
                foreach ($pertanyaanDb->groupBy('nama_aspek') as $namaAspek => $items) {
                    $aspek[] = [
                        'aspek' => $namaAspek,
                        'pertanyaan' => $items->map(fn ($q) => [
                            'id' => $q->id,
                            'teks' => $q->teks,
                            'jenis' => $q->jenis,
                        ])->values()->toArray(),
                    ];
                }
            }
        }

        // Fallback jika database belum ada pertanyaan
        if (empty($aspek)) {
            $aspek = DataSurvei::pertanyaan((string) $kategori);
        }

        return view('survei.isi', [
=======
        return view('survei.responden.isi', [
>>>>>>> main
            'role' => $request->session()->get('survei.role'),
            'namaKategori' => $namaKategori,
            'aspek' => $aspek,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->session()->get('survei.responden.selesai')) {
            return redirect()->route('survei.selesai');
        }

        $kategori = $this->kategori($request);

<<<<<<< HEAD
        $periode = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->orderByDesc('survei_id')
            ->first();

        $rules = [
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer|between:1,5',
            'isian' => 'nullable|string|max:1000',
        ];

        $data = $request->validate($rules);

        $kategoriId = match ((string) $kategori) {
            '1', 'siswa' => 1,
            '2', 'guru', 'tendik' => 2,
            default => 3,
        };

        $userId = $request->session()->get('survei.user_id');
        $surveiId = $periode ? $periode->survei_id : 1;

        // Cek apakah user terdaftar sebagai siswa atau guru_tendik
        $siswa = $userId ? DB::table('siswa')->where('user_id', $userId)->first() : null;
        $guruTendik = $userId ? DB::table('guru_tendik')->where('user_id', $userId)->first() : null;

        $siswaId = null;
        $guruTendikId = null;
        $identitasHash = null;

        if ($siswa) {
            $respondenTipe = 'SISWA';
            $siswaId = $siswa->siswa_id;
        } elseif ($guruTendik) {
            $respondenTipe = 'GURU_TENDIK';
            $guruTendikId = $guruTendik->tendik_id;
        } else {
            // Anonim (umum, tamu, atau akun tanpa profil langsung)
            $respondenTipe = 'ANONIM';
            $identitasHash = hash('sha256', ($userId ?? 'guest') . '_' . microtime(true) . '_' . mt_rand());
        }

        // Simpan partisipasi ke database
        try {
            DB::beginTransaction();

            $partisipasiId = DB::table('partisipasi')->insertGetId([
                'survei_id' => $surveiId,
                'kategori_id' => $kategoriId,
                'tanggal_isi' => now(),
                'responden_tipe' => $respondenTipe,
                'siswa_id' => $siswaId,
                'guru_tendik_id' => $guruTendikId,
                'identitas_hash' => $identitasHash,
                'ip_address' => $request->ip() ?? '127.0.0.1',
                'saran' => $data['isian'] ?? null,
            ]);

            // Simpan setiap jawaban skala ke tabel jawaban
            foreach ($data['jawaban'] as $pertanyaanId => $skor) {
                // Pastikan pertanyaan_id valid di tabel pertanyaan
                $adaPertanyaan = DB::table('pertanyaan')
                    ->where('pertanyaan_id', $pertanyaanId)
                    ->exists();

                if ($adaPertanyaan) {
                    DB::table('jawaban')->insert([
                        'partisipasi_id' => $partisipasiId,
                        'pertanyaan_id' => $pertanyaanId,
                        'survei_id' => $surveiId,
                        'kategori_id' => $kategoriId,
                        'skor' => (int) $skor,
                        'opsi_id' => null,
                        'isian' => null,
                    ]);
                }
            }

            // Jika ada isian saran dan ada pertanyaan jenis Esai di survei, simpan
            if (! empty($data['isian'])) {
                $pertanyaanEsai = DB::table('pertanyaan')
                    ->where('survei_id', $surveiId)
                    ->where('jenis', 'Esai')
                    ->where('aktif', 1)
                    ->whereNull('deleted_at')
                    ->first();

                if ($pertanyaanEsai) {
                    DB::table('jawaban')->insert([
                        'partisipasi_id' => $partisipasiId,
                        'pertanyaan_id' => $pertanyaanEsai->pertanyaan_id,
                        'survei_id' => $surveiId,
                        'kategori_id' => $kategoriId,
                        'skor' => null,
                        'opsi_id' => null,
                        'isian' => $data['isian'],
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Gagal simpan partisipasi/jawaban: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            throw $e;
        }

        $request->session()->put('survei.jawaban', $data);
        $request->session()->put('survei.selesai', true);
=======
        $kategoriId = match ((string) $kategori) {
            '1', 'guru', 'tendik' => 1,
            '2', 'siswa' => 2,
            '3' => 3,
            default => null,
        };

        if (!$kategoriId) {
            return back()->withErrors([
                'survei' => 'Kategori responden tidak valid.',
            ]);
        }

        $tanggal = now()->toDateString();

        $survei = DB::table('survei')
            ->where('status', 'Aktif')
            ->whereNull('deleted_at')
            ->whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('tanggal_selesai', '>=', $tanggal)
            ->orderByDesc('tanggal_mulai')
            ->first();

        if (!$survei) {
            return back()->withErrors([
                'survei' => 'Tidak ada periode survei yang sedang berlangsung.',
            ]);
        }

        $pertanyaanIds = DataSurvei::semuaId((string) $kategori);

        if (empty($pertanyaanIds)) {
            return back()->withErrors([
                'survei' => 'Belum ada pertanyaan untuk kategori responden ini.',
            ]);
        }

        $rules = [
            'isian' => 'nullable|string|max:1000',
        ];

        foreach ($pertanyaanIds as $id) {
            $rules["jawaban.$id"] = [
                'required',
                'integer',
                'between:' . $survei->skala_min . ',' . $survei->skala_max,
            ];
        }

        $data = $request->validate($rules);

        $partisipasiData = [
            'survei_id' => $survei->survei_id,
            'kategori_id' => $kategoriId,
            'ip_address' => $request->ip(),
            'saran' => $data['isian'] ?? null,
        ];

        $identitasHash = null;

        if ($kategoriId === 3) {
            $kontak = preg_replace(
                '/\D+/',
                '',
                $request->session()->get('survei.kontak', '')
            );

            if (!$kontak) {
                return back()->withErrors([
                    'kontak' => 'Nomor kontak responden tidak ditemukan.',
                ]);
            }

            $identitasHash = hash(
                'sha256',
                $survei->survei_id . '|' . $kontak
            );

            $partisipasiData = array_merge($partisipasiData, [
                'responden_tipe' => 'ANONIM',
                'jenis_responden_eksternal' => $request->session()->get('survei.jenis_responden_eksternal'),
                'nama_responden' => $request->session()->get('survei.nama'),
                'no_hp' => $request->session()->get('survei.kontak'),
                'identitas_hash' => $identitasHash,
            ]);
        } elseif ($kategoriId === 2) {
            $siswa = DB::table('siswa')
                ->where('user_id', $request->session()->get('survei.user_id'))
                ->whereNull('deleted_at')
                ->first();

            if (!$siswa) {
                return back()->withErrors([
                    'survei' => 'Data siswa tidak ditemukan.',
                ]);
            }

            $partisipasiData['responden_tipe'] = 'SISWA';
            $partisipasiData['siswa_id'] = $siswa->siswa_id;
        } else {
            $guruTendik = DB::table('guru_tendik')
                ->where('user_id', $request->session()->get('survei.user_id'))
                ->whereNull('deleted_at')
                ->first();

            if (!$guruTendik) {
                return back()->withErrors([
                    'survei' => 'Data Guru atau Tendik tidak ditemukan.',
                ]);
            }

            $partisipasiData['responden_tipe'] = 'GURU_TENDIK';
            $partisipasiData['guru_tendik_id'] = $guruTendik->tendik_id;
        }

        $sudahMengisi = DB::table('partisipasi')
            ->where('survei_id', $survei->survei_id)
            ->where(function ($query) use ($kategoriId, $partisipasiData, $identitasHash) {
                if ($kategoriId === 3) {
                    $query->where('identitas_hash', $identitasHash);
                } elseif ($kategoriId === 2) {
                    $query->where('siswa_id', $partisipasiData['siswa_id']);
                } else {
                    $query->where('guru_tendik_id', $partisipasiData['guru_tendik_id']);
                }
            })
            ->exists();

        if ($sudahMengisi) {
            return back()->withErrors([
                'survei' => 'Identitas ini sudah pernah mengisi survei pada periode tersebut.',
            ]);
        }

        DB::transaction(function () use ($partisipasiData, $data, $pertanyaanIds, $survei, $kategoriId) {
            $partisipasiId = DB::table('partisipasi')
                ->insertGetId($partisipasiData);

            foreach ($pertanyaanIds as $id) {
                DB::table('jawaban')->insert([
                    'survei_id' => $survei->survei_id,
                    'partisipasi_id' => $partisipasiId,
                    'pertanyaan_id' => $id,
                    'kategori_id' => $kategoriId,
                    'skor' => $data['jawaban'][$id],
                    'isian' => null,
                ]);
            }
        });

        $request->session()->put('survei.responden.selesai', true);
>>>>>>> main

        return redirect()->route('survei.selesai');
    }

    public function selesai()
    {
        return view('survei.responden.selesai');
    }

    private function kategori(Request $request)
    {
        $role = $request->session()->get('survei.role');

        return $role === 'tamu'
            ? $request->session()->get('survei.kategori')
            : $role;
    }
}
