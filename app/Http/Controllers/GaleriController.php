<?php

namespace App\Http\Controllers;

class GaleriController extends Controller
{
    // Jumlah item yang tampil di halaman galeri sebelum tombol "Lihat Lainnya"
    private const PREVIEW_FOTO  = 6;
    private const PREVIEW_VIDEO = 3;

    // GET /profil/galeri, /profil/galeri-foto, /profil/galeri-video  ($tab: semua | foto | video)
    public function index(string $tab = 'semua')
    {
        $foto  = $this->foto();
        $video = $this->video();

        return view('profil-sekolah.fotovidio', [
            'tab'        => in_array($tab, ['semua', 'foto', 'video'], true) ? $tab : 'semua',
            'fotos'      => array_slice($foto, 0, self::PREVIEW_FOTO),
            'videos'     => array_slice($video, 0, self::PREVIEW_VIDEO),
            'totalFoto'  => count($foto),
            'totalVideo' => count($video),
        ]);
    }

    // GET /profil/galeri-foto/semua
    public function semuaFoto()
    {
        return view('profil-sekolah.foto-semua', ['fotos' => $this->foto()]);
    }

    // GET /profil/galeri-video/semua
    public function semuaVideo()
    {
        return view('profil-sekolah.video-semua', ['videos' => $this->video()]);
    }

    private function foto(): array
    {
        // TODO database. Field: judul, kategori, src (path untuk asset(), mis. 'storage/galeri/a.jpg')
        return [];
    }

    private function video(): array
    {
        // TODO database. Field: judul, deskripsi, src (path .mp4), poster (path gambar sampul)
        return [];
    }
}