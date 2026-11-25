<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use App\Support\DataSurvei;
use Illuminate\Http\Request;

class IsiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('survei.selesai')) {
            return redirect()->route('survei.selesai');
        }

        $kategori = $this->kategori($request);

        $namaKategori = match ((string) $kategori) {
            '1', 'siswa' => 'Siswa',
            '2', 'guru', 'tendik' => 'Guru / Tendik',
            '3', 'masyarakat', 'orang_tua', 'tamu' => 'Masyarakat / Orang Tua',
            default => 'Responden',
        };

        return view('survei.isi', [
            'role' => $request->session()->get('survei.role'),
            'namaKategori' => $namaKategori,
            'aspek' => DataSurvei::pertanyaan((string) $kategori),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->session()->get('survei.selesai')) {
            return redirect()->route('survei.selesai');
        }

        $kategori = $this->kategori($request);

        $rules = ['isian' => 'nullable|string|max:1000'];

        foreach (DataSurvei::semuaId((string) $kategori) as $id) {
            $rules["jawaban.$id"] = 'required|integer|between:1,5';
        }

        $data = $request->validate($rules);

        $request->session()->put('survei.jawaban', $data);
        $request->session()->put('survei.selesai', true);

        return redirect()->route('survei.selesai');
    }

    public function selesai()
    {
        return view('survei.selesai');
    }

    private function kategori(Request $request)
    {
        $role = $request->session()->get('survei.role');

        return $role === 'tamu'
            ? $request->session()->get('survei.kategori')
            : $role;
    }
}
