<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SurveiRole;
use App\Http\Controllers\Survei\{AuthController, DashboardController,
    HasilController, IsiController, PartisipasiController,
    SarprasController, WelcomeController};
use Illuminate\Support\Facades\DB;
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
        $fasilitas = DB::table('sarana_prasarana')
            ->whereNull('deleted_at')
            ->orderBy('sarpras_id')
            ->get();
        return view('profil-sekolah.sarpras', compact('fasilitas'));
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

// --- SURVEI KEPUASAN ---
// Role session: admin, kepsek, humas, kurikulum, sarpras, kesiswaan, siswa, guru, tendik, tamu
Route::prefix('survei')->name('survei.')->group(function () {

    // Publik
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    
    Route::middleware(SurveiRole::class.':guru_tendik')->group(function () {
    });

    // Masuk / tamu / keluar (formnya ada di halaman welcome)
    Route::post('/masuk', [AuthController::class, 'login'])->name('masuk.proses');
    Route::post('/tamu', [AuthController::class, 'tamu'])->name('tamu.proses');
    Route::post('/keluar', [AuthController::class, 'logout'])->name('keluar');

    // Responden: siswa, guru, tendik, tamu
    Route::middleware(SurveiRole::class.':siswa,guru,tendik,tamu')->group(function () {
        Route::get('/isi', [IsiController::class, 'index'])->name('isi');
        Route::post('/isi', [IsiController::class, 'store'])->name('isi.simpan');
        Route::get('/terima-kasih', [IsiController::class, 'selesai'])->name('selesai');
    });

    // Pengelola
    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        // semua pengelola (hasil dibatasi per aspek sesuai role nanti)
        Route::middleware(SurveiRole::class.':admin,kepsek,humas,kurikulum,sarpras,kesiswaan')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');
            Route::get('/hasil/{aspek}', [HasilController::class, 'show'])->name('hasil.aspek');
        });

        // fasilitas & pertanyaan survei aspek sarpras: sarpras, admin
        Route::middleware(SurveiRole::class.':sarpras,admin')->prefix('sarpras')->name('sarpras.')->group(function () {
            Route::get('/fasilitas', [SarprasController::class, 'index'])->name('index');
            Route::get('/fasilitas/tambah', [SarprasController::class, 'create'])->name('create');
            Route::post('/fasilitas', [SarprasController::class, 'store'])->name('store');
            Route::get('/fasilitas/{id}/edit', [SarprasController::class, 'edit'])->name('edit');
            Route::put('/fasilitas/{id}', [SarprasController::class, 'update'])->name('update');
            Route::delete('/fasilitas/{id}', [SarprasController::class, 'destroy'])->name('destroy');

            Route::get('/pertanyaan', [SarprasController::class, 'pertanyaanIndex'])->name('pertanyaan');
            Route::get('/pertanyaan/tambah', [SarprasController::class, 'pertanyaanCreate'])->name('pertanyaan.create');
            Route::post('/pertanyaan', [SarprasController::class, 'pertanyaanStore'])->name('pertanyaan.store');
            Route::get('/pertanyaan/{id}/edit', [SarprasController::class, 'pertanyaanEdit'])->name('pertanyaan.edit');
            Route::put('/pertanyaan/{id}', [SarprasController::class, 'pertanyaanUpdate'])->name('pertanyaan.update');
            Route::delete('/pertanyaan/{id}', [SarprasController::class, 'pertanyaanDestroy'])->name('pertanyaan.destroy');
        });

        // partisipasi dan rata-rata skor: admin, kepsek, humas
        Route::middleware(SurveiRole::class.':admin,kepsek,humas')->group(function () {
            Route::get('/partisipasi', [PartisipasiController::class, 'index'])->name('partisipasi');
        });

        // pelaksanaan survei: admin, humas (belum diimplementasi)
        // Route::middleware(SurveiRole::class.':admin,humas')->group(function () {
        //     Route::resource('periode', PeriodeController::class)->except(['show']);
        //     Route::resource('pertanyaan', PertanyaanController::class)->except(['show']);
        // });

        // pengelolaan data: admin saja (belum diimplementasi)
        // Route::middleware(SurveiRole::class.':admin')->group(function () {
        //     Route::resource('aspek', AspekController::class)->except(['show']);
        //     Route::resource('direktori', DirektoriController::class)->except(['show']);
        //     Route::resource('akun', AkunController::class)->only(['index', 'update', 'destroy']);
        // });
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