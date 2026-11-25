@extends('survei.dashboard.layout')

@section('title', 'Kelola Sarana & Prasarana - SMAN 2 Medan')

@section('isi')
<section class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <div class="text-smanda-green text-xs font-bold uppercase tracking-[0.15em] mb-1">
            Manajemen Sarana Prasarana
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2d3748] dark:text-gray-100">
            Fasilitas Sekolah
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Upload foto dan kelola penjelasan sarana & prasarana yang tersambung langsung ke database dan tampil di profil sekolah.
        </p>
    </div>

    <a href="{{ route('survei.dashboard.sarpras.create') }}"
       class="inline-flex items-center gap-2 bg-smanda-green hover:bg-emerald-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Tambah Fasilitas Baru</span>
    </a>
</section>

<!-- KARTU STATISTIK SARPRAS -->
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
        <span class="text-xs text-gray-400 font-medium block mb-1">Total Fasilitas</span>
        <span class="text-2xl font-extrabold text-gray-800 dark:text-gray-100">{{ $totalFasilitas }}</span>
        <span class="text-[11px] text-gray-400 block mt-1">Terdata di database</span>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
        <span class="text-xs text-emerald-600 dark:text-emerald-400 font-medium block mb-1">Kondisi Baik</span>
        <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ $totalBaik }}</span>
        <span class="text-[11px] text-gray-400 block mt-1">Siap pakai</span>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
        <span class="text-xs text-amber-500 font-medium block mb-1">Rusak Ringan</span>
        <span class="text-2xl font-extrabold text-amber-500">{{ $totalRusakRingan }}</span>
        <span class="text-[11px] text-gray-400 block mt-1">Perlu pemeliharaan</span>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
        <span class="text-xs text-red-500 font-medium block mb-1">Rusak Berat</span>
        <span class="text-2xl font-extrabold text-red-500">{{ $totalRusakBerat }}</span>
        <span class="text-[11px] text-gray-400 block mt-1">Perlu perbaikan total</span>
    </div>
</div>

<!-- TABEL DAFTAR FASILITAS -->
<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <h2 class="font-bold text-gray-800 dark:text-gray-100 text-base">
            Daftar Sarana dan Prasarana Aktif
        </h2>
        <a href="{{ url('/profil/sarpras') }}" target="_blank" class="text-xs text-smanda-blue hover:underline flex items-center gap-1 font-semibold">
            <span>Lihat Tampilan Publik</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
        </a>
    </div>

    @if($fasilitas->isEmpty())
        <div class="p-12 text-center text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <p class="font-semibold text-gray-600 dark:text-gray-300">Belum ada data fasilitas sarpras.</p>
            <p class="text-xs mt-1">Klik tombol "Tambah Fasilitas Baru" untuk mengupload foto dan penjelasan fasilitas.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-900/40 text-xs uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="px-5 py-3.5 font-bold w-20">Foto</th>
                        <th class="px-5 py-3.5 font-bold">Fasilitas & Kategori</th>
                        <th class="px-5 py-3.5 font-bold">Kondisi</th>
                        <th class="px-5 py-3.5 font-bold">Jumlah</th>
                        <th class="px-5 py-3.5 font-bold max-w-xs">Penjelasan Singkat</th>
                        <th class="px-5 py-3.5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                    @foreach($fasilitas as $item)
                        @php
                            $kondisiClass = match($item->kondisi) {
                                'Baik' => 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
                                'Rusak Ringan' => 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                                default => 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border-red-200 dark:border-red-800',
                            };
                            $fotoUrl = $item->foto ? asset($item->foto) : asset('images/slide1.jpeg');
                        @endphp
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-750 transition-colors">
                            <td class="px-5 py-3.5">
                                <img src="{{ $fotoUrl }}" alt="{{ $item->nama_fasilitas }}"
                                     class="w-16 h-12 rounded-lg object-cover border border-gray-200 dark:border-gray-700 shadow-sm"
                                     onerror="this.src='{{ asset('images/slide1.jpeg') }}'">
                            </td>
                            <td class="px-5 py-3.5 font-semibold text-gray-800 dark:text-gray-100">
                                <div>{{ $item->nama_fasilitas }}</div>
                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-smanda-blue mt-0.5">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $kondisiClass }}">
                                    {{ $item->kondisi }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 font-bold text-gray-700 dark:text-gray-300">
                                {{ $item->jumlah }} Unit
                            </td>
                            <td class="px-5 py-3.5 text-xs text-gray-500 dark:text-gray-400 max-w-xs truncate" title="{{ $item->deskripsi }}">
                                {{ Str::limit($item->deskripsi ?? $item->keterangan, 70) }}
                            </td>
                            <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('survei.dashboard.sarpras.edit', $item->sarpras_id) }}"
                                       class="px-2.5 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('survei.dashboard.sarpras.destroy', $item->sarpras_id) }}"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas {{ $item->nama_fasilitas }}?');" class="inline">
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
