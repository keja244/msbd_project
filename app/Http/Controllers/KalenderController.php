<?php

namespace App\Http\Controllers;

class KalenderController extends Controller
{
    // GET /akademik/kalender  -> resources/views/akademik/kalender.blade.php
    public function bulanan()
    {
        return view('akademik.kalender', ['events' => $this->events()]);
    }

    // GET /akademik/kalender-tahunan  -> resources/views/akademik/kalender-tahunan.blade.php
    public function tahunan()
    {
        return view('akademik.kalender-tahunan', ['events' => $this->events()]);
    }

    private function events(): array
    {
        // TODO database: ambil semua agenda, mis. Agenda::orderBy('tanggal')->get()->toArray()
        // Field: tanggal (YYYY-MM-DD), sampai (opsional, YYYY-MM-DD), judul,
        //        kategori (akademik | ujian | libur | kegiatan)
        return [];
    }
}