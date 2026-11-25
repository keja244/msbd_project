@extends('survei.dashboard.layout')

@section('title', 'Dashboard Sarpras - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
    <div class="text-smanda-green text-xs font-bold uppercase tracking-wider mb-2">
        Sistem Survei & Manajemen Fasilitas
    </div>

    <h1 class="text-3xl font-extrabold mb-2 text-gray-800 dark:text-gray-100">
        Dashboard Sarana & Prasarana
    </h1>

    <p class="text-sm text-gray-500 dark:text-gray-400">
        Kelola informasi sarpras, upload foto fasilitas, buat instrumen pertanyaan survei, dan pantau hasil evaluasi khusus aspek sarana prasarana.
    </p>
</section>

<!-- 4 KARTU STATISTIK SARPRAS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Fasilitas Sarpras</p>
            <p class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $jumlahFasilitas }}</p>
            <p class="text-xs text-gray-400 mt-2">Tersambung ke profil sekolah</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('survei.dashboard.sarpras.index') }}" class="text-xs font-bold text-smanda-green hover:underline flex items-center gap-1">
                <span>Kelola Fasilitas</span> &rarr;
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Pertanyaan Survei</p>
            <p class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $jumlahPertanyaan }}</p>
            <p class="text-xs text-gray-400 mt-2">Khusus aspek sarana prasarana</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('survei.dashboard.sarpras.pertanyaan') }}" class="text-xs font-bold text-smanda-blue hover:underline flex items-center gap-1">
                <span>Kelola Pertanyaan</span> &rarr;
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Rata-rata Skor Sarpras</p>
            <div class="flex items-baseline gap-2">
                <p class="text-3xl font-extrabold {{ $rataSkor >= 4.0 ? 'text-emerald-600 dark:text-emerald-400' : ($rataSkor >= 3.0 ? 'text-amber-500' : 'text-gray-800 dark:text-gray-100') }}">
                    {{ $rataSkor > 0 ? number_format($rataSkor, 2) : '—' }}
                </p>
                <span class="text-xs text-gray-400">/ 5.00</span>
            </div>
            <p class="text-xs text-gray-400 mt-2">Berdasarkan penilaian responden</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('survei.dashboard.hasil') }}" class="text-xs font-bold text-smanda-yellow hover:underline flex items-center gap-1">
                <span>Lihat Hasil Survei</span> &rarr;
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Total Respon Sarpras</p>
            <p class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $jumlahJawaban }}</p>
            <p class="text-xs text-gray-400 mt-2">Jawaban butir sarpras masuk</p>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
            <span class="text-xs text-gray-400">
                {{ $periode ? 'Periode: ' . $periode->tahun_ajaran : 'Tidak ada periode' }}
            </span>
        </div>
    </div>

</div>

<!-- TOMBOL AKSI CEPAT -->
<div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 mb-8 flex flex-wrap items-center justify-between gap-4">
    <div>
        <h3 class="font-extrabold text-gray-800 dark:text-gray-100 text-lg">Aksi Cepat Pengelola Sarpras</h3>
        <p class="text-xs text-gray-400 mt-0.5">Pilih tindakan yang ingin Anda lakukan terkait sarana prasarana sekolah.</p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        <a href="{{ route('survei.dashboard.sarpras.create') }}"
           class="inline-flex items-center gap-2 bg-smanda-green hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Upload Foto & Tambah Fasilitas</span>
        </a>

        <a href="{{ route('survei.dashboard.sarpras.pertanyaan.create') }}"
           class="inline-flex items-center gap-2 bg-smanda-blue hover:bg-blue-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Buat Pertanyaan Survei Sarpras</span>
        </a>

        <a href="{{ route('survei.dashboard.hasil') }}"
           class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-bold px-4 py-2.5 rounded-xl transition-all">
            <span>Lihat Hasil Khusus Sarpras</span>
        </a>
    </div>
</div>

<!-- 2 KOLOM KONTEN TERBARU -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Kolom 1: Fasilitas Sarpras Terbaru -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 dark:text-gray-100 text-base">Fasilitas Sarpras Terbaru</h3>
            <a href="{{ route('survei.dashboard.sarpras.index') }}" class="text-xs text-smanda-green font-bold hover:underline">
                Lihat Semua ({$jumlahFasilitas}) →
            </a>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700/60">
            @forelse($fasilitasTerbaru as $f)
                @php
                    $fotoUrl = $f->foto ? asset($f->foto) : asset('images/slide1.jpeg');
                @endphp
                <div class="p-4 flex items-center gap-4 hover:bg-gray-50/50 dark:hover:bg-gray-750 transition-colors">
                    <img src="{{ $fotoUrl }}" alt="{{ $f->nama_fasilitas }}"
                         class="w-14 h-11 rounded-lg object-cover border border-gray-200 dark:border-gray-700 shadow-sm flex-shrink-0"
                         onerror="this.src='{{ asset('images/slide1.jpeg') }}'">
                    <div class="flex-grow min-w-0">
                        <h4 class="font-bold text-gray-800 dark:text-gray-100 text-sm truncate">{{ $f->nama_fasilitas }}</h4>
                        <div class="flex items-center gap-2 text-xs text-gray-400 mt-0.5">
                            <span class="text-smanda-blue font-semibold">{{ $f->kategori }}</span>
                            <span>&bull;</span>
                            <span>{{ $f->jumlah }} Unit</span>
                            <span>&bull;</span>
                            <span class="{{ $f->kondisi === 'Baik' ? 'text-emerald-600' : 'text-amber-500' }}">{{ $f->kondisi }}</span>
                        </div>
                    </div>
                    <a href="{{ route('survei.dashboard.sarpras.edit', $f->sarpras_id) }}"
                       class="text-xs font-bold text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        Edit
                    </a>
                </div>
            @empty
                <div class="p-8 text-center text-xs text-gray-400">
                    Belum ada fasilitas sarpras.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Kolom 2: Pertanyaan Survei Sarpras Terbaru -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 dark:text-gray-100 text-base">Instrumen Pertanyaan Sarpras</h3>
            <a href="{{ route('survei.dashboard.sarpras.pertanyaan') }}" class="text-xs text-smanda-blue font-bold hover:underline">
                Lihat Semua ({$jumlahPertanyaan}) →
            </a>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700/60">
            @forelse($pertanyaanList as $p)
                <div class="p-4 flex items-start gap-3 hover:bg-gray-50/50 dark:hover:bg-gray-750 transition-colors">
                    <span class="w-6 h-6 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                        {{ $p->urutan }}
                    </span>
                    <div class="flex-grow min-w-0">
                        <p class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-100 leading-snug">
                            {{ $p->teks_pertanyaan }}
                        </p>
                        <div class="flex items-center gap-2 text-[11px] text-gray-400 mt-1">
                            <span class="font-semibold text-smanda-green">{{ $p->jenis }}</span>
                            @if($p->inti)
                                <span>&bull;</span>
                                <span class="text-purple-600 font-semibold">Indikator Inti</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-xs text-gray-400">
                    Belum ada pertanyaan sarpras.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
