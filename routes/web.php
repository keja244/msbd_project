<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN UTAMA & PROFIL ---
Route::get('/', function () {
    return view('index');
});

Route::prefix('profil')->group(function () {
    Route::get('/tentang', function () {
        return view('profil-sekolah.tentang');
    });
    Route::get('/kepala-sekolah', function () {
        return view('profil-sekolah.kepala-sekolah');
    });
    Route::get('/sarpras', function () {
        return view('profil-sekolah.sarpras');
    });
    Route::get('/osis', function () {
        return view('profil-sekolah.osis');
    });
    Route::get('/galeri-foto', function () {
        return view('profil-sekolah.galeri-foto');
    });
    Route::get('/galeri-video', function () {
        return view('profil-sekolah.galeri-video');
    });
});

// --- AKADEMIK & INFORMASI ---
Route::prefix('akademik')->group(function () {
    Route::get('/silabus', function () {
        return view('akademik.rpm');
    });
    Route::get('/kalender', function () {
        return view('akademik.kalender');
    });
    Route::get('/prestasi', function () {
        return view('akademik.prestasi');
    });
    Route::get('/artikel', function () {
        return view('akademik.artikel');
    });
    Route::get('/berita', function () {
        return view('akademik.berita');
    });
});

// Alias rute berita langsung
Route::get('/berita', function () {
    return view('akademik.berita');
});

// --- DIREKTORI GURU & STAFF ---
Route::prefix('direktori')->group(function () {
    Route::get('/siswa', function () {
        return view('direktori.siswa');
    });
    Route::get('/guru', function () {
        return view('direktori.guru');
    });
    Route::get('/alumni', function () {
        return view('direktori.alumni');
    });
});

// --- EKSTRAKURIKULER & OSIS ---
Route::get('/ekstrakurikuler', function () {
    return view('osis-ekskul.index');
});

Route::get('/ekskul/{nama}', function ($nama) {
    return view('osis-ekskul.detail', ['nama' => $nama]);
});

// --- SPMB & KELULUSAN ---
Route::get('/spmb', function () {
    return view('spmb.penerimaan');
});
Route::get('/kelulusan', function () {
    return view('spmb.kelulusan');
});

// --- KONTAK ---
Route::get('/kontak', function () {
    return view('kontak');
});

// --- DASHBOARD & PROFILE BAWAAN BREEZE ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';