@extends('layouts.app')

@section('title', ucfirst(str_replace('-', ' ', $nama)) . ' - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] pb-[80px] transition-colors duration-300">

    <!-- HERO HEADER DETAIL EKSKUL -->
    <section class="max-w-[1280px] mx-auto px-[16px] sm:px-[24px] pt-[20px] pb-[40px]">
        
        <!-- Tombol Kembali -->
        <div class="mb-[24px]">
            <a href="{{ url('/ekstrakurikuler#ekskul') }}" class="inline-flex items-center gap-[8px] text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline">
                &larr; Kembali ke Daftar Ekstrakurikuler
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[48px] border border-gray-100 dark:border-gray-700 shadow-sm grid grid-cols-1 lg:grid-cols-12 gap-[30px] sm:gap-[40px] items-center">
            
            <!-- Foto / Dokumentasi Utama Ekskul -->
            <div class="lg:col-span-5">
                <div class="w-full aspect-[4/3] bg-gray-200 dark:bg-gray-900 rounded-[16px] overflow-hidden shadow-inner border border-gray-100 dark:border-gray-700">
                    <img src="{{ asset('images/slide1.jpeg') }}" alt="Dokumentasi Ekstrakurikuler" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Informasi Singkat -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <span class="inline-block bg-emerald-100 dark:bg-emerald-900/40 text-smanda-green dark:text-emerald-300 text-xs font-bold px-3 py-1 rounded-full w-max mb-[12px] uppercase">
                    Ekstrakurikuler Resmi SMAN 2 Medan
                </span>
                <h1 class="text-[1.8rem] sm:text-[2.5rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[16px] capitalize">
                    {{ str_replace('-', ' ', $nama) }}
                </h1>
                <p class="text-[0.9rem] sm:text-[1rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify">
                    Ekstrakurikuler ini merupakan salah satu wadah pembinaan kesiswaan unggulan di SMAN 2 Medan yang berfokus pada penggalian potensi, pengembangan keterampilan khusus, pembentukan disiplin, serta penciptaan prestasi gemilang di tingkat regional maupun nasional.
                </p>
            </div>

        </div>
    </section>

    <!-- SECTION DESKRIPSI LENGKAP & INFORMASI TAMBAHAN -->
    <section class="max-w-[1280px] mx-auto px-[16px] sm:px-[24px] pt-[10px] pb-[40px]">
        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-[30px] sm:gap-[40px]">
            
            <!-- Kolom Kiri Utama (Tentang & Prestasi) -->
            <div class="lg:col-span-2 space-y-[30px] order-1">
                
                <!-- Tentang Kegiatan -->
                <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[32px] border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-[1.2rem] sm:text-[1.4rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[16px] border-b-2 border-smanda-green pb-2 inline-block">
                        Tentang Kegiatan
                    </h3>
                    <p class="text-[0.9rem] sm:text-[0.95rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[16px]">
                        Melalui program latihan yang terstruktur dan didukung oleh fasilitas sekolah yang memadai, seluruh anggota aktif dibimbing secara intensif untuk menguasai teknik dasar hingga tingkat lanjut. Selain aspek teknis, organisasi ini juga sangat menjunjung tinggi nilai-nilai solidaritas, sportivitas, dan tanggung jawab moral.
                    </p>
                    <p class="text-[0.9rem] sm:text-[0.95rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify">
                        Program kerja tahunan mencakup latihan rutin mingguan, uji coba tanding (*sparring*), *workshop* bersama alumni/praktisi, serta keikutsertaan dalam berbagai kejuaraan eksternal atas nama almamater SMAN 2 Medan.
                    </p>
                </div>

                <!-- Prestasi & Penghargaan -->
                <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[32px] border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-[1.2rem] sm:text-[1.4rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[16px] border-b-2 border-smanda-green pb-2 inline-block">
                        Prestasi & Penghargaan
                    </h3>
                    <ul class="space-y-[12px] text-[0.9rem] sm:text-[0.95rem] text-[#718096] dark:text-gray-300">
                        <li class="flex items-start gap-[10px]">
                            <span class="text-smanda-green font-bold">&bull;</span>
                            <span>Juara Umum / Juara 1 Tingkat Kota Medan (2025)</span>
                        </li>
                        <li class="flex items-start gap-[10px]">
                            <span class="text-smanda-green font-bold">&bull;</span>
                            <span>Peserta Terbaik Seleksi Tingkat Provinsi Sumatera Utara</span>
                        </li>
                        <li class="flex items-start gap-[10px]">
                            <span class="text-smanda-green font-bold">&bull;</span>
                            <span>Penghargaan Tim Terfavorit dalam Pameran Aksi Kreatif Siswa</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Kolom Kanan (Persyaratan & Narahubung) -->
            <div class="lg:col-span-1 space-y-[30px] order-2">
                
                <!-- Persyaratan & Ketentuan Anggota -->
                <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[32px] border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-[1.1rem] sm:text-[1.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[12px] border-b border-gray-100 dark:border-gray-700 pb-2">
                        Persyaratan Anggota
                    </h3>
                    <ul class="space-y-[10px] text-[0.88rem] text-[#718096] dark:text-gray-300">
                        <li class="flex items-start gap-[8px]">
                            <span class="text-smanda-green font-bold">&bull;</span>
                            <span>Siswa/siswi aktif kelas X atau XI SMAN 2 Medan.</span>
                        </li>
                        <li class="flex items-start gap-[8px]">
                            <span class="text-smanda-green font-bold">&bull;</span>
                            <span>Memiliki komitmen dan izin orang tua/wali.</span>
                        </li>
                        <li class="flex items-start gap-[8px]">
                            <span class="text-smanda-green font-bold">&bull;</span>
                            <span>Mengikuti seleksi atau orientasi awal.</span>
                        </li>
                    </ul>
                </div>

                <!-- Narahubung Pengurus -->
                <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[32px] border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-[1.1rem] sm:text-[1.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[12px] border-b border-gray-100 dark:border-gray-700 pb-2">
                        Narahubung Pengurus
                    </h3>
                    <p class="text-[0.88rem] text-[#718096] dark:text-gray-400 leading-[1.6] mb-[16px]">
                        Informasi lebih lanjut dapat menghubungi pengurus atau pembina terkait.
                    </p>
                    <div class="space-y-2 text-[0.88rem]">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Ketua Ekskul:</span>
                            <span class="font-bold text-gray-700 dark:text-gray-200">Perwakilan Siswa</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Pembina:</span>
                            <span class="font-bold text-gray-700 dark:text-gray-200">Tim Guru SMAN 2</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-3 order-3 bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[32px] border border-gray-100 dark:border-gray-700 shadow-sm" x-data="{ activePage: 1 }">
                
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-[16px] border-b-2 border-smanda-green pb-2">
                    <h3 class="text-[1.2rem] sm:text-[1.4rem] font-extrabold text-[#4a5568] dark:text-gray-100">
                        Dokumentasi & Galeri Pendukung
                    </h3>
                    <span class="text-xs font-semibold text-gray-400 mt-1 sm:mt-0">Halaman <span x-text="activePage"></span> dari 3</span>
                </div>

                <p class="text-[0.9rem] sm:text-[0.95rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[20px]">
                    Berikut adalah cuplikan dokumentasi kegiatan dan suasana latihan rutin yang dilaksanakan di lingkungan sekolah.
                </p>

                <!-- Grid 3 Item -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-[16px] mb-[24px]">
                    <div class="bg-gray-100 dark:bg-gray-900 rounded-xl overflow-hidden aspect-[4/3] border border-gray-200 dark:border-gray-700 shadow-sm">
                        <img src="{{ asset('images/slide1.jpeg') }}" alt="Galeri Dokumentasi 1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-900 rounded-xl overflow-hidden aspect-[4/3] border border-gray-200 dark:border-gray-700 shadow-sm">
                        <img src="{{ asset('images/slide1.jpeg') }}" alt="Galeri Dokumentasi 2" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-900 rounded-xl overflow-hidden aspect-[4/3] border border-gray-200 dark:border-gray-700 shadow-sm">
                        <img src="{{ asset('images/slide1.jpeg') }}" alt="Galeri Dokumentasi 3" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                </div>

                <!-- Navigasi Pagination -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button @click="activePage = activePage > 1 ? activePage - 1 : 1" 
                            :disabled="activePage === 1"
                            class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                        &larr; Sebelumnya
                    </button>

                    <div class="flex items-center gap-2">
                        <button @click="activePage = 1" :class="activePage === 1 ? 'bg-smanda-green text-white border-smanda-green' : 'border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'" class="w-9 h-9 text-xs font-bold rounded-lg border transition-colors flex items-center justify-center">1</button>
                        <button @click="activePage = 2" :class="activePage === 2 ? 'bg-smanda-green text-white border-smanda-green' : 'border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'" class="w-9 h-9 text-xs font-bold rounded-lg border transition-colors flex items-center justify-center">2</button>
                        <button @click="activePage = 3" :class="activePage === 3 ? 'bg-smanda-green text-white border-smanda-green' : 'border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'" class="w-9 h-9 text-xs font-bold rounded-lg border transition-colors flex items-center justify-center">3</button>
                    </div>

                    <button @click="activePage = activePage < 3 ? activePage + 1 : 3" 
                            :disabled="activePage === 3"
                            class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                        Berikutnya &rarr;
                    </button>
                </div>

            </div>

        </div>
    </section>

</div>

@endsection