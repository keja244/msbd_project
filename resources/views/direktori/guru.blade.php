@extends('layouts.app')

@section('title', 'Direktori Guru Berdasarkan Jabatan - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] pb-[80px] transition-colors duration-300">

    <!-- HERO HEADER & NAVIGASI HALAMAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] pt-[20px] pb-[40px] text-center">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Direktori Akademik</span>
        <h1 class="text-[2.2rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">
            Direktori Guru <br>
            <span class="text-smanda-green">SMA Negeri 2 Medan</span>
        </h1>
    </section>

    <!-- KONTEN BERDASARKAN JABATAN -->
    <div class="max-w-[1280px] mx-auto px-[16px] sm:px-[24px] space-y-[40px]">

        <!-- 1. KEPALA SEKOLAH -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Kepala Sekolah</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide4.jpeg') }}" alt="Kepala Sekolah" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Drs. Marsito, M.Si</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Kepala SMAN 2 Medan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. HUMAS -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Humas</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide1.jpeg') }}" alt="Humas" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Dra. Hj. Siti Aminah</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Koordinator Humas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. KESISWAAN -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Kesiswaan</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide2.jpeg') }}" alt="Kesiswaan" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Budi Santoso, S.Pd</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Wakil Kesiswaan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. KURIKULUM -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Kurikulum</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide3.jpeg') }}" alt="Kurikulum" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Dr. Rina Handayani</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Bidang Kurikulum</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. SARANA & PRASARANA -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Sarana & Prasarana</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide4.jpeg') }}" alt="Sarpras" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Ahmad Fauzi, S.T</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Pengelola Sarpras</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6. PERPUSTAKAAN -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Perpustakaan</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide1.jpeg') }}" alt="Perpus" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Nurul Hidayah, S.IP</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Kepala Pustaka</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- GURU -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Guru Mata Pelajaran</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                @for ($i = 1; $i <= 5; $i++)
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide1.jpeg') }}" alt="Guru" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Guru Teladan {{ $i }}</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Bidang Studi</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- 7. TENAGA KEPENDIDIKAN -->
        <div>
            <div class="text-center mb-[20px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">Tenaga Kependidikan</h3>
            </div>
            <div class="max-w-[1200px] mx-auto flex flex-wrap justify-center gap-[16px] sm:gap-[50px]">
                <div class="w-[46%] sm:w-[240px] md:w-[260px] bg-white dark:bg-gray-800 rounded-[10px] shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 overflow-hidden p-[8px] sm:p-[12px] pb-0">
                        <img src="{{ asset('images/slide2.jpeg') }}" alt="Tata Usaha" class="w-full h-full object-cover rounded-t-[8px]">
                    </div>
                    <div class="p-[12px] sm:p-[16px]">
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white mb-[2px]">Drs. Suharmanto</h4>
                        <p class="text-[0.75rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 font-medium">Kepala Tata Usaha</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection