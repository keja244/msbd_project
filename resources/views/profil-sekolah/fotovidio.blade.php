@extends('layouts.app')

@section('title', 'Galeri Foto & Video - smanda')

@section('content')

<div id="galeri-wrapper" data-initial="{{ $tab }}"
     class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <!-- HEADER -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Dokumentasi</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">
            Galeri Foto & Video
        </h1>
        <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] max-w-[800px]">
            Kumpulan dokumentasi kegiatan, lingkungan, dan prestasi civitas akademika smanda dalam bentuk foto dan video.
        </p>

        <!-- TAB -->
        <div class="flex flex-wrap gap-[10px] mt-[28px]">
            <button type="button" data-tab="semua" class="tab-btn px-[18px] py-[8px] rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors">Semua</button>
            <button type="button" data-tab="foto" class="tab-btn px-[18px] py-[8px] rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors">Foto ({{ $totalFoto }})</button>
            <button type="button" data-tab="video" class="tab-btn px-[18px] py-[8px] rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors">Video ({{ $totalVideo }})</button>
        </div>
    </section>

    <!-- ========== FOTO ========== -->
    <section id="section-foto" class="max-w-[1280px] mx-auto px-[24px] py-[60px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="mb-[28px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Dokumentasi Kegiatan</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Galeri Foto</h2>
        </div>

        @forelse ($fotos as $i => $foto)
            @if ($loop->first)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[24px]">
            @endif

            <button type="button" data-src="{{ asset($foto['src']) }}" data-judul="{{ $foto['judul'] }}"
                    class="foto-item group relative overflow-hidden rounded-[16px] bg-gray-200 dark:bg-gray-800 aspect-[4/3] shadow-sm border border-gray-100 dark:border-gray-700 text-left cursor-zoom-in">
                <img src="{{ asset($foto['src']) }}" alt="{{ $foto['judul'] }}" loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <span class="absolute top-3 left-3 bg-white/90 dark:bg-gray-900/80 text-[0.7rem] font-bold uppercase tracking-wider text-smanda-green-dark dark:text-smanda-green px-[10px] py-[3px] rounded-full">{{ $foto['kategori'] }}</span>
                <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <span class="text-white text-sm font-semibold">{{ $foto['judul'] }}</span>
                </span>
            </button>

            @if ($loop->last)
                </div>
            @endif
        @empty
            <p class="text-gray-500 dark:text-gray-400">Belum ada foto.</p>
        @endforelse

        {{-- Tombol ke halaman foto lainnya, di BAWAH 3 foto --}}
        @if ($totalFoto > count($fotos))
            <div class="mt-[40px] text-center">
                <a href="{{ url('/profil/galeri-foto/semua') }}"
                   class="inline-flex items-center gap-[8px] px-[28px] py-[12px] rounded-full bg-smanda-green hover:bg-smanda-green-dark text-white text-sm font-bold uppercase tracking-wider transition-colors">
                    Lihat Foto Lainnya &rarr;
                </a>
                <p class="text-xs text-gray-400 mt-[10px]">Menampilkan {{ count($fotos) }} dari {{ $totalFoto }} foto</p>
            </div>
        @endif
    </section>

    <!-- ========== VIDEO (tampil 3 saja) ========== -->
    <section id="section-video" class="max-w-[1280px] mx-auto px-[24px] py-[60px]">
        <div class="mb-[28px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Kanal Multimedia</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Galeri Video</h2>
        </div>

        @forelse ($videos as $video)
            @if ($loop->first)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[28px]">
            @endif

            <div class="bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <div class="relative w-full rounded-[12px] overflow-hidden bg-black aspect-video mb-[14px]">
                    <video controls controlsList="nodownload" preload="none" poster="{{ asset($video['poster']) }}" class="w-full h-full object-cover">
                        <source src="{{ asset($video['src']) }}" type="video/mp4">
                        Browsermu tidak mendukung pemutaran video.
                    </video>
                </div>
                <h3 class="text-[1.1rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[6px]">{{ $video['judul'] }}</h3>
                <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light">{{ $video['deskripsi'] }}</p>
            </div>

            @if ($loop->last)
                </div>
            @endif
        @empty
            <p class="text-gray-500 dark:text-gray-400">Belum ada video.</p>
        @endforelse

        {{-- Tombol ke halaman video lainnya, di BAWAH 3 video --}}
        @if ($totalVideo > count($videos))
            <div class="mt-[40px] text-center">
                <a href="{{ url('/profil/galeri-video/semua') }}"
                   class="inline-flex items-center gap-[8px] px-[28px] py-[12px] rounded-full bg-smanda-green hover:bg-smanda-green-dark text-white text-sm font-bold uppercase tracking-wider transition-colors">
                    Lihat Video Lainnya &rarr;
                </a>
                <p class="text-xs text-gray-400 mt-[10px]">Menampilkan {{ count($videos) }} dari {{ $totalVideo }} video</p>
            </div>
        @endif
    </section>
</div>

<!-- LIGHTBOX FOTO -->
<div id="lightbox" class="hidden fixed inset-0 z-[100] bg-black/90 items-center justify-center p-4" aria-modal="true" role="dialog">
    <button type="button" id="lb-close" class="absolute top-4 right-5 text-white text-4xl leading-none" aria-label="Tutup">&times;</button>
    <button type="button" id="lb-prev" class="absolute left-3 sm:left-6 text-white text-4xl px-3" aria-label="Sebelumnya">&#8249;</button>
    <figure class="max-w-[1100px] w-full text-center">
        <img id="lb-img" src="" alt="" class="max-h-[78vh] w-auto mx-auto rounded-[12px] object-contain">
        <figcaption id="lb-caption" class="text-white text-sm font-medium mt-4"></figcaption>
    </figure>
    <button type="button" id="lb-next" class="absolute right-3 sm:right-6 text-white text-4xl px-3" aria-label="Berikutnya">&#8250;</button>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ---- Tab ----
        const wrapper = document.getElementById('galeri-wrapper');
        const tabBtns = document.querySelectorAll('.tab-btn');
        const secFoto = document.getElementById('section-foto');
        const secVideo = document.getElementById('section-video');
        const aktif = ['bg-smanda-green', 'text-white', 'border-smanda-green'];
        const nonAktif = ['bg-white', 'dark:bg-gray-800', 'text-gray-600', 'dark:text-gray-300'];

        function setTab(nama) {
            secFoto.classList.toggle('hidden', nama === 'video');
            secVideo.classList.toggle('hidden', nama === 'foto');
            tabBtns.forEach(btn => {
                const on = btn.dataset.tab === nama;
                aktif.forEach(c => btn.classList.toggle(c, on));
                nonAktif.forEach(c => btn.classList.toggle(c, !on));
            });
        }
        tabBtns.forEach(btn => btn.addEventListener('click', () => setTab(btn.dataset.tab)));
        setTab(wrapper.dataset.initial || 'semua');

        // ---- Lightbox foto ----
        const items = Array.from(document.querySelectorAll('.foto-item'));
        const lb = document.getElementById('lightbox');
        const lbImg = document.getElementById('lb-img');
        const lbCaption = document.getElementById('lb-caption');
        let current = 0;

        function tampil(i) {
            if (!items.length) return;
            current = (i + items.length) % items.length;
            lbImg.src = items[current].dataset.src;
            lbImg.alt = items[current].dataset.judul;
            lbCaption.textContent = items[current].dataset.judul + ' (' + (current + 1) + '/' + items.length + ')';
        }
        function buka(i) { tampil(i); lb.classList.remove('hidden'); lb.classList.add('flex'); document.body.style.overflow = 'hidden'; }
        function tutup() { lb.classList.add('hidden'); lb.classList.remove('flex'); document.body.style.overflow = ''; }

        items.forEach((el, i) => el.addEventListener('click', () => buka(i)));
        document.getElementById('lb-close').addEventListener('click', tutup);
        document.getElementById('lb-prev').addEventListener('click', () => tampil(current - 1));
        document.getElementById('lb-next').addEventListener('click', () => tampil(current + 1));
        lb.addEventListener('click', e => { if (e.target === lb) tutup(); });
        document.addEventListener('keydown', e => {            if (lb.classList.contains('hidden')) return;
            if (e.key === 'Escape') tutup();
            if (e.key === 'ArrowLeft') tampil(current - 1);
            if (e.key === 'ArrowRight') tampil(current + 1);
        });
    });
</script>
@endpush