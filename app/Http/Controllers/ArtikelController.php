<?php

namespace App\Http\Controllers;

class ArtikelController extends Controller
{
    // GET /akademik/artikel
    public function index()
    {
        // TODO database: ambil artikel terbaru dulu, mis. Artikel::latest('tanggal')->get()->toArray()
        // Field: slug, judul, kategori, penulis, tanggal (YYYY-MM-DD), gambar (path untuk asset()), ringkasan, isi
        $artikels = [];

        return view('informasi.artikel', compact('artikels'));
    }

    // GET /akademik/artikel/{slug}
    public function show(string $slug)
    {
        // TODO database: $artikel = Artikel::where('slug', $slug)->firstOrFail()->toArray();
        $artikel = null;
        abort_if($artikel === null, 404);

        // TODO database: artikel terkait (kategori sama, selain artikel ini), maksimal 3
        $terkait = [];

        return view('akademik.artikel-detail', compact('artikel', 'terkait'));
    }
}