@extends('layouts.app')

@php
    // $artikel (+ $terkait) dikirim dari ArtikelController@show. Field isi boleh array paragraf atau teks biasa.
    $siapkan = function ($a) {
        $a = is_array($a) ? $a : $a->toArray();
        $isi = $a['isi'] ?? '';
        $teks = is_array($isi) ? implode(' ', $isi) : strip_tags((string) $isi);
        $a['tanggal_fmt'] ??= \Carbon\Carbon::parse($a['tanggal'])->locale('id')->translatedFormat('d F Y');
        $a['menit_baca']  ??= max(1, (int) ceil(str_word_count($teks) / 200));
        return $a;
    };
    $artikel = $siapkan($artikel);
    $terkait = array_map($siapkan, $terkait ?? []);
    $paragrafs = is_array($artikel['isi']) ? $artikel['isi'] : (preg_split('/\R+/', trim(strip_tags((string) $artikel['isi']))) ?: []);
    $warna = [
        'Akademik'     => 'bg-smanda-blue/10 text-smanda-blue',
        'Prestasi'     => 'bg-smanda-yellow/20 text-smanda-yellow-hover',
        'Kegiatan'     => 'bg-smanda-green-light text-smanda-green-dark',
        'Tips Belajar' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-300',
        'Karier'       => 'bg-smanda-red/10 text-smanda-red',
    ];
    $badgeDefault = 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300';
    $urlArtikel = url('/akademik/artikel/'.$artikel['slug']);
@endphp

@section('title', $artikel['judul'].' - smanda')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <article class="max-w-[820px] mx-auto px-[24px] py-[40px]">
        <a href="{{ url('/akademik/artikel') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline inline-block mb-[20px]">&larr; Kembali ke Artikel</a>

        <span class="inline-block text-[0.7rem] font-bold uppercase tracking-wider px-[10px] py-[3px] rounded-full mb-[14px] {{ $warna[$artikel['kategori']] ?? $badgeDefault }}">{{ $artikel['kategori'] }}</span>

        <h1 class="text-[2rem] sm:text-[2.8rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.25] mb-[16px]">{{ $artikel['judul'] }}</h1>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-[28px]">
            Oleh <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $artikel['penulis'] }}</span>
            &middot; {{ $artikel['tanggal_fmt'] }} &middot; {{ $artikel['menit_baca'] }} menit baca
        </p>

        <div class="rounded-[20px] overflow-hidden bg-gray-200 dark:bg-gray-700 aspect-[16/9] mb-[36px] shadow-sm border border-gray-100 dark:border-gray-700">
            <img src="{{ asset($artikel['gambar']) }}" alt="{{ $artikel['judul'] }}" class="w-full h-full object-cover">
        </div>

        <div class="space-y-[20px] text-[1.05rem] leading-[1.9] text-[#4a5568] dark:text-gray-300">
            <p class="text-[1.15rem] font-medium text-[#2d3748] dark:text-gray-100">{{ $artikel['ringkasan'] }}</p>
            @foreach ($paragrafs as $paragraf)
                <p>{{ $paragraf }}</p>
            @endforeach
        </div>

        <!-- BAGIKAN -->
        <div class="mt-[44px] pt-[24px] border-t border-gray-200 dark:border-gray-700 flex flex-wrap items-center gap-[12px]">
            <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">Bagikan:</span>
            <a href="https://wa.me/?text={{ urlencode($artikel['judul'].' - '.$urlArtikel) }}" target="_blank" rel="noopener"
               class="px-[16px] py-[7px] rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-smanda-green hover:text-white transition-colors">WhatsApp</a>
            <button type="button" id="salin-tautan" data-url="{{ $urlArtikel }}"
                    class="px-[16px] py-[7px] rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-smanda-green hover:text-white transition-colors">Salin Tautan</button>
        </div>
    </article>

    <!-- ARTIKEL TERKAIT -->
    @if (count($terkait))
        <section class="max-w-[1280px] mx-auto px-[24px] pt-[40px] border-t border-gray-200/60 dark:border-gray-800">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Baca Juga</span>
            <h2 class="text-[1.8rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[24px]">Artikel Lainnya</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-[24px]">
                @foreach ($terkait as $a)
                    <a href="{{ url('/akademik/artikel/'.$a['slug']) }}"
                       class="group flex flex-col bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="aspect-[16/10] overflow-hidden bg-gray-200 dark:bg-gray-700">
                            <img src="{{ asset($a['gambar']) }}" alt="{{ $a['judul'] }}" loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="p-[20px]">
                            <span class="text-[0.7rem] font-bold uppercase tracking-wider text-smanda-green-dark dark:text-smanda-green">{{ $a['kategori'] }}</span>
                            <h3 class="text-[1.05rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.4] mt-[6px] mb-[8px]">{{ $a['judul'] }}</h3>
                            <p class="text-xs text-gray-400">{{ $a['tanggal_fmt'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('salin-tautan');
        if (!btn) return;
        btn.addEventListener('click', async function () {
            try {
                await navigator.clipboard.writeText(btn.dataset.url);
                const awal = btn.textContent;
                btn.textContent = 'Tersalin!';
                setTimeout(() => btn.textContent = awal, 1800);
            } catch (e) {
                window.prompt('Salin tautan ini:', btn.dataset.url);
            }
        });
    });
</script>
@endpush