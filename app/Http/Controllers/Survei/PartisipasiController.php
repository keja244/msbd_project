<?php

namespace App\Http\Controllers\Survei;

use App\Http\Controllers\Controller;
use App\Support\DataHasil;

class PartisipasiController extends Controller
{
    public function index()
    {
        return view('survei.dashboard.partisipasi', [
            'semester' => DataHasil::SEMESTER,
            'partisipasi' => DataHasil::partisipasi(),
            'total' => DataHasil::partisipasiTotal(),
        ]);
    }
}