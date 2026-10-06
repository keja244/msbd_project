@extends('layouts.app')

@section('title', 'SMA Negeri 2 Medan')

@section('content')

<!-- BACKGROUND WRAPPER DENGAN SUPPORT DARK MODE -->
<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] transition-colors duration-300">

    <!-- 1. HERO SECTION SLIDER -->
    <section class="relative w-full h-[88vh] min-h-[520px] overflow-hidden bg-[#1a1a1a]">
        
        <!-- Slide 1  -->
        <div class="slide opacity-0 absolute top-0 left-0 w-full h-full transition-opacity duration-800 ease-in-out bg-cover bg-center flex items-center before:content-[''] before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[linear-gradient(90deg,rgba(0,0,0,0.75)_0%,rgba(0,0,0,0.3)_100%)]" 
             style="background-image: url('{{ asset('images/slide2.jpeg') }}');">
            <div class="relative z-[5] max-w-[1280px] w-full mx-auto px-[24px]">
                <div class="max-w-[700px]">
                    <span class="text-[0.85rem] font-semibold tracking-[2px] uppercase text-[#e8f5f3] block mb-[10px]">Smandu Hebat</span>
                    <h1 class="text-[2.8rem] sm:text-[3.6rem] font-extrabold text-white leading-[1.15] mb-[16px]">
                        Selamat Datang di <br>
                        <span class="text-smanda-yellow">SMA Negeri 2 Medan</span>
                    </h1>
                    <p class="text-[1.05rem] text-[#d1d5db] font-light leading-[1.7] mb-[30px]">
                        Mewujudkan Lulusan Terdidik dan Kompeten, Berjiwa Besar, Berdaya Saing, Demi Kesejahteraan dan Memajukan Bangsa dan Negara.
                    </p>
                    <div class="flex items-center gap-[16px] flex-wrap">
                        <a href="{{ url('/profil/tentang') }}" class="bg-smanda-green text-white py-[12px] px-[28px] rounded-[8px] font-semibold text-[0.95rem] transition-all duration-300 hover:bg-smanda-green-dark">
                            Kenali Kami &rarr;
                        </a>
                        <a href="https://www.youtube.com/watch?v=RJ8qDfJWiak" target="_blank" class="inline-flex items-center gap-[10px] bg-white/15 text-white py-[11px] px-[24px] rounded-[8px] font-semibold text-[0.95rem] backdrop-blur-[5px] border border-white/30 transition-all duration-300 hover:bg-white/30 hover:text-smanda-yellow">
                            <svg class="w-[22px] h-[22px] fill-current" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                            </svg>
                            Watch Video
                        </a>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide active opacity-100 absolute top-0 left-0 w-full h-full transition-opacity duration-800 ease-in-out bg-cover bg-center flex items-center before:content-[''] before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[linear-gradient(90deg,rgba(0,0,0,0.75)_0%,rgba(0,0,0,0.3)_100%)]" 
             style="background-image: url('{{ asset('images/slide1.jpeg') }}');">
            <div class="relative z-[5] max-w-[1280px] w-full mx-auto px-[24px]">
                <div class="max-w-[700px]">
                    <span class="text-[0.85rem] font-semibold tracking-[2px] uppercase text-[#e8f5f3] block mb-[10px]">Smandu Hebat</span>
                    <h1 class="text-[2.8rem] sm:text-[3.6rem] font-extrabold text-white leading-[1.15] mb-[16px]">
                        Lingkungan Belajar <br>
                        <span class="text-smanda-yellow">Asri & Terintegrasi</span>
                    </h1>
                    <p class="text-[1.05rem] text-[#d1d5db] font-light leading-[1.7] mb-[30px]">
                        Fasilitas modern yang mendukung pengembangan akademik dan karakter siswa menuju potensi terbaiknya.
                    </p>
                    <div class="flex items-center gap-[16px] flex-wrap">
                        <a href="{{ url('/profil/tentang') }}" class="bg-smanda-green text-white py-[12px] px-[28px] rounded-[8px] font-semibold text-[0.95rem] transition-all duration-300 hover:bg-smanda-green-dark">
                            Kenali Kami &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3  -->
        <div class="slide opacity-0 absolute top-0 left-0 w-full h-full transition-opacity duration-800 ease-in-out bg-cover bg-center flex items-center before:content-[''] before:absolute before:top-0 before:left-0 before:w-full before:h-full before:bg-[linear-gradient(90deg,rgba(0,0,0,0.75)_0%,rgba(0,0,0,0.3)_100%)]" 
             style="background-image: url('{{ asset('images/slide3.jpeg') }}');">
            <div class="relative z-[5] max-w-[1280px] w-full mx-auto px-[24px]">
                <div class="max-w-[700px]">
                    <span class="text-[0.85rem] font-semibold tracking-[2px] uppercase text-[#e8f5f3] block mb-[10px]">Smandu Hebat</span>
                    <h1 class="text-[2.8rem] sm:text-[3.6rem] font-extrabold text-white leading-[1.15] mb-[16px]">
                        Prestasi & Kegiatan <br>
                        <span class="text-smanda-yellow">Siswa Unggulan</span>
                    </h1>
                    <p class="text-[1.05rem] text-[#d1d5db] font-light leading-[1.7] mb-[30px]">
                        Berbagai pencapaian membanggakan diraih oleh siswa-siswi SMAN 2 Medan di tingkat regional maupun nasional.
                    </p>
                    <div class="flex items-center gap-[16px] flex-wrap">
                        <a href="{{ url('/akademik/prestasi') }}" class="bg-smanda-green text-white py-[12px] px-[28px] rounded-[8px] font-semibold text-[0.95rem] transition-all duration-300 hover:bg-smanda-green-dark">
                            Lihat Prestasi &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigasi Kiri & Kanan -->
        <button class="slider-btn prev absolute top-1/2 -translate-y-1/2 left-[20px] z-[10] bg-white/20 text-white border-none w-[45px] h-[45px] rounded-full cursor-pointer text-[1.2rem] flex items-center justify-center backdrop-blur-[4px] transition-colors duration-300 hover:bg-smanda-yellow hover:text-smanda-dark" onclick="moveSlide(-1)">&#10094;</button>
        <button class="slider-btn next absolute top-1/2 -translate-y-1/2 right-[20px] z-[10] bg-white/20 text-white border-none w-[45px] h-[45px] rounded-full cursor-pointer text-[1.2rem] flex items-center justify-center backdrop-blur-[4px] transition-colors duration-300 hover:bg-smanda-yellow hover:text-smanda-dark" onclick="moveSlide(1)">&#10095;</button>

        <!-- Indikator Dots -->
        <div class="slider-dots absolute bottom-[30px] left-1/2 -translate-x-1/2 z-[10] flex gap-[8px]">
            <span class="dot active w-[28px] h-[8px] rounded-[12px] bg-smanda-yellow cursor-pointer transition-all duration-300" onclick="currentSlide(0)"></span>
            <span class="dot w-[8px] h-[8px] rounded-full bg-white/40 cursor-pointer transition-all duration-300" onclick="currentSlide(1)"></span>
            <span class="dot w-[8px] h-[8px] rounded-full bg-white/40 cursor-pointer transition-all duration-300" onclick="currentSlide(2)"></span>
        </div>

    </section>

    <!-- KEUNGGULAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[50px] border-b border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <div class="relative z-10 grid grid-cols-2 md:grid-cols-5 gap-[16px] sm:gap-[20px] text-center pt-[10px]">
            <div class="py-[10px] bg-white/50 dark:bg-gray-800/50 md:bg-transparent rounded-[12px] p-3 md:p-0 border border-gray-100 dark:border-gray-700 md:border-none">
                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-wider text-smanda-green block mb-[4px]">Harmonis</span>
                <h3 class="text-[#4a5568] dark:text-gray-300 font-medium text-[1.1rem] sm:text-[1.2em]">Desc</h3>
            </div>
            <div class="py-[10px] bg-white/50 dark:bg-gray-800/50 md:bg-transparent rounded-[12px] p-3 md:p-0 border border-gray-100 dark:border-gray-700 md:border-none">
                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-wider text-smanda-yellow-hover block mb-[4px]">Edukatif</span>
                <h3 class="text-[#4a5568] dark:text-gray-300 font-medium text-[1.1rem] sm:text-[1.2em]">Desc</h3>
            </div>
            <div class="py-[10px] bg-white/50 dark:bg-gray-800/50 md:bg-transparent rounded-[12px] p-3 md:p-0 border border-gray-100 dark:border-gray-700 md:border-none">
                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-wider text-smanda-red block mb-[4px]">Bersih</span>
                <h3 class="text-[#4a5568] dark:text-gray-300 font-medium text-[1.1rem] sm:text-[1.2em]">Desc</h3>
            </div>
            <div class="py-[10px] bg-white/50 dark:bg-gray-800/50 md:bg-transparent rounded-[12px] p-3 md:p-0 border border-gray-100 dark:border-gray-700 md:border-none">
                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-wider text-smanda-blue block mb-[4px]">Asri</span>
                <h3 class="text-[#4a5568] dark:text-gray-300 font-medium text-[1.1rem] sm:text-[1.2em]">Desc</h3>
            </div>
            <div class="py-[10px] bg-white/50 dark:bg-gray-800/50 md:bg-transparent rounded-[12px] p-3 md:p-0 border border-gray-100 dark:border-gray-700 md:border-none col-span-2 md:col-span-1">
                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-wider text-smanda-green block mb-[4px]">Tertib</span>
                <h3 class="text-[#4a5568] dark:text-gray-300 font-medium text-[1.1rem] sm:text-[1.2em]">Desc</h3>
            </div>
        </div>
    </section>

    <!-- SECTION ABOUT / PROFIL VIDEO -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[80px] relative overflow-hidden">
        <span class="absolute top-[-15px] left-[20px] text-[6rem] md:text-[9rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Profil
        </span>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-[40px] items-center pt-[20px]">
            <div class="md:col-span-5 flex flex-col justify-center">
                <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Tentang Kami</span>
                <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[20px]">
                    SMA Negeri 2 Medan
                </h2>
                <p class="text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light mb-[16px]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sollicitudin orci nisl, ut cursus dolor commodo vitae. Aenean vitae erat sagittis, congue enim egestas, auctor mi.
                </p>
                <p class="text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light mb-[28px]">
                    Integer ullamcorper enim ac porta posuere. Curabitur sit amet ante non odio sodales imperdiet at quis lectus. Etiam dignissim vitae erat ac luctus.
                </p>
                <div>
                    <a href="{{ url('/profil/tentang') }}" class="inline-block bg-smanda-green text-white py-[11px] px-[26px] rounded-[8px] font-semibold text-[0.9rem] transition-all duration-300 hover:bg-smanda-green-dark">
                        Selengkapnya &rarr;
                    </a>
                </div>
            </div>

            <div class="md:col-span-7">
                <div class="relative w-full rounded-[16px] overflow-hidden shadow-sm bg-[#000] aspect-video">
                    <video controls controlsList="nodownload" poster="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" class="w-full h-full object-cover">
                        <source src="{{ asset('videos/contoh_video.mp4') }}" type="video/mp4">
                        Browsermu tidak mendukung pemutaran video.
                    </video>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION VISI & MISI -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px] border-t border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <span class="absolute top-[-29px] left-[20px] text-[6rem] md:text-[9rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Landasan
        </span>

        <div class="relative z-10 pt-[20px]">
            <div class="mb-[36px]">
                <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Landasan Utama</span>
                <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Visi & Misi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-[40px]">
                <div class="md:col-span-5">
                    <span class="text-xs font-bold text-smanda-red uppercase tracking-wider block mb-[10px]">Visi Sekolah</span>
                    <p class="text-[1.2rem] font-normal text-[#2d3748] dark:text-gray-200 leading-[1.75] italic">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sollicitudin orci nisl, ut cursus dolor commodo vitae."
                    </p>
                </div>

                <div class="md:col-span-7">
                    <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[14px]">Misi Sekolah</span>
                    <ol class="list-decimal list-inside space-y-[12px] text-[#4a5568] dark:text-gray-300 text-[1rem] leading-[1.7] font-light">
                        <li class="pl-1"> Aenean vitae erat sagittis, congue enim egestas, auctor mi. Sed condimentum odio ut tellus malesuada, in interdum est gravida.</li>
                        <li class="pl-1"> Aenean vitae erat sagittis, congue enim egestas, auctor mi. Sed condimentum odio ut tellus malesuada, in interdum est gravida.</li>
                        <li class="pl-1"> Aenean vitae erat sagittis, congue enim egestas, auctor mi. Sed condimentum odio ut tellus malesuada, in interdum est gravida.</li>
                        <li class="pl-1"> Aenean vitae erat sagittis, congue enim egestas, auctor mi. Sed condimentum odio ut tellus malesuada, in interdum est gravida.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION ARTIKEL & BERITA -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[80px] border-t border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <span class="absolute top-[-15px] left-[20px] text-[6rem] md:text-[9rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Informasi
        </span>

        <div class="relative z-10 pt-[20px]">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-[36px]">
                <div>
                    <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Pusat Informasi</span>
                    <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Kabar Terbaru</h2>
                </div>
                <a href="{{ url('/berita') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline mt-[10px] sm:mt-0">
                    Lihat Semua Berita &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-[36px]">
                <article class="flex flex-col justify-between group bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div>
                        <div class="relative h-[220px] overflow-hidden rounded-[12px] mb-[18px]">
                            <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Judul Berita" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-[16px] left-[16px] bg-white/90 dark:bg-gray-900/90 text-gray-700 dark:text-gray-200 backdrop-blur-md text-[0.7rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full">
                                Kegiatan
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 block mb-[8px]">2026-05-24</span>
                        <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.35] mb-[10px] group-hover:text-smanda-green transition-colors line-clamp-2">
                            Peringatan Hari Pendidikan Nasional Berlangsung Khidmat di SMAN 2 Medan
                        </h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-400 font-light line-clamp-3 leading-[1.6] mb-[18px]">
                            Seluruh siswa dan tenaga pendidik mengikuti upacara bendera dalam rangka memperingati Hardiknas dengan penuh semangat.
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('/berita/detail-1') }}" class="text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 group-hover:text-smanda-green transition-colors">
                            Baca Selengkapnya
                        </a>
                    </div>
                </article>

                <article class="flex flex-col justify-between group bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div>
                        <div class="relative h-[220px] overflow-hidden rounded-[12px] mb-[18px]">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.qZAOvySOO5XS7LYVS_uj-wHaDt?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Judul Berita" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-[16px] left-[16px] bg-white/90 dark:bg-gray-900/90 text-gray-700 dark:text-gray-200 backdrop-blur-md text-[0.7rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full">
                                Prestasi
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 block mb-[8px]">2026-05-18</span>
                        <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.35] mb-[10px] group-hover:text-smanda-green transition-colors line-clamp-2">
                            Siswa SMAN 2 Medan Raih Juara Olimpiade Sains Tingkat Provinsi
                        </h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-400 font-light line-clamp-3 leading-[1.6] mb-[18px]">
                            Kabar membanggakan datang dari tim olimpiade sains yang berhasil menorehkan prestasi gemilang di tingkat Sumatera Utara.
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('/berita/detail-2') }}" class="text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 group-hover:text-smanda-green transition-colors">
                            Baca Selengkapnya
                        </a>
                    </div>
                </article>

                <article class="flex flex-col justify-between group bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div>
                        <div class="relative h-[220px] overflow-hidden rounded-[12px] mb-[18px]">
                            <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Judul Berita" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-[16px] left-[16px] bg-white/90 dark:bg-gray-900/90 text-gray-700 dark:text-gray-200 backdrop-blur-md text-[0.7rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full">
                                Pengumuman
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 block mb-[8px]">2026-05-10</span>
                        <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.35] mb-[10px] group-hover:text-smanda-green transition-colors line-clamp-2">
                            Sosialisasi Penerimaan Peserta Didik Baru (PPDB)
                        </h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-400 font-light line-clamp-3 leading-[1.6] mb-[18px]">
                            Informasi lengkap mengenai jadwal, persyaratan, dan alur pendaftaran siswa baru SMAN 2 Medan.
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('/berita/detail-3') }}" class="text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 group-hover:text-smanda-green transition-colors">
                            Baca Selengkapnya
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- SECTION PRESTASI MINGGUAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[80px] border-t border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <span class="absolute top-[-15px] left-[20px] text-[6rem] md:text-[9rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Prestasi
        </span>

        <div class="relative z-10 pt-[20px]">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-[36px]">
                <div>
                    <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Kebanggaan Smandu</span>
                    <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Prestasi Minggu Ini</h2>
                </div>
                <a href="{{ url('/akademik/prestasi') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline mt-[10px] sm:mt-0">
                    Lihat Semua Prestasi &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-[36px]">
                <article class="flex flex-col justify-between group bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div>
                        <div class="relative h-[220px] overflow-hidden rounded-[12px] mb-[18px]">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.qZAOvySOO5XS7LYVS_uj-wHaDt?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Prestasi 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-[16px] left-[16px] bg-smanda-yellow text-smanda-dark text-[0.7rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full shadow-sm">
                                Nasional
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 block mb-[8px]">Minggu Ini • 20 September 2026</span>
                        <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.35] mb-[10px] group-hover:text-smanda-green transition-colors line-clamp-2">
                            Juara 1 Olimpiade Sains Matematika Tingkat Nasional
                        </h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-400 font-light line-clamp-3 leading-[1.6] mb-[18px]">
                            Siswa SMAN 2 Medan berhasil memboyong medali emas pada ajang kompetisi sains nasional tingkat SMA.
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('/akademik/prestasi') }}" class="text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 group-hover:text-smanda-green transition-colors">
                            Rincian Prestasi &rarr;
                        </a>
                    </div>
                </article>

                <article class="flex flex-col justify-between group bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div>
                        <div class="relative h-[220px] overflow-hidden rounded-[12px] mb-[18px]">
                            <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Prestasi 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-[16px] left-[16px] bg-smanda-blue text-white text-[0.7rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full shadow-sm">
                                Provinsi
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 block mb-[8px]">Minggu Ini • 18 September 2026</span>
                        <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.35] mb-[10px] group-hover:text-smanda-green transition-colors line-clamp-2">
                            Medali Emas Kejuaraan Basket Pelajar Sumatera Utara
                        </h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-400 font-light line-clamp-3 leading-[1.6] mb-[18px]">
                            Tim Basket Utama SMAN 2 Medan kembali mempertahankan gelar juara usai menumbangkan lawan di babak final.
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('/akademik/prestasi') }}" class="text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 group-hover:text-smanda-green transition-colors">
                            Rincian Prestasi &rarr;
                        </a>
                    </div>
                </article>

                <article class="flex flex-col justify-between group bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div>
                        <div class="relative h-[220px] overflow-hidden rounded-[12px] mb-[18px]">
                            <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Prestasi 3" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-[16px] left-[16px] bg-smanda-red text-white text-[0.7rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full shadow-sm">
                                Kota Medan
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 block mb-[8px]">Minggu Lalu • 12 September 2026</span>
                        <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.35] mb-[10px] group-hover:text-smanda-green transition-colors line-clamp-2">
                            Juara Terbaik Lomba Debat Bahasa Inggris Tingkat Kota
                        </h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-400 font-light line-clamp-3 leading-[1.6] mb-[18px]">
                            Siswa SMANDA meraih penghargaan Best Speaker pada ajang kompetisi debat antar sekolah se-Kota Medan.
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('/akademik/prestasi') }}" class="text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 group-hover:text-smanda-green transition-colors">
                            Rincian Prestasi &rarr;
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- SECTION SAMBUTAN KEPALA SEKOLAH -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[80px] border-t border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <span class="absolute top-[-45px] left-[20px] text-[5rem] md:text-[8rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Kepala Sekolah
        </span>

        <div class="relative z-10 pt-[20px]">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-[40px] items-center">
                <div class="lg:col-span-5">
                    <div class="relative w-full max-w-[380px] mx-auto lg:mx-0 rounded-[16px] overflow-hidden shadow-sm bg-gray-100 dark:bg-gray-800">
                        <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Foto Kepala Sekolah" class="w-full h-[420px] object-cover">
                    </div>
                </div>

                <div class="lg:col-span-7 flex flex-col justify-center">
                    <span class="text-lg font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Sambutan Utama</span>
                    
                    <p class="text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-medium mb-[16px] mr-[20px]">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sollicitudin orci nisl, ut cursus dolor commodo vitae. Aenean vitae erat sagittis, congue enim egestas, auctor mi.
                    </p>
                    
                    <p class="text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light mb-[28px] mr-[20px]">
                        Kami berkomitmen untuk terus menyelenggarakan pendidikan berkualitas, mengasah potensi akademis maupun non-akademis, serta membentuk karakter siswa yang berintegritas, berdaya saing, dan berjiwa nasionalisme.
                    </p>
                    <p class="text-xs font-bold tracking-[2px] text-smanda-green block mb-[8px]">- Drs. Marsito, M.Si -</p>
                    <p class="text-xs font-bold tracking-[2px] text-smanda-red block mb-[8px]"> KEPALA SMAN 2 MEDAN </p>

                    <div class="pt-[10px]">
                        <a href="{{ url('/profil/kepala-sekolah') }}" class="inline-block bg-smanda-green text-white py-[11px] px-[26px] rounded-[8px] font-semibold text-[0.9rem] transition-all duration-300 hover:bg-smanda-green-dark">
                            Baca Sambutan Lengkap &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION GALERI FOTO -->
    <!-- ========================================== -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[80px] border-t border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <span class="absolute top-[-15px] left-[20px] text-[6rem] md:text-[9rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Galeri
        </span>

        <div class="relative z-10 pt-[20px]">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-[36px]">
                <div>
                    <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Dokumentasi Kegiatan</span>
                    <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Galeri Foto</h2>
                </div>
                <a href="{{ url('/profil/galeri-foto') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline mt-[10px] sm:mt-0">
                    Lihat Semua Foto &rarr;
                </a>
            </div>

            <!-- Grid Foto -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[24px]">
                <div class="group relative overflow-hidden rounded-[16px] bg-gray-100 dark:bg-gray-800 aspect-[4/3] shadow-sm border border-gray-100 dark:border-gray-700">
                    <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Foto Kegiatan 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <span class="text-white text-sm font-semibold">Upacara Hardiknas SMAN 2 Medan</span>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-[16px] bg-gray-100 dark:bg-gray-800 aspect-[4/3] shadow-sm border border-gray-100 dark:border-gray-700">
                    <img src="https://tse2.mm.bing.net/th/id/OIP.qZAOvySOO5XS7LYVS_uj-wHaDt?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Foto Kegiatan 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <span class="text-white text-sm font-semibold">Kegiatan Ekstrakurikuler Siswa</span>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-[16px] bg-gray-100 dark:bg-gray-800 aspect-[4/3] shadow-sm border border-gray-100 dark:border-gray-700 sm:col-span-2 md:col-span-1">
                    <img src="{{ asset('images/slide1.jpeg') }}" alt="Foto Kegiatan 3" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <span class="text-white text-sm font-semibold">Lingkungan Sekolah Asri</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION GALERI VIDEO -->
    <!-- ========================================== -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[80px] border-t border-gray-200/60 dark:border-gray-800 relative overflow-hidden">
        <span class="absolute top-[-15px] left-[20px] text-[6rem] md:text-[9rem] font-extrabold text-gray-200/50 dark:text-gray-800/60 select-none pointer-events-none z-0">
            Video
        </span>

        <div class="relative z-10 pt-[20px]">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-[36px]">
                <div>
                    <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Kanal Multimedia</span>
                    <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Galeri Video</h2>
                </div>
                <a href="{{ url('/profil/galeri-video') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline mt-[10px] sm:mt-0">
                    Lihat Semua Video &rarr;
                </a>
            </div>

            <!-- Grid Video -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-[32px]">
                
                <!-- Video Card 1 -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div class="relative w-full rounded-[12px] overflow-hidden bg-black aspect-video mb-[16px] z-10">
                        <video controls controlsList="nodownload" preload="metadata" poster="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" class="w-full h-full object-cover">
                            <source src="{{ asset('videos/contoh_video.mp4') }}" type="video/mp4">
                            Browsermu tidak mendukung pemutaran video.
                        </video>
                    </div>
                    <h3 class="text-[1.15rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[6px]">Profil Resmi SMAN 2 Medan</h3>
                    <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light">Kenali lebih dekat fasilitas, lingkungan, dan program unggulan yang ada di SMAN 2 Medan.</p>
                </div>

                <!-- Video Card 2 -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
                    <div class="relative w-full rounded-[12px] overflow-hidden bg-black aspect-video mb-[16px] z-10">
                        <video controls controlsList="nodownload" preload="metadata" poster="https://tse2.mm.bing.net/th/id/OIP.qZAOvySOO5XS7LYVS_uj-wHaDt?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" class="w-full h-full object-cover">
                            <source src="{{ asset('videos/contoh_video.mp4') }}" type="video/mp4">
                            Browsermu tidak mendukung pemutaran video.
                        </video>
                    </div>
                    <h3 class="text-[1.15rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[6px]">Pentas Seni & Kreasi Siswa SMANDA</h3>
                    <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light">Dokumentasi kemeriahan pentas seni tahunan yang menampilkan bakat luar biasa siswa-siswi.</p>
                </div>

            </div>
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
            dot.classList.add('bg-white/40', 'w-[8px]', 'rounded-full');
        });

        if(slides[currentSlideIndex]) {
            slides[currentSlideIndex].classList.remove('opacity-0');
            slides[currentSlideIndex].classList.add('active', 'opacity-100');
        }
        if(dots[currentSlideIndex]) {
            dots[currentSlideIndex].classList.remove('bg-white/40', 'w-[8px]', 'rounded-full');
            dots[currentSlideIndex].classList.add('active', 'bg-smanda-yellow', 'w-[28px]', 'rounded-[12px]');
        }
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