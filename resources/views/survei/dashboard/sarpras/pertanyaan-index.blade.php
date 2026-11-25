@extends('survei.dashboard.layout')

@section('title', 'Pertanyaan Survei Sarpras - SMAN 2 Medan')

@section('isi')
<section class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <div class="text-smanda-blue text-xs font-bold uppercase tracking-[0.15em] mb-1">
            Aspek Sarana dan Prasarana
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2d3748] dark:text-gray-100">
            Pertanyaan Survei Sarpras
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Kelola instrumen pertanyaan survei khusus aspek sarana dan prasarana yang akan dinilai oleh responden.
        </p>
    </div>

    <a href="{{ route('survei.dashboard.sarpras.pertanyaan.create') }}"
       class="inline-flex items-center gap-2 bg-smanda-green hover:bg-emerald-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Buat Pertanyaan Baru</span>
    </a>
</section>

<!-- INFO PERIODE SURVEI -->
<div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <span class="text-xs font-bold uppercase tracking-wider text-smanda-blue block mb-1">Periode Survei Aktif</span>
        <h3 class="text-base font-bold text-gray-800 dark:text-gray-100">
            {{ $periode ? $periode->judul_survei : 'Belum ada survei aktif' }}
        </h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
            {{ $periode ? 'Tahun Ajaran ' . $periode->tahun_ajaran . ' · Semester ' . $periode->semester : 'Aktifkan survei terlebih dahulu' }}
        </p>
    </div>
    <div class="flex items-center gap-2">
        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $periode ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400' : 'bg-gray-100 text-gray-500' }}">
            {{ $periode ? 'Status: ' . $periode->status : 'Tidak Aktif' }}
        </span>
    </div>
</div>

<!-- TABEL DAFTAR PERTANYAAN -->
<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <h2 class="font-bold text-gray-800 dark:text-gray-100 text-base">
            Daftar Pertanyaan Aspek Sarana & Prasarana
        </h2>
        <span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
            Total: {{ $pertanyaan->count() }} Pertanyaan
        </span>
    </div>

    @if($pertanyaan->isEmpty())
        <div class="p-12 text-center text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="font-semibold text-gray-600 dark:text-gray-300">Belum ada pertanyaan survei untuk aspek sarpras.</p>
            <p class="text-xs mt-1">Klik tombol "Buat Pertanyaan Baru" untuk menambahkan butir survei ke database.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-900/40 text-xs uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="px-5 py-3.5 font-bold w-16 text-center">No</th>
                        <th class="px-5 py-3.5 font-bold">Teks Pertanyaan</th>
                        <th class="px-5 py-3.5 font-bold">Tipe Jawaban</th>
                        <th class="px-5 py-3.5 font-bold text-center">Status</th>
                        <th class="px-5 py-3.5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                    @foreach($pertanyaan as $item)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-750 transition-colors">
                            <td class="px-5 py-4 text-center font-bold text-gray-500">
                                {{ $item->urutan }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-gray-800 dark:text-gray-100 leading-relaxed">
                                    {{ $item->teks_pertanyaan }}
                                </div>
                                @if($item->inti)
                                    <span class="inline-block mt-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300">
                                        Pertanyaan Inti
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-bold {{ $item->jenis === 'Skala' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                                    {{ $item->jenis === 'Skala' ? 'Skala 1 - 5' : $item->jenis }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                @if($item->aktif)
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-500">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('survei.dashboard.sarpras.pertanyaan.edit', $item->pertanyaan_id) }}"
                                       class="px-2.5 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('survei.dashboard.sarpras.pertanyaan.destroy', $item->pertanyaan_id) }}"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-2.5 py-1 text-xs font-bold rounded-lg border border-red-200 dark:border-red-800 hover:bg-red-50 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
