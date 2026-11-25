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

        return view('survei.responden.isi', [
            'role' => $request->session()->get('survei.role'),
            'namaKategori' => $namaKategori,
            'aspek' => DataSurvei::pertanyaan((string) $kategori),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->session()->get('survei.responden.selesai')) {
            return redirect()->route('survei.selesai');
        }

        $kategori = $this->kategori($request);

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
