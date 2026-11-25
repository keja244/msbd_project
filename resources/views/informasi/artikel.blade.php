@extends('layouts.app')

@section('title', 'Artikel - smanda')

@php
    // $artikels dikirim dari ArtikelController (dari database, terbaru dulu).
    // Field: slug, judul, kategori, penulis, tanggal (YYYY-MM-DD), gambar, ringkasan, isi
    $siapkan = function ($a) {
        $a = is_array($a) ? $a : $a->toArray();
        $isi = $a['isi'] ?? '';
        $teks = is_array($isi) ? implode(' ', $isi) : strip_tags((string) $isi);
        $a['tanggal_fmt'] ??= \Carbon\Carbon::parse($a['tanggal'])->locale('id')->translatedFormat('d F Y');
        $a['menit_baca']  ??= max(1, (int) ceil(str_word_count($teks) / 200));
        return $a;
    };
    $artikels = array_map($siapkan, $artikels);
    $kategoris = array_values(array_unique(array_column($artikels, 'kategori')));
    $utama = $artikels[0] ?? null;
    $lainnya = array_slice($artikels, 1);

    // Warna badge per kategori
    $warna = [
        'Akademik'     => 'bg-smanda-blue/10 text-smanda-blue',
        'Prestasi'     => 'bg-smanda-yellow/20 text-smanda-yellow-hover',
        'Kegiatan'     => 'bg-smanda-green-light text-smanda-green-dark',
        'Tips Belajar' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-300',
        'Karier'       => 'bg-smanda-red/10 text-smanda-red',
    ];
    $badgeDefault = 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300';
@endphp

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <!-- HEADER -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Pusat Informasi</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">Artikel</h1>
        <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] max-w-[800px]">
            Tulisan seputar pembelajaran, prestasi, kegiatan, dan karier dari keluarga besar smanda.
        </p>

        <div class="mt-[28px] flex flex-col lg:flex-row lg:items-center gap-[16px]">
            <input type="search" id="cari-artikel" placeholder="Cari judul atau ringkasan artikel..."
                   class="w-full lg:w-[360px] px-[16px] py-[10px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green">

            <div class="flex flex-wrap gap-[10px]">
                <button type="button" data-kategori="semua"
                        class="kat-btn px-[18px] py-[8px] rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors">Semua</button>
                @foreach ($kategoris as $kat)
                    <button type="button" data-kategori="{{ $kat }}"
                            class="kat-btn px-[18px] py-[8px] rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors">{{ $kat }}</button>
                @endforeach
            </div>
        </div>
    </section>

    <section class="max-w-[1280px] mx-auto px-[24px] py-[50px]">

        {{-- ARTIKEL UTAMA (terbaru) --}}
        @if ($utama)
            <a href="{{ url('/akademik/artikel/'.$utama['slug']) }}"
               data-kategori="{{ $utama['kategori'] }}"
               data-cari="{{ strtolower($utama['judul'].' '.$utama['ringkasan'].' '.$utama['kategori']) }}"
               class="artikel-item group grid grid-cols-1 lg:grid-cols-2 bg-white dark:bg-gray-800 rounded-[20px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg transition-shadow duration-300 mb-[32px]">
                <div class="relative aspect-[16/10] lg:aspect-auto overflow-hidden bg-gray-200 dark:bg-gray-700">
                    <img src="{{ asset($utama['gambar']) }}" alt="{{ $utama['judul'] }}"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="p-[28px] sm:p-[40px] flex flex-col justify-center">
                    <div class="flex items-center gap-[10px] mb-[14px]">
                        <span class="text-[0.7rem] font-bold uppercase tracking-wider px-[10px] py-[3px] rounded-full {{ $warna[$utama['kategori']] ?? $badgeDefault }}">{{ $utama['kategori'] }}</span>
                        <span class="text-xs font-semibold text-smanda-green uppercase tracking-wider">Terbaru</span>
                    </div>
                    <h2 class="text-[1.6rem] sm:text-[2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.3] mb-[14px] group-hover:text-smanda-green-dark dark:group-hover:text-smanda-green transition-colors">{{ $utama['judul'] }}</h2>
                    <p class="text-[0.98rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] mb-[20px]">{{ $utama['ringkasan'] }}</p>
                    <p class="text-xs text-gray-400">{{ $utama['penulis'] }} &middot; {{ $utama['tanggal_fmt'] }} &middot; {{ $utama['menit_baca'] }} menit baca</p>
                </div>
            </a>
        @endif

        {{-- ARTIKEL LAINNYA --}}
        @if (count($lainnya))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[28px]">
                @foreach ($lainnya as $a)
                    <a href="{{ url('/akademik/artikel/'.$a['slug']) }}"
                       data-kategori="{{ $a['kategori'] }}"
                       data-cari="{{ strtolower($a['judul'].' '.$a['ringkasan'].' '.$a['kategori']) }}"
                       class="artikel-item group flex flex-col bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="relative aspect-[16/10] overflow-hidden bg-gray-200 dark:bg-gray-700">
                            <img src="{{ asset($a['gambar']) }}" alt="{{ $a['judul'] }}" loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="p-[22px] flex flex-col flex-1">
                            <span class="self-start text-[0.7rem] font-bold uppercase tracking-wider px-[10px] py-[3px] rounded-full mb-[12px] {{ $warna[$a['kategori']] ?? $badgeDefault }}">{{ $a['kategori'] }}</span>
                            <h3 class="text-[1.15rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.4] mb-[10px] group-hover:text-smanda-green-dark dark:group-hover:text-smanda-green transition-colors">{{ $a['judul'] }}</h3>
                            <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] mb-[16px] line-clamp-3">{{ $a['ringkasan'] }}</p>
                            <p class="mt-auto text-xs text-gray-400">{{ $a['tanggal_fmt'] }} &middot; {{ $a['menit_baca'] }} menit baca</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if (!$utama)
            <p class="text-gray-500 dark:text-gray-400">Belum ada artikel.</p>
        @endif

        <p id="artikel-kosong" class="hidden text-gray-500 dark:text-gray-400 mt-[20px]">Tidak ada artikel yang cocok dengan pencarianmu.</p>
    </section>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = Array.from(document.querySelectorAll('.artikel-item'));
        const btns = Array.from(document.querySelectorAll('.kat-btn'));
        const input = document.getElementById('cari-artikel');
        const kosong = document.getElementById('artikel-kosong');
        const aktif = ['bg-smanda-green', 'text-white', 'border-smanda-green'];
        const nonAktif = ['bg-white', 'dark:bg-gray-800', 'text-gray-600', 'dark:text-gray-300'];
        let kategori = 'semua';

        function terapkan() {
            const q = input.value.trim().toLowerCase();
            let tampil = 0;

            items.forEach(el => {
                const cocok = (kategori === 'semua' || el.dataset.kategori === kategori)
                           && (q === '' || el.dataset.cari.includes(q));
                el.classList.toggle('hidden', !cocok);
                if (cocok) tampil++;
            });

            btns.forEach(b => {
                const on = b.dataset.kategori === kategori;
                aktif.forEach(c => b.classList.toggle(c, on));
                nonAktif.forEach(c => b.classList.toggle(c, !on));
            });

            kosong.classList.toggle('hidden', tampil !== 0);
        }

        btns.forEach(b => b.addEventListener('click', () => { kategori = b.dataset.kategori; terapkan(); }));
        input.addEventListener('input', terapkan);
        terapkan();
    });
</script>
@endpush