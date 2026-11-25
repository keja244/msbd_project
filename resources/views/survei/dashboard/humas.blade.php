
@extends('survei.layout.utama')

@section('title', 'Dashboard Humas - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
    <div class="text-smanda-blue text-xs font-bold uppercase tracking-wider mb-2">
        Sistem Survei
    </div>

    <h1 class="text-3xl font-extrabold mb-2">
        Dashboard Humas
    </h1>

    <p class="text-sm text-gray-500">
        Ringkasan pengelolaan survei sekolah.
    </p>
</section>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-500 mb-2">Periode Survei Aktif</p>
        <p class="text-2xl font-bold">
            {{ $periode ? '1' : '0' }}
        </p>
        <p class="text-xs text-gray-400 mt-2">
            {{ $periode ? $periode->tahun_ajaran : 'Belum ada periode aktif' }}
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-500 mb-2">Pertanyaan Aktif</p>
        <p class="text-2xl font-bold">{{ $jumlahPertanyaan }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-500 mb-2">Total Partisipasi</p>
        <p class="text-2xl font-bold">{{ $jumlahPartisipasi }}</p>
    </div>

</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
    <h2 class="text-lg font-bold mb-4">Informasi Periode Survei</h2>

    @if($periode)
        <p class="mb-2">{{ $periode->judul_survei }}</p>
        <p class="text-sm text-gray-500">
            {{ $periode->tanggal_mulai }} sampai {{ $periode->tanggal_selesai }}
        </p>
        <p class="text-sm mt-2">
            Status: {{ $periode->status }}
        </p>
    @else
        <p class="text-sm text-gray-500">
            Belum ada periode survei yang aktif.
        </p>
    @endif
</div>
@endsection
