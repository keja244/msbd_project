@extends('layouts.app')

@section('title', 'Semua Video - smanda')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <a href="{{ url('/profil/galeri-video') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline inline-block mb-[16px]">&larr; Kembali ke Galeri</a>
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Kanal Multimedia</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">Semua Video</h1>
        <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] max-w-[800px]">
            Seluruh koleksi video dokumentasi kegiatan smanda. Total {{ count($videos) }} video.
        </p>
        <input type="search" id="cari-video" placeholder="Cari judul video..."
               class="mt-[24px] w-full sm:w-[360px] px-[16px] py-[10px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green">
    </section>

    <section class="max-w-[1280px] mx-auto px-[24px] py-[50px]">
        @forelse ($videos as $video)
            @if ($loop->first)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[28px]">
            @endif

            <div class="video-card bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm" data-judul="{{ strtolower($video['judul']) }}">
                <div class="relative w-full rounded-[12px] overflow-hidden bg-black aspect-video mb-[14px]">
                    <video controls controlsList="nodownload" preload="none" poster="{{ asset($video['poster']) }}" class="w-full h-full object-cover">
                        <source src="{{ asset($video['src']) }}" type="video/mp4">
                        Browsermu tidak mendukung pemutaran video.
                    </video>
                </div>
                <h3 class="text-[1.05rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[6px]">{{ $video['judul'] }}</h3>
                <p class="text-[0.88rem] text-[#718096] dark:text-gray-400 font-light">{{ $video['deskripsi'] }}</p>
            </div>

            @if ($loop->last)
                </div>
            @endif
        @empty
            <p class="text-gray-500 dark:text-gray-400">Belum ada video.</p>
        @endforelse

        <p id="video-kosong" class="hidden text-gray-500 dark:text-gray-400 mt-[20px]">Tidak ada video yang cocok dengan pencarianmu.</p>
    </section>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('cari-video');
        const cards = document.querySelectorAll('.video-card');
        const kosong = document.getElementById('video-kosong');
        input.addEventListener('input', function () {
            const kata = input.value.trim().toLowerCase();
            let ada = 0;
            cards.forEach(card => {
                const cocok = card.dataset.judul.includes(kata);
                card.classList.toggle('hidden', !cocok);
                if (cocok) ada++;
            });
            kosong.classList.toggle('hidden', ada > 0);
        });
    });
</script>
@endpush