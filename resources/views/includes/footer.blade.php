<!-- FOOTER UTAMA -->
<footer class="bg-white dark:bg-gray-800 border-t border-gray-200/80 dark:border-gray-700 text-[#4a5568] dark:text-gray-300 font-sans transition-colors duration-300">
    <div class="max-w-[1280px] mx-auto px-[24px] pt-[60px] pb-[40px]">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-[40px]">
            
            <!-- KOLOM 1: LOGO & DESKRIPSI SINGKAT (4 Kolom) -->
            <div class="lg:col-span-4 flex flex-col justify-between">
                <div>
                    <a href="{{ url('/') }}" class="flex items-center gap-[12px] mb-[16px] no-underline">
                        <img src="{{ asset('images/logo_smandu.png') }}" alt="Logo SMAN 2 Medan" class="w-[48px] h-[48px] object-contain">
                        <div class="flex flex-col">
                            <span class="text-[1.15rem] font-extrabold text-[#4a5568] dark:text-white leading-tight">SMAN 2 MEDAN</span>
                            <span class="text-[0.75rem] text-smanda-green font-bold tracking-wider uppercase">Smandu Hebat</span>
                        </div>
                    </a>
                    <p class="text-[0.92rem] leading-[1.7] text-[#718096] dark:text-gray-400 font-light mb-[20px]">
                        Mewujudkan Lulusan Terdidik dan Kompeten, Berjiwa Besar, Berdaya Saing, Demi Kesejahteraan dan Memajukan Bangsa dan Negara.
                    </p>
                </div>

                <!-- Ikon Media Sosial -->
                <div class="flex items-center gap-[10px] pt-[10px]">
                    <a href="#" aria-label="Facebook" class="w-[36px] h-[36px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 flex items-center justify-center transition-all duration-300 hover:bg-smanda-green hover:text-white">
                        <svg class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" aria-label="Twitter" class="w-[36px] h-[36px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 flex items-center justify-center transition-all duration-300 hover:bg-smanda-green hover:text-white">
                        <svg class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/watch?v=RJ8qDfJWiak" target="_blank" aria-label="YouTube" class="w-[36px] h-[36px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 flex items-center justify-center transition-all duration-300 hover:bg-smanda-red hover:text-white">
                        <svg class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="w-[36px] h-[36px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 flex items-center justify-center transition-all duration-300 hover:bg-smanda-yellow hover:text-smanda-dark">
                        <svg class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <!-- KOLOM 2: TAUTAN PROFIL & AKADEMIK (2 Kolom) -->
            <div class="lg:col-span-2">
                <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#4a5568] dark:text-gray-200 block mb-[16px]">Jelajah</span>
                <ul class="list-none p-0 m-0 space-y-[10px] text-[0.88rem]">
                    <li><a href="{{ url('/profil/tentang') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Profil Sekolah</a></li>
                    <li><a href="{{ url('/profil/kepala-sekolah') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Kepala Sekolah</a></li>
                    <li><a href="{{ url('/akademik/silabus') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Akademik</a></li>
                    <li><a href="{{ url('/direktori/siswa') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Direktori Siswa</a></li>
                    <li><a href="{{ url('/direktori/guru') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Guru & Pegawai</a></li>
                    <li><a href="{{ url('/direktori/alumni') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Alumni</a></li>
                </ul>
            </div>

            <!-- KOLOM 3: INFORMASI & EKSKUL (2 Kolom) -->
            <div class="lg:col-span-2">
                <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#4a5568] dark:text-gray-200 block mb-[16px]">Informasi</span>
                <ul class="list-none p-0 m-0 space-y-[10px] text-[0.88rem]">
                    <li><a href="{{ url('/akademik/berita') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Berita Terkini</a></li>
                    <li><a href="{{ url('/akademik/artikel') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Artikel Edukasi</a></li>
                    <li><a href="{{ url('/akademik/prestasi') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Prestasi Siswa</a></li>
                    <li><a href="{{ url('/ekstrakurikuler') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">ekstrakurikuler</a></li>
                    <li><a href="{{ url('/spmb') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">PPDB / SPMB</a></li>
                    <li><a href="{{ url('/kelulusan') }}" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">Info Kelulusan</a></li>
                </ul>
            </div>

            <!-- KOLOM 4: KONTAK & AKSES LOGIN (4 Kolom) -->
            <div class="lg:col-span-4">
                <span class="text-xs font-bold tracking-[1.5px] uppercase text-[#4a5568] dark:text-gray-200 block mb-[16px]">Hubungi & Akses</span>
                <ul class="list-none p-0 m-0 space-y-[12px] text-[0.88rem] mb-[20px]">
                    <li class="flex items-start gap-[10px]">
                        <svg class="w-[18px] h-[18px] text-smanda-green shrink-0 mt-[2px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Jl. Karang Sari No. 435 Medan Polonia, Sumatera Utara</span>
                    </li>
                    <li class="flex items-center gap-[10px]">
                        <svg class="w-[18px] h-[18px] text-smanda-green shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>061 - 7862140</span>
                    </li>
                    <li class="flex items-center gap-[10px]">
                        <svg class="w-[18px] h-[18px] text-smanda-green shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:info@sman2medan.sch.id" class="hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors">info@sman2medan.sch.id</a>
                    </li>
                </ul>

                <!-- TOMBOL LOGIN DI FOOTER -->
                <div>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-[8px] bg-smanda-green hover:bg-smanda-green-dark text-white px-[20px] py-[10px] rounded-[10px] font-semibold text-[0.9rem] transition-all duration-300 shadow-sm w-full sm:w-auto">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Login Sistem / Dashboard</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- COPYRIGHT BOTTOM BAR -->
        <div class="mt-[50px] pt-[24px] border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500 dark:text-gray-400 gap-[10px]">
            <p>&copy; {{ date('Y') }} SMA Negeri 2 Medan. All Rights Reserved.</p>
            <p class="text-right">Dikembangkan untuk SMAN 2 Medan</p>
        </div>

    </div>
</footer>