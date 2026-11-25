<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\ArtikelController;
use App\Http\Middleware\SurveiRole;
use App\Http\Controllers\Survei\{
    AkunController,
    AuthController,
    DashboardController,
    HasilController,
    IsiController,
    PartisipasiController,
    PertanyaanController,
    PeriodeController,
    AspekController,
    WelcomeController
};
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
     // Galeri foto & video (satu halaman, tab awal ditentukan dari alamat)
    Route::get('/galeri', [GaleriController::class, 'index'])->defaults('tab', 'semua')->name('galeri');
    Route::get('/galeri-foto', [GaleriController::class, 'index'])->defaults('tab', 'foto')->name('galeri.foto');
    Route::get('/galeri-video', [GaleriController::class, 'index'])->defaults('tab', 'video')->name('galeri.video');
    Route::get('/galeri-foto/semua', [GaleriController::class, 'semuaFoto'])->name('galeri.foto.semua');
    Route::get('/galeri-video/semua', [GaleriController::class, 'semuaVideo'])->name('galeri.video.semua');
});
 

// --- AKADEMIK & INFORMASI ---
Route::prefix('akademik')->group(function () {
    Route::get('/silabus', function () {
        return view('akademik.rpm');
    });
       // Kalender
   Route::get('/kalender', function () {
    $events = [];

    return view('akademik.kalender', compact('events'));
})->name('kalender');

    Route::get('/kalender-tahunan', function () {
        return view('akademik.kalender-tahunan');
    })->name('kalender.tahunan');

    Route::get('/prestasi', function () {
        return view('akademik.prestasi');
    });
    Route::get('/prestasi', function () {
        return view('akademik.prestasi');
    });
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
    Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])
        ->where('slug', '[a-z0-9\-]+')
        ->name('artikel.show');
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
    Route::get('/alumni', [AlumniController::class, 'index'])
    ->name('alumni');
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


// --- SURVEI KEPUASAN ---
Route::prefix('survei')->name('survei.')->group(function () {

    // Halaman publik
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

    // Login, tamu, dan logout
    Route::post('/masuk', [AuthController::class, 'login'])->name('masuk.proses');
    Route::post('/tamu', [AuthController::class, 'tamu'])->name('tamu.proses');
    Route::post('/keluar', [AuthController::class, 'logout'])->name('keluar');

    // Halaman responden
    Route::middleware(SurveiRole::class.':siswa,guru,tendik,tamu')->group(function () {
        Route::get('/isi', [IsiController::class, 'index'])->name('isi');
        Route::post('/isi', [IsiController::class, 'store'])->name('isi.simpan');
        Route::get('/terima-kasih', [IsiController::class, 'selesai'])->name('selesai');
    });

    // Dashboard pengelola
    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        // Semua pengelola
        Route::middleware(SurveiRole::class.':admin,kepsek,humas,kurikulum,sarpras,kesiswaan')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');
            Route::get('/hasil/{aspek}', [HasilController::class, 'show'])->name('hasil.aspek');
        });

        // Partisipasi
        Route::middleware(SurveiRole::class.':admin,kepsek,humas')->group(function () {
            Route::get('/partisipasi', [PartisipasiController::class, 'index'])->name('partisipasi');
        });

        // Periode dan Aspek, khusus Super Admin
        Route::middleware(SurveiRole::class.':admin')->group(function () {
            Route::resource('periode', PeriodeController::class)->except(['show']);
            Route::resource('aspek', AspekController::class)->except(['show']);
            Route::resource('akun', AkunController::class)->except(['show']);
        });

        // Pertanyaan untuk pengelola masing-masing divisi
        Route::middleware(SurveiRole::class.':admin,humas,kurikulum,sarpras,kesiswaan')->group(function () {
            Route::resource('pertanyaan', PertanyaanController::class)->except(['show']);
        });

    });
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