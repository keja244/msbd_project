<?php
namespace App\Http\Controllers;

class AlumniController extends Controller
{
    public function index()
    {
        $sekarang = (int) date('Y');
        $tahuns = [$sekarang, $sekarang - 1, $sekarang - 2];

        $perTahun = [];

        foreach ($tahuns as $th) {
            $perTahun[$th] = [];
        }

        return view('direktori.alumni', compact('perTahun'));
    }
}
