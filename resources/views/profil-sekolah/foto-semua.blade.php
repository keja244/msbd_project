@extends('layouts.app')

@section('title', 'Semua Foto - smanda')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <a href="{{ url('/profil/galeri-foto') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline inline-block mb-[16px]">&larr; Kembali ke Galeri</a>
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Dokumentasi Kegiatan</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">Semua Foto</h1>
        <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] max-w-[800px]">
            Seluruh koleksi foto dokumentasi smanda. Total {{ count($fotos) }} foto.
        </p>
        <input type="search" id="cari-foto" placeholder="Cari judul atau kategori foto..."
               class="mt-[24px] w-full sm:w-[360px] px-[16px] py-[10px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green">
    </section>

    <section class="max-w-[1280px] mx-auto px-[24px] py-[50px]">
        @forelse ($fotos as $foto)
            @if ($loop->first)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[24px]">
            @endif

            <button type="button" data-src="{{ asset($foto['src']) }}" data-judul="{{ $foto['judul'] }}"
                    data-cari="{{ strtolower($foto['judul'].' '.$foto['kategori']) }}"
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

        <p id="foto-kosong" class="hidden text-gray-500 dark:text-gray-400 mt-[20px]">Tidak ada foto yang cocok dengan pencarianmu.</p>
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
        const allItems = Array.from(document.querySelectorAll('.foto-item'));
        const lb = document.getElementById('lightbox');
        const lbImg = document.getElementById('lb-img');
        const lbCaption = document.getElementById('lb-caption');
        let items = allItems;   // daftar foto yang sedang tampil (hasil pencarian)
        let current = 0;

        function tampil(i) {
            if (!items.length) return;
            current = (i + items.length) % items.length;
            lbImg.src = items[current].dataset.src;
            lbImg.alt = items[current].dataset.judul;
            lbCaption.textContent = items[current].dataset.judul + ' (' + (current + 1) + '/' + items.length + ')';
        }
        function buka(el) {
            current = items.indexOf(el);
            tampil(current);
            lb.classList.remove('hidden'); lb.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function tutup() { lb.classList.add('hidden'); lb.classList.remove('flex'); document.body.style.overflow = ''; }

        allItems.forEach(el => el.addEventListener('click', () => buka(el)));
        document.getElementById('lb-close').addEventListener('click', tutup);
        document.getElementById('lb-prev').addEventListener('click', () => tampil(current - 1));
        document.getElementById('lb-next').addEventListener('click', () => tampil(current + 1));
        lb.addEventListener('click', e => { if (e.target === lb) tutup(); });
        document.addEventListener('keydown', e => {
            if (lb.classList.contains('hidden')) return;
            if (e.key === 'Escape') tutup();
            if (e.key === 'ArrowLeft') tampil(current - 1);
            if (e.key === 'ArrowRight') tampil(current + 1);
        });

        // Pencarian
        const input = document.getElementById('cari-foto');
        const kosong = document.getElementById('foto-kosong');
        input.addEventListener('input', function () {
            const kata = input.value.trim().toLowerCase();
            items = allItems.filter(el => {
                const cocok = el.dataset.cari.includes(kata);
                el.classList.toggle('hidden', !cocok);
                return cocok;
            });
            kosong.classList.toggle('hidden', items.length > 0);
        });
    });
</script>
@endpush