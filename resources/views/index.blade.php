@extends('layouts.app')

@section('title', 'SMA Negeri 2 Medan')

@section('content')

<!-- Hero Section Slider -->
<section class="relative w-full h-[88vh] min-h-[520px] mt-[76px] overflow-hidden bg-[#1a1a1a]">
    
    <!-- Slide 1 -->
    <div class="slide active opacity-100 absolute top-0 left-0 w-full h-full transition-opacity duration-800 ease-in-out bg-cover bg-center flex items-center before:content-[''] before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[linear-gradient(90deg,rgba(0,0,0,0.75)_0%,rgba(0,0,0,0.4)_100%)]" 
         style="background-image: url('https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg');">
        <div class="relative z-[5] max-w-[750px] px-[8%] py-0 text-white text-left">
            <div class="text-[0.9rem] font-bold tracking-[1.5px] uppercase text-[#e8f5f3] mb-[8px]">Smandu Hebat</div>
            <h1 class="text-[3rem] font-extrabold leading-[1.2] mb-[12px]">Selamat Datang di <span class="text-smanda-yellow [text-shadow:0_2px_4px_rgba(0,0,0,0.3)]">SMA Negeri 2 Medan</span></h1>
            <p class="text-[1.05rem] text-[#d1d5db] mb-[28px]">Mewujudkan Lulusan Terdidik dan Kompeten, Berjiwa Besar, Berdaya Saing, Demi Kesejahteraan dan Memajukan Bangsa dan Negara.</p>
            
            <div class="flex items-center gap-[15px] flex-wrap">
                <a href="{{ url('/profil/tentang') }}" class="bg-[#6dc607] text--dark py-[12px] px-[28px] rounded-[30px] no-underline font-bold text-[0.95rem] transition-all duration-300 ease-in-out shadow-[0_4px_10px_rgba(0,0,0,0.15)] hover:bg-smanda-yellow hover:text--dark hover:-translate-y-[2px]">
                    Get Started
                </a>
                <a href="https://www.youtube.com/watch?v=RJ8qDfJWiak" target="_blank" class="inline-flex items-center gap-[10px] bg-white/15 text-white py-[10px] px-[24px] rounded-[30px] no-underline font-semibold text-[0.95rem] backdrop-blur-[5px] border border-white/30 transition-all duration-300 ease-in-out hover:bg-white/30 hover:text-smanda-yellow hover:-translate-y-[2px]">
                    <svg class="w-[26px] h-[26px] fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                    Watch Video
                </a>
            </div>
        </div>
    </div>

    <!-- Slide 2 -->
    <div class="slide opacity-0 absolute top-0 left-0 w-full h-full transition-opacity duration-800 ease-in-out bg-cover bg-center flex items-center before:content-[''] before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[linear-gradient(90deg,rgba(0,0,0,0.75)_0%,rgba(0,0,0,0.4)_100%)]" 
         style="background-image: url('https://files-manager.mistar.id/uploads/MISTAR/24-03-2025/33_siswa_sman_2_medan_lulus_ptn_lewat_jalur_snbp_ini_daftar_namanya_2025-03-24_20-01-52_2870.jpg');">
        <div class="relative z-[5] max-w-[750px] px-[8%] py-0 text-white text-left">
            <div class="text-[0.9rem] font-bold tracking-[1.5px] uppercase text-[#e8f5f3] mb-[8px]">Smandu Hebat</div>
            <h1 class="text-[3rem] font-extrabold leading-[1.2] mb-[12px]">Selamat Datang di <span class="text-smanda-yellow [text-shadow:0_2px_4px_rgba(0,0,0,0.3)]">SMA Negeri 2 Medan</span></h1>
            <p class="text-[1.05rem] text-[#d1d5db] mb-[28px]">Mewujudkan Lulusan Terdidik dan Kompeten, Berjiwa Besar, Berdaya Saing, Demi Kesejahteraan dan Memajukan Bangsa dan Negara.</p>
            
            <div class="flex items-center gap-[15px] flex-wrap">
                <a href="{{ url('/profil/tentang') }}" class="bg-[#6dc607] text--dark py-[12px] px-[28px] rounded-[30px] no-underline font-bold text-[0.95rem] transition-all duration-300 ease-in-out shadow-[0_4px_10px_rgba(0,0,0,0.15)] hover:bg-smanda-yellow hover:text--dark hover:-translate-y-[2px]">
                    Get Started
                </a>
                <a href="https://www.youtube.com/watch?v=RJ8qDfJWiak" target="_blank" class="inline-flex items-center gap-[10px] bg-white/15 text-white py-[10px] px-[24px] rounded-[30px] no-underline font-semibold text-[0.95rem] backdrop-blur-[5px] border border-white/30 transition-all duration-300 ease-in-out hover:bg-white/30 hover:text-smanda-yellow hover:-translate-y-[2px]">
                    <svg class="w-[26px] h-[26px] fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                    Watch Video
                </a>
            </div>
        </div>
    </div>

    <!-- Navigasi Kiri & Kanan -->
    <button class="slider-btn prev absolute top-1/2 -translate-y-1/2 left-[20px] z-[10] bg-white/20 text-white border-none w-[45px] h-[45px] rounded-full cursor-pointer text-[1.2rem] flex items-center justify-center backdrop-blur-[4px] transition-colors duration-300 hover:bg-smanda-yellow hover:text--dark" onclick="moveSlide(-1)">&#10094;</button>
    <button class="slider-btn next absolute top-1/2 -translate-y-1/2 right-[20px] z-[10] bg-white/20 text-white border-none w-[45px] h-[45px] rounded-full cursor-pointer text-[1.2rem] flex items-center justify-center backdrop-blur-[4px] transition-colors duration-300 hover:bg-smanda-yellow hover:text--dark" onclick="moveSlide(1)">&#10095;</button>

    <!-- Indikator Dots -->
    <div class="slider-dots absolute bottom-[40px] left-1/2 -translate-x-1/2 z-[10] flex gap-[8px]">
        <span class="dot active w-[28px] h-[10px] rounded-[12px] bg-smanda-yellow cursor-pointer transition-all duration-300" onclick="currentSlide(0)"></span>
        <span class="dot w-[10px] h-[10px] rounded-full bg-white/40 cursor-pointer transition-all duration-300" onclick="currentSlide(1)"></span>
    </div>

</section>

<!-- Cards Keunggulan (Di Bawah Slider) -->
<div class="max-w-[1200px] -mt-[30px] mx-auto px-[20px] py-0 relative z-[20]">
    <section class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-[20px]">
        <div class="bg-white py-[30px] px-[20px] rounded-[10px] shadow-[0_6px_15px_rgba(0,0,0,0.08)] text-center transition-transform duration-300 hover:-translate-y-[5px] border-t-[5px] border-smanda-green">
            <h3 class="mb-[10px] text--dark font-bold text-[1.17em]">Harmonis</h3>
        </div>
        <div class="bg-white py-[30px] px-[20px] rounded-[10px] shadow-[0_6px_15px_rgba(0,0,0,0.08)] text-center transition-transform duration-300 hover:-translate-y-[5px] border-t-[5px] border-smanda-yellow">
            <h3 class="mb-[10px] text--dark font-bold text-[1.17em]">Edukatif</h3>
        </div>
        <div class="bg-white py-[30px] px-[20px] rounded-[10px] shadow-[0_6px_15px_rgba(0,0,0,0.08)] text-center transition-transform duration-300 hover:-translate-y-[5px] border-t-[5px] border-smanda-red">
            <h3 class="mb-[10px] text--dark font-bold text-[1.17em]">Bersih</h3>
        </div>
        <div class="bg-white py-[30px] px-[20px] rounded-[10px] shadow-[0_6px_15px_rgba(0,0,0,0.08)] text-center transition-transform duration-300 hover:-translate-y-[5px] border-t-[5px] border-smanda-blue">
            <h3 class="mb-[10px] text--dark font-bold text-[1.17em]">Asri</h3>
        </div>
        <div class="bg-white py-[30px] px-[20px] rounded-[10px] shadow-[0_6px_15px_rgba(0,0,0,0.08)] text-center transition-transform duration-300 hover:-translate-y-[5px] border-t-[5px] border-smanda-green">
            <h3 class="mb-[10px] text--dark font-bold text-[1.17em]">Tertib</h3>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        if (index >= slides.length) currentSlideIndex = 0;
        if (index < 0) currentSlideIndex = slides.length - 1;

        slides.forEach(slide => {
            slide.classList.remove('active', 'opacity-100');
            slide.classList.add('opacity-0');
        });
        dots.forEach(dot => {
            dot.classList.remove('active', 'bg-smanda-yellow', 'w-[28px]', 'rounded-[12px]');
            dot.classList.add('bg-white/40', 'w-[10px]', 'rounded-full');
        });

        slides[currentSlideIndex].classList.remove('opacity-0');
        slides[currentSlideIndex].classList.add('active', 'opacity-100');

        dots[currentSlideIndex].classList.remove('bg-white/40', 'w-[10px]', 'rounded-full');
        dots[currentSlideIndex].classList.add('active', 'bg-smanda-yellow', 'w-[28px]', 'rounded-[12px]');
    }

    function moveSlide(step) {
        currentSlideIndex += step;
        showSlide(currentSlideIndex);
    }

    function currentSlide(index) {
        currentSlideIndex = index;
        showSlide(currentSlideIndex);
    }

    setInterval(() => {
        moveSlide(1);
    }, 6000);
</script>
@endpush