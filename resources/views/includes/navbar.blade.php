<!-- HEADER NAVBAR FLOATING -->
<header id="main-header" class="fixed top-0 left-0 w-full z-[2000] px-[2%] sm:px-[4%] pt-3 sm:pt-4 transition-all duration-300">
    <nav id="main-navbar" class="max-w-[1320px] mx-auto bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 flex justify-between items-center px-[20px] sm:px-[28px] h-[72px] rounded-[16px] shadow-[0_4px_20px_rgba(0,0,0,0.08)] border border-gray-100 dark:border-gray-700 transition-all duration-300">
        
        <!-- WRAPPER KIRI: Tombol Hamburger & Logo -->
        <div class="flex items-center gap-[12px]">
            <!-- Tombol Hamburger (Hanya Tampil di Mobile) -->
            <button id="mobile-menu-btn" class="xl:hidden text-gray-800 dark:text-gray-200 p-[8px] -ml-[8px] focus:outline-none" aria-label="Open Navigation">
                <svg class="w-[28px] h-[28px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Logo & Nama Sekolah -->
            <a href="{{ url('/') }}" class="flex items-center gap-[10px] sm:gap-[12px] no-underline">
                <img id="nav-logo" src="{{ asset('images/logo_smandu.png') }}" alt="Logo SMAN 2 Medan" class="w-[38px] h-[38px] sm:w-[42px] sm:h-[42px] object-contain transition-all duration-300">
                <div class="flex flex-col">
                    <span id="nav-title" class="text-[0.95rem] sm:text-[1.05rem] font-extrabold text-gray-900 dark:text-white leading-tight transition-all duration-300">SMAN 2 MEDAN</span>
                    <span id="nav-subtitle" class="text-[0.68rem] sm:text-[0.72rem] text-gray-500 dark:text-gray-400 font-medium tracking-wide transition-all duration-300">Smandu Hebat</span>
                </div>
            </a>
        </div>

        <!-- DAFTAR MENU DESKTOP & TOMBOL SWITCH -->
        <div class="flex items-center gap-[12px] h-full">
            <ul class="hidden xl:flex list-none h-full m-0 p-0 items-center gap-[2px] z-[1900]">
                
                <!-- Beranda -->
                <li class="h-full flex items-center">
                    <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Beranda</a>
                </li>

                <!-- Profil -->
                <li class="relative h-full flex items-center group">
                    <a href="#" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center gap-[4px] group-hover:text-smanda-green dark:group-hover:text-smanda-yellow">Profil ▾</a>
                    <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-[12px] min-w-[200px] opacity-0 invisible translate-y-[10px] group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border-t-[4px] border-smanda-green border-x border-b border-gray-100 dark:border-gray-700 p-0 m-0 list-none overflow-hidden">
                        <li><a href="{{ url('/profil/tentang') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Tentang Sekolah</a></li>
                        <li><a href="{{ url('/profil/kepala-sekolah') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Kepala Sekolah</a></li>
                        <li><a href="{{ url('/profil/sarpras') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Sarana & Prasarana</a></li>
                        <li><a href="{{ url('/profil/osis') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">OSIS</a></li>
                        <li><a href="{{ url('/profil/galeri-video') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Galeri Foto & Video</a></li>
                    </ul>
                </li>

                <!-- ekstrakurikuler Mega Menu -->
                <li class="relative h-full flex items-center group">
                    <a href="#" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center gap-[4px] group-hover:text-smanda-green dark:group-hover:text-smanda-yellow">Ekstrakurikuler ▾</a>
                    <div class="absolute top-full -left-[100px] bg-white dark:bg-gray-800 shadow-xl rounded-[16px] w-[680px] opacity-0 invisible translate-y-[10px] group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border-t-[4px] border-smanda-green border-x border-b border-gray-100 dark:border-gray-700 p-[24px]">
                        <div class="grid grid-cols-4 gap-[20px]">
                            <div>
                                <span class="text-[0.75rem] font-extrabold uppercase text-smanda-green block mb-[8px] pb-[4px] border-b dark:border-gray-700">Keterampilan</span>
                                <ul class="list-none p-0 m-0 space-y-[4px] text-[0.85rem] text-gray-600 dark:text-gray-300">
                                    <li><a href="{{ url('/ekskul/paskibra') }}" class="hover:text-smanda-green block">Paskibra</a></li>
                                    <li><a href="{{ url('/ekskul/pramuka') }}" class="hover:text-smanda-green block">Pramuka</a></li>
                                    <li><a href="{{ url('/ekskul/pmr') }}" class="hover:text-smanda-green block">PMR</a></li>
                                    <li><a href="{{ url('/ekskul/pks') }}" class="hover:text-smanda-green block">PKS</a></li>
                                    <li><a href="{{ url('/ekskul/pencinta-alam') }}" class="hover:text-smanda-green block">Pencinta Alam</a></li>
                                    <li><a href="{{ url('/ekskul/kopsis') }}" class="hover:text-smanda-green block">Koperasi Siswa</a></li>
                                </ul>
                            </div>
                            <div>
                                <span class="text-[0.75rem] font-extrabold uppercase text-smanda-yellow-hover block mb-[8px] pb-[4px] border-b dark:border-gray-700">Olahraga</span>
                                <ul class="list-none p-0 m-0 space-y-[4px] text-[0.85rem] text-gray-600 dark:text-gray-300">
                                    <li><a href="{{ url('/ekskul/basket') }}" class="hover:text-smanda-green block">Basket</a></li>
                                    <li><a href="{{ url('/ekskul/futsal') }}" class="hover:text-smanda-green block">Futsal / Sepak Bola</a></li>
                                    <li><a href="{{ url('/ekskul/voli') }}" class="hover:text-smanda-green block">Voli</a></li>
                                    <li><a href="{{ url('/ekskul/bulutangkis') }}" class="hover:text-smanda-green block">Bulu Tangkis</a></li>
                                    <li><a href="{{ url('/ekskul/taekwondo') }}" class="hover:text-smanda-green block">Taekwondo</a></li>
                                    <li><a href="{{ url('/ekskul/pencak-silat') }}" class="hover:text-smanda-green block">Pencak Silat</a></li>
                                    <li><a href="{{ url('/ekskul/catur') }}" class="hover:text-smanda-green block">Catur</a></li>
                                </ul>
                            </div>
                            <div>
                                <span class="text-[0.75rem] font-extrabold uppercase text-smanda-red block mb-[8px] pb-[4px] border-b dark:border-gray-700">Seni & Budaya</span>
                                <ul class="list-none p-0 m-0 space-y-[4px] text-[0.85rem] text-gray-600 dark:text-gray-300">
                                    <li><a href="{{ url('/ekskul/paduan-suara') }}" class="hover:text-smanda-green block">Paduan Suara</a></li>
                                    <li><a href="{{ url('/ekskul/marching-band') }}" class="hover:text-smanda-green block">Marching Band</a></li>
                                    <li><a href="{{ url('/ekskul/tari-tradisional') }}" class="hover:text-smanda-green block">Tari Tradisional</a></li>
                                    <li><a href="{{ url('/ekskul/teater') }}" class="hover:text-smanda-green block">Teater & Sastra</a></li>
                                    <li><a href="{{ url('/ekskul/fotografi') }}" class="hover:text-smanda-green block">Fotografi & Jurnalistik</a></li>
                                    <li><a href="{{ url('/ekskul/seni-rupa') }}" class="hover:text-smanda-green block">Seni Rupa & Lukis</a></li>
                                </ul>
                            </div>
                            <div>
                                <span class="text-[0.75rem] font-extrabold uppercase text-smanda-blue block mb-[8px] pb-[4px] border-b dark:border-gray-700">Akademik & Agama</span>
                                <ul class="list-none p-0 m-0 space-y-[4px] text-[0.85rem] text-gray-600 dark:text-gray-300">
                                    <li><a href="{{ url('/ekskul/rohkris') }}" class="hover:text-smanda-green block">Rohkris</a></li>
                                    <li><a href="{{ url('/ekskul/rohis') }}" class="hover:text-smanda-green block">Rohis / BDI</a></li>
                                    <li><a href="{{ url('/ekskul/kir') }}" class="hover:text-smanda-green block">KIR (Karya Ilmiah Remaja)</a></li>
                                    <li><a href="{{ url('/ekskul/english-club') }}" class="hover:text-smanda-green block">English Club</a></li>
                                    <li><a href="{{ url('/ekskul/komputer') }}" class="hover:text-smanda-green block">IT & Robotik</a></li>
                                    <li><a href="{{ url('/ekskul/japan-club') }}" class="hover:text-smanda-green block">Japan Club</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-[16px] pt-[12px] border-t border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/50 -mx-[24px] -mb-[24px] p-[12px_24px] rounded-b-[16px]">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total 25+ ekstrakurikuler Aktif</span>
                            <a href="{{ url('/ekstrakurikuler') }}" class="text-xs font-bold text-smanda-green hover:underline">
                                Lihat Direktori Lengkap &rarr;
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Akademik -->
                <li class="relative h-full flex items-center group">
                    <a href="#" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center gap-[4px] group-hover:text-smanda-green dark:group-hover:text-smanda-yellow">Akademik ▾</a>
                    <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-[12px] min-w-[200px] opacity-0 invisible translate-y-[10px] group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border-t-[4px] border-smanda-green border-x border-b border-gray-100 dark:border-gray-700 p-0 m-0 list-none overflow-hidden">
                        <li><a href="{{ url('/akademik/silabus') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Rencana Pembelajaran Mendalam</a></li>
                        <li><a href="{{ url('/akademik/kalender') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Kalender</a></li>
                        <li><a href="{{ url('/akademik/prestasi') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Prestasi</a></li>
                    </ul>
                </li>

                <!-- Informasi -->
                <li class="relative h-full flex items-center group">
                    <a href="#" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center gap-[4px] group-hover:text-smanda-green dark:group-hover:text-smanda-yellow">Informasi ▾</a>
                    <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-[12px] min-w-[200px] opacity-0 invisible translate-y-[10px] group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border-t-[4px] border-smanda-green border-x border-b border-gray-100 dark:border-gray-700 p-0 m-0 list-none overflow-hidden">
                        <li><a href="{{ url('/akademik/artikel') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Artikel</a></li>
                        <li><a href="{{ url('/akademik/berita') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Berita</a></li>
                    </ul>
                </li>

                <!-- Direktori -->
                <li class="relative h-full flex items-center group">
                    <a href="#" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center gap-[4px] group-hover:text-smanda-green dark:group-hover:text-smanda-yellow">Direktori ▾</a>
                    <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-[12px] min-w-[200px] opacity-0 invisible translate-y-[10px] group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border-t-[4px] border-smanda-green border-x border-b border-gray-100 dark:border-gray-700 p-0 m-0 list-none overflow-hidden">
                        <li><a href="{{ url('/direktori/siswa') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Siswa</a></li>
                        <li><a href="{{ url('/direktori/guru') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Guru dan Pegawai</a></li>
                        <li><a href="{{ url('/direktori/alumni') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">Alumni</a></li>
                    </ul>
                </li>

                <!-- SPMB / PPDB & Kelulusan -->
                <li class="relative h-full flex items-center group">
                    <a href="{{ url('/spmb') }}" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center gap-[4px] group-hover:text-smanda-green dark:group-hover:text-smanda-yellow">
                        SPMB ▾
                    </a>
                    <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-[12px] min-w-[210px] opacity-0 invisible translate-y-[10px] group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border-t-[4px] border-smanda-green border-x border-b border-gray-100 dark:border-gray-700 p-0 m-0 list-none overflow-hidden">
                        <li>
                            <a href="{{ url('/spmb') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">
                                Penerimaan Siswa Baru
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/kelulusan') }}" class="block py-[10px] px-[20px] text-gray-700 dark:text-gray-200 text-[0.88rem] hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-smanda-green">
                                Pengumuman Kelulusan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Kontak -->
                <li class="h-full flex items-center">
                    <a href="{{ url('/kontak') }}" class="text-gray-700 dark:text-gray-200 font-semibold text-[0.9rem] px-[12px] h-full flex items-center hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Kontak</a>
                </li>
            </ul>

            <!-- TOMBOL SWITCH MODE -->
            <button id="mode-switch-btn" class="p-[8px] rounded-[10px] bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors focus:outline-none ml-[4px]" aria-label="Switch Mode">
                <svg id="icon-sun" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <svg id="icon-moon" class="w-[18px] h-[18px] hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
        </div>
    </nav>
</header>

<!-- ========================================== -->
<!-- MOBILE SIDE DRAWER -->
<!-- ========================================== -->

<!-- Overlay Background Gelap Transparan -->
<div id="drawer-overlay" class="fixed inset-0 bg-black/50 z-[2900] opacity-0 pointer-events-none transition-opacity duration-300 xl:hidden"></div>

<!-- Panel Sidebar Mobile -->
<aside id="mobile-drawer" class="fixed top-0 left-0 w-[85%] max-w-[340px] h-full bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 z-[3000] shadow-2xl -translate-x-full transition-transform duration-300 ease-in-out flex flex-col xl:hidden overflow-hidden">
    
    <!-- Drawer Header -->
    <div class="p-[20px] border-b dark:border-gray-800 flex items-center justify-between bg-gray-50 dark:bg-gray-800">
        <div class="flex items-center gap-[10px]">
            <img src="{{ asset('images/logo_smandu.png') }}" class="w-[32px] h-[32px]" alt="Logo">
            <span class="font-extrabold text-[0.95rem] text-gray-900 dark:text-white">MENU SMAN 2</span>
        </div>
        <button id="close-drawer-btn" class="p-[6px] text-gray-500 dark:text-gray-400 hover:text-red-500">
            <svg class="w-[24px] h-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Drawer Content (Slider Multi-Level) -->
    <div class="relative flex-1 overflow-hidden">
        
        <!-- LEVEL 1: MENU UTAMA MOBILE -->
        <div id="drawer-level-1" class="w-full h-full p-[20px] overflow-y-auto transition-transform duration-300">
            <ul class="list-none p-0 m-0 space-y-[10px]">
                <li><a href="{{ url('/') }}" class="block py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green">Beranda</a></li>
                
                <li>
                    <button onclick="openSubmenu('sub-profil')" class="w-full flex items-center justify-between py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green text-left">
                        Profil <span class="text-xs text-gray-400">&rarr;</span>
                    </button>
                </li>
                <li>
                    <button onclick="openSubmenu('sub-ekskul')" class="w-full flex items-center justify-between py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green text-left">
                        Ekstrakurikuler <span class="text-xs text-gray-400">&rarr;</span>
                    </button>
                </li>
                <li>
                    <button onclick="openSubmenu('sub-akademik')" class="w-full flex items-center justify-between py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green text-left">
                        Akademik <span class="text-xs text-gray-400">&rarr;</span>
                    </button>
                </li>
                <li>
                    <button onclick="openSubmenu('sub-informasi')" class="w-full flex items-center justify-between py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green text-left">
                        Informasi <span class="text-xs text-gray-400">&rarr;</span>
                    </button>
                </li>
                <li>
                    <button onclick="openSubmenu('sub-direktori')" class="w-full flex items-center justify-between py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green text-left">
                        Direktori <span class="text-xs text-gray-400">&rarr;</span>
                    </button>
                </li>
                <li>
                    <button onclick="openSubmenu('sub-spmb')" class="w-full flex items-center justify-between py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green text-left">
                        SPMB & Kelulusan <span class="text-xs text-gray-400">&rarr;</span>
                    </button>
                </li>

                <li><a href="{{ url('/kontak') }}" class="block py-[8px] font-semibold text-gray-700 dark:text-gray-200 hover:text-smanda-green">Kontak</a></li>
            </ul>
        </div>

        <!-- LEVEL 2 SUBMENUS -->
        <div id="sub-profil" class="absolute top-0 left-0 w-full h-full bg-white dark:bg-gray-900 p-[20px] overflow-y-auto translate-x-full transition-transform duration-300">
            <button onclick="closeSubmenu('sub-profil')" class="flex items-center gap-[6px] text-xs font-bold text-smanda-green uppercase mb-[16px] pb-[8px] border-b dark:border-gray-800 w-full">
                &larr; Kembali ke Menu Utama
            </button>
            <h4 class="font-extrabold text-[1rem] text-gray-800 dark:text-gray-200 mb-[12px]">Profil Sekolah</h4>
            <ul class="list-none p-0 m-0 space-y-[10px] text-[0.9rem]">
                <li><a href="{{ url('/profil/tentang') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Tentang Sekolah</a></li>
                <li><a href="{{ url('/profil/kepala-sekolah') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Kepala Sekolah</a></li>
                <li><a href="{{ url('/profil/sarpras') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Sarana & Prasarana</a></li>
                <li><a href="{{ url('/profil/osis') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">OSIS</a></li>
                <li><a href="{{ url('/profil/galeri-video') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Galeri Video</a></li>
            </ul>
        </div>

        <div id="sub-ekskul" class="absolute top-0 left-0 w-full h-full bg-white dark:bg-gray-900 p-[20px] overflow-y-auto translate-x-full transition-transform duration-300">
            <button onclick="closeSubmenu('sub-ekskul')" class="flex items-center gap-[6px] text-xs font-bold text-smanda-green uppercase mb-[16px] pb-[8px] border-b dark:border-gray-800 w-full">
                &larr; Kembali ke Menu Utama
            </button>
            <h4 class="font-extrabold text-[1rem] text-gray-800 dark:text-gray-200 mb-[16px]">Daftar ekstrakurikuler</h4>
            <div class="space-y-[16px]">
                <div>
                    <span class="text-[0.75rem] font-bold uppercase text-smanda-green block mb-[6px]">Keterampilan</span>
                    <ul class="list-none p-0 m-0 space-y-[6px] text-[0.88rem] pl-[10px]">
                        <li><a href="{{ url('/ekskul/paskibra') }}" class="text-gray-600 dark:text-gray-300 block">Paskibra</a></li>
                        <li><a href="{{ url('/ekskul/pramuka') }}" class="text-gray-600 dark:text-gray-300 block">Pramuka</a></li>
                        <li><a href="{{ url('/ekskul/pmr') }}" class="text-gray-600 dark:text-gray-300 block">PMR</a></li>
                        <li><a href="{{ url('/ekskul/pks') }}" class="text-gray-600 dark:text-gray-300 block">PKS</a></li>
                        <li><a href="{{ url('/ekskul/pencinta-alam') }}" class="text-gray-600 dark:text-gray-300 block">Pencinta Alam</a></li>
                        <li><a href="{{ url('/ekskul/kopsis') }}" class="text-gray-600 dark:text-gray-300 block">Koperasi Siswa</a></li>
                    </ul>
                </div>
                <div>
                    <span class="text-[0.75rem] font-bold uppercase text-smanda-yellow-hover block mb-[6px]">Olahraga</span>
                    <ul class="list-none p-0 m-0 space-y-[6px] text-[0.88rem] pl-[10px]">
                        <li><a href="{{ url('/ekskul/basket') }}" class="text-gray-600 dark:text-gray-300 block">Basket</a></li>
                        <li><a href="{{ url('/ekskul/futsal') }}" class="text-gray-600 dark:text-gray-300 block">Futsal / Sepak Bola</a></li>
                        <li><a href="{{ url('/ekskul/voli') }}" class="text-gray-600 dark:text-gray-300 block">Voli</a></li>
                        <li><a href="{{ url('/ekskul/bulutangkis') }}" class="text-gray-600 dark:text-gray-300 block">Bulu Tangkis</a></li>
                        <li><a href="{{ url('/ekskul/taekwondo') }}" class="text-gray-600 dark:text-gray-300 block">Taekwondo</a></li>
                        <li><a href="{{ url('/ekskul/pencak-silat') }}" class="text-gray-600 dark:text-gray-300 block">Pencak Silat</a></li>
                        <li><a href="{{ url('/ekskul/catur') }}" class="text-gray-600 dark:text-gray-300 block">Catur</a></li>
                    </ul>
                </div>
                <div>
                    <span class="text-[0.75rem] font-bold uppercase text-smanda-red block mb-[6px]">Seni & Budaya</span>
                    <ul class="list-none p-0 m-0 space-y-[6px] text-[0.88rem] pl-[10px]">
                        <li><a href="{{ url('/ekskul/paduan-suara') }}" class="text-gray-600 dark:text-gray-300 block">Paduan Suara</a></li>
                        <li><a href="{{ url('/ekskul/marching-band') }}" class="text-gray-600 dark:text-gray-300 block">Marching Band</a></li>
                        <li><a href="{{ url('/ekskul/tari-tradisional') }}" class="text-gray-600 dark:text-gray-300 block">Tari Tradisional</a></li>
                        <li><a href="{{ url('/ekskul/teater') }}" class="text-gray-600 dark:text-gray-300 block">Teater & Sastra</a></li>
                        <li><a href="{{ url('/ekskul/fotografi') }}" class="text-gray-600 dark:text-gray-300 block">Fotografi & Jurnalistik</a></li>
                        <li><a href="{{ url('/ekskul/seni-rupa') }}" class="text-gray-600 dark:text-gray-300 block">Seni Rupa & Lukis</a></li>
                    </ul>
                </div>
                <div>
                    <span class="text-[0.75rem] font-bold uppercase text-smanda-blue block mb-[6px]">Akademik & Agama</span>
                    <ul class="list-none p-0 m-0 space-y-[6px] text-[0.88rem] pl-[10px]">
                        <li><a href="{{ url('/ekskul/rohkris') }}" class="text-gray-600 dark:text-gray-300 block">Rohkris</a></li>
                        <li><a href="{{ url('/ekskul/rohis') }}" class="text-gray-600 dark:text-gray-300 block">Rohis / BDI</a></li>
                        <li><a href="{{ url('/ekskul/kir') }}" class="text-gray-600 dark:text-gray-300 block">KIR (Karya Ilmiah Remaja)</a></li>
                        <li><a href="{{ url('/ekskul/english-club') }}" class="text-gray-600 dark:text-gray-300 block">English Club</a></li>
                        <li><a href="{{ url('/ekskul/komputer') }}" class="text-gray-600 dark:text-gray-300 block">IT & Robotik</a></li>
                        <li><a href="{{ url('/ekskul/japan-club') }}" class="text-gray-600 dark:text-gray-300 block">Japan Club</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="sub-akademik" class="absolute top-0 left-0 w-full h-full bg-white dark:bg-gray-900 p-[20px] overflow-y-auto translate-x-full transition-transform duration-300">
            <button onclick="closeSubmenu('sub-akademik')" class="flex items-center gap-[6px] text-xs font-bold text-smanda-green uppercase mb-[16px] pb-[8px] border-b dark:border-gray-800 w-full">
                &larr; Kembali ke Menu Utama
            </button>
            <h4 class="font-extrabold text-[1rem] text-gray-800 dark:text-gray-200 mb-[12px]">Akademik</h4>
            <ul class="list-none p-0 m-0 space-y-[10px] text-[0.9rem]">
                <li><a href="{{ url('/akademik/silabus') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Silabus</a></li>
                <li><a href="{{ url('/akademik/kalender') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Kalender</a></li>
                <li><a href="{{ url('/akademik/prestasi') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Prestasi</a></li>
            </ul>
        </div>

        <div id="sub-informasi" class="absolute top-0 left-0 w-full h-full bg-white dark:bg-gray-900 p-[20px] overflow-y-auto translate-x-full transition-transform duration-300">
            <button onclick="closeSubmenu('sub-informasi')" class="flex items-center gap-[6px] text-xs font-bold text-smanda-green uppercase mb-[16px] pb-[8px] border-b dark:border-gray-800 w-full">
                &larr; Kembali ke Menu Utama
            </button>
            <h4 class="font-extrabold text-[1rem] text-gray-800 dark:text-gray-200 mb-[12px]">Pusat Informasi</h4>
            <ul class="list-none p-0 m-0 space-y-[10px] text-[0.9rem]">
                <li><a href="{{ url('/akademik/artikel') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Artikel</a></li>
                <li><a href="{{ url('/akademik/berita') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Berita</a></li>
            </ul>
        </div>

        <div id="sub-direktori" class="absolute top-0 left-0 w-full h-full bg-white dark:bg-gray-900 p-[20px] overflow-y-auto translate-x-full transition-transform duration-300">
            <button onclick="closeSubmenu('sub-direktori')" class="flex items-center gap-[6px] text-xs font-bold text-smanda-green uppercase mb-[16px] pb-[8px] border-b dark:border-gray-800 w-full">
                &larr; Kembali ke Menu Utama
            </button>
            <h4 class="font-extrabold text-[1rem] text-gray-800 dark:text-gray-200 mb-[12px]">Direktori Sekolah</h4>
            <ul class="list-none p-0 m-0 space-y-[10px] text-[0.9rem]">
                <li><a href="{{ url('/direktori/siswa') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Siswa</a></li>
                <li><a href="{{ url('/direktori/guru') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Guru dan Pegawai</a></li>
                <li><a href="{{ url('/direktori/alumni') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Alumni</a></li>
            </ul>
        </div>

        <div id="sub-spmb" class="absolute top-0 left-0 w-full h-full bg-white dark:bg-gray-900 p-[20px] overflow-y-auto translate-x-full transition-transform duration-300">
            <button onclick="closeSubmenu('sub-spmb')" class="flex items-center gap-[6px] text-xs font-bold text-smanda-green uppercase mb-[16px] pb-[8px] border-b dark:border-gray-800 w-full">
                &larr; Kembali ke Menu Utama
            </button>
            <h4 class="font-extrabold text-[1rem] text-gray-800 dark:text-gray-200 mb-[12px]">SPMB & Kelulusan</h4>
            <ul class="list-none p-0 m-0 space-y-[10px] text-[0.9rem]">
                <li><a href="{{ url('/spmb') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Penerimaan Siswa Baru</a></li>
                <li><a href="{{ url('/kelulusan') }}" class="block py-[4px] text-gray-600 dark:text-gray-300 hover:text-smanda-green">Pengumuman Kelulusan</a></li>
            </ul>
        </div>

    </div>
</aside>
