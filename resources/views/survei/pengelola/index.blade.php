
@extends('survei.layout.utama')

@section('title', 'Dashboard Survei - SMAN 2 Medan')

@section('isi')

<section class="mb-8">
    <div class="text-smanda-blue dark:text-blue-400 text-xs font-bold uppercase tracking-[0.15em] mb-2">
        Dashboard Survei
    </div>

    <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">
        Ringkasan <span class="text-smanda-yellow">Survei</span>
    </h1>

    <p class="text-sm text-gray-500 dark:text-gray-400">
        Selamat datang di dashboard pengelolaan survei.
    </p>
</section>

{{-- INFORMASI PERIODE --}}
<section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 shadow-sm mb-8">

    <h2 class="text-lg font-extrabold mb-4">Periode Survei Aktif</h2>

    @if($periode)
        <div class="text-xl font-bold mb-2">
            {{ $periode->judul_survei }}
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Tahun Ajaran {{ $periode->tahun_ajaran }}
            · Semester {{ $periode->semester }}
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M Y') }}
            sampai
            {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }}
        </p>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Belum ada periode survei aktif.
        </p>
    @endif

</section>

{{-- RINGKASAN DATA --}}
<section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 shadow-sm">
        <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
            Pertanyaan Aktif
        </div>

        <div class="text-4xl font-extrabold">
            {{ number_format($jumlahPertanyaan) }}
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 shadow-sm">
        <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
            Total Partisipasi
        </div>

        <div class="text-4xl font-extrabold">
            {{ number_format($jumlahPartisipasi) }}
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 shadow-sm">
        <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
            Total Jawaban
        </div>

        <div class="text-4xl font-extrabold">
            {{ number_format($jumlahJawaban) }}
        </div>
    </div>

</section>

{{-- INFORMASI BERDASARKAN ROLE --}}
<section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 shadow-sm">

    <h2 class="text-lg font-extrabold mb-2">
        Informasi Pengelola
    </h2>

    @if($role === 'admin')
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Anda memiliki akses untuk mengelola periode survei, aspek, akun, dan seluruh konfigurasi survei.
        </p>

    @elseif($role === 'humas')
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Anda bertanggung jawab mengelola pertanyaan survei untuk divisi Humas.
        </p>

    @elseif($role === 'kurikulum')
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Anda bertanggung jawab mengelola pertanyaan survei untuk divisi Kurikulum.
        </p>

    @elseif($role === 'sarpras')
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Anda bertanggung jawab mengelola pertanyaan survei untuk divisi Sarpras.
        </p>

    @elseif($role === 'kesiswaan')
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Anda bertanggung jawab mengelola pertanyaan survei untuk divisi Kesiswaan.
        </p>

    @elseif($role === 'kepsek')
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Anda dapat memantau ringkasan hasil survei dan partisipasi responden.
        </p>
    @endif

</section>

@endsection
