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

        return view('survei.isi', [
            'role' => $request->session()->get('survei.role'),
            'namaKategori' => DataSurvei::NAMA[$kategori],
            'aspek' => DataSurvei::pertanyaan($kategori),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->session()->get('survei.selesai')) {
            return redirect()->route('survei.selesai');
        }

        $rules = ['isian' => 'nullable|string|max:1000'];
        foreach (DataSurvei::semuaId($this->kategori($request)) as $id) {
            $rules["jawaban.$id"] = 'required|integer|between:1,5';
        }
        $data = $request->validate($rules);

        // DEMO: disimpan di session. Nanti: INSERT ke jawaban + partisipasi (UNIQUE cegah isi ganda).
        $request->session()->put('survei.jawaban', $data);
        $request->session()->put('survei.selesai', true);

        return redirect()->route('survei.selesai');
    }

    public function selesai()
    {
        return view('survei.selesai');
    }

    private function kategori(Request $request): string
    {
        $role = $request->session()->get('survei.role');

        return $role === 'tamu' ? $request->session()->get('survei.kategori') : $role;
    }
}