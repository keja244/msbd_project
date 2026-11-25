
@extends('survei.layout.utama')

@section('title', 'Partisipasi Survei - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
    <div class="text-smanda-green text-xs font-bold uppercase tracking-[0.15em] mb-2">
        Partisipasi
    </div>

    <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">
        Siapa yang <span class="text-smanda-yellow">Sudah Mengisi</span>
    </h1>

    <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $semester ?? 'Belum ada survei aktif' }} · hanya jumlah, tanpa nama dan tanpa jawaban
    </p>
</section>

@if(!$periode)

    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-8 shadow-sm text-center">
        <div class="text-gray-400 mb-3">
            <i class="fas fa-clipboard-list text-3xl"></i>
        </div>
        <h2 class="font-bold text-gray-700 dark:text-gray-200 mb-1">
            Belum Ada Survei Aktif
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Data partisipasi akan ditampilkan setelah periode survei diaktifkan.
        </p>
    </div>

@else

    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm mb-6">
        <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
            Total partisipasi
        </div>

        <div class="text-4xl font-extrabold text-gray-800 dark:text-white">
            {{ number_format($total['terisi']) }}
            <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">
                responden
            </span>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">

        <h2 class="font-bold text-gray-800 dark:text-white mb-6">
            Partisipasi Berdasarkan Kategori
        </h2>

        @forelse($partisipasi as $p)

            <div class="mb-6 last:mb-0">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                    <div class="font-bold text-gray-800 dark:text-gray-200">
                        {{ $p->nama }}

                        <span class="ml-1.5 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full {{ $p->wajib ? 'bg-emerald-100 dark:bg-emerald-900/40 text-smanda-green' : 'bg-yellow-100 dark:bg-yellow-900/40 text-smanda-yellow' }}">
                            {{ $p->wajib ? 'Wajib' : 'Opsional' }}
                        </span>
                    </div>

                    <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">
                        {{ number_format($p->terisi) }} responden
                    </div>
                </div>
            </div>

        @empty

            <div class="text-center py-8">
                <p class="font-semibold text-gray-600 dark:text-gray-300 mb-1">
                    Belum Ada Kategori Responden
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Kategori partisipasi belum tersedia untuk ditampilkan.
                </p>
            </div>

        @endforelse

    </div>

@endif
@endsection
