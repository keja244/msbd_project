@extends('layouts.app')

@section('title', 'Penerimaan Siswa Baru - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] pb-[80px] transition-colors duration-300">

    <!-- HERO HEADER HALAMAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] pt-[20px] pb-[40px] text-center">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Informasi Resmi</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2]">
            Penerimaan Siswa Baru <br>
            <span class="text-smanda-green">SMA Negeri 2 Medan</span>
        </h1>
        <p class="max-w-[700px] mx-auto mt-[16px] text-[1.02rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7]">
            Pilih jalur pendaftaran di bawah ini untuk melihat informasi persyaratan lengkap, kuota daya tampung, serta jadwal seleksi masing-masing kategori.
        </p>
    </section>

    <!-- DAFTAR KATEGORI JALUR MASUK (MEMANJANG HORIZONTAL / SIDE-BY-SIDE) -->
    <section class="max-w-[1100px] mx-auto px-[24px] py-[20px] space-y-[40px]">

        <!-- 1. Domisili  -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[30px] lg:gap-[40px] items-center bg-white dark:bg-gray-800 p-[24px] sm:p-[32px] rounded-[20px] border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="lg:col-span-5 relative overflow-hidden rounded-[14px] aspect-[16/10] bg-gray-100 dark:bg-gray-900">
                <img src="{{ asset('images/slide1.jpeg') }}" alt="Jalur Domisili" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute top-3 left-3 bg-smanda-green text-white text-[0.75rem] font-bold px-3 py-1 rounded-full shadow-md">
                    📅 1 - 10 Juni 2026
                </div>
            </div>
            <div class="lg:col-span-7 flex flex-col justify-center">
                <h3 class="text-[1.5rem] sm:text-[1.75rem] font-extrabold text-[#4a5568] dark:text-gray-100 text-smanda-green mb-[12px]">Domisili</h3>
                <p class="text-[0.98rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[20px]">
                    Jalur seleksi penerimaan yang diprioritaskan berdasarkan radius jarak domisili tempat tinggal calon peserta didik dengan satuan pendidikan sesuai ketentuan wilayah.
                </p>
                <div>
                    <a href="{{ url('/ppdb/domisili') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. Prestasi -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[30px] lg:gap-[40px] items-center bg-white dark:bg-gray-800 p-[24px] sm:p-[32px] rounded-[20px] border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="lg:col-span-5 lg:order-2 relative overflow-hidden rounded-[14px] aspect-[16/10] bg-gray-100 dark:bg-gray-900">
                <img src="{{ asset('images/slide2.jpeg') }}" alt="Jalur Prestasi" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute top-3 left-3 bg-smanda-blue text-white text-[0.75rem] font-bold px-3 py-1 rounded-full shadow-md">
                    📅 12 - 18 Juni 2026
                </div>
            </div>
            <div class="lg:col-span-7 lg:order-1 flex flex-col justify-center">
                <h3 class="text-[1.5rem] sm:text-[1.75rem] font-extrabold text-[#4a5568] dark:text-gray-100 text-smanda-yellow mb-[12px]">Prestasi</h3>
                <p class="text-[0.98rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[20px]">
                    Dikhususkan bagi calon peserta didik yang memiliki rekam jejak prestasi akademik gemilang maupun kejuaraan non-akademik di tingkat daerah hingga internasional.
                </p>
                <div>
                    <a href="{{ url('/ppdb/prestasi') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-smanda-yellow hover:underline">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- 3. Afirmasi -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[30px] lg:gap-[40px] items-center bg-white dark:bg-gray-800 p-[24px] sm:p-[32px] rounded-[20px] border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="lg:col-span-5 relative overflow-hidden rounded-[14px] aspect-[16/10] bg-gray-100 dark:bg-gray-900">
                <img src="{{ asset('images/slide3.jpeg') }}" alt="Jalur Afirmasi" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute top-3 left-3 bg-smanda-yellow-dark text-white text-[0.75rem] font-bold px-3 py-1 rounded-full shadow-md">
                    📅 20 - 25 Juni 2026
                </div>
            </div>
            <div class="lg:col-span-7 flex flex-col justify-center">
                <h3 class="text-[1.5rem] sm:text-[1.75rem] font-extrabold text-[#4a5568] dark:text-gray-100 text-smanda-blue mb-[12px]">Afirmasi</h3>
                <p class="text-[0.98rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[20px]">
                    Diperuntukkan secara khusus bagi anak dari keluarga dari latar belakang ekonomi tidak mampu serta penyandang disabilitas yang ingin mengenyam pendidikan berkualitas.
                </p>
                <div>
                    <a href="{{ url('/ppdb/afirmasi') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-smanda-blue dark:text-smanda-yellow hover:underline">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- 4. Mutasi -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[30px] lg:gap-[40px] items-center bg-white dark:bg-gray-800 p-[24px] sm:p-[32px] rounded-[20px] border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="lg:col-span-5 lg:order-2 relative overflow-hidden rounded-[14px] aspect-[16/10] bg-gray-100 dark:bg-gray-900">
                <img src="{{ asset('images/slide4.jpeg') }}" alt="Jalur Mutasi" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute top-3 left-3 bg-smanda-red text-white text-[0.75rem] font-bold px-3 py-1 rounded-full shadow-md">
                    📅 26 - 30 Juni 2026
                </div>
            </div>
            <div class="lg:col-span-7 lg:order-1 flex flex-col justify-center">
                <h3 class="text-[1.5rem] sm:text-[1.75rem] font-extrabold text-[#4a5568] dark:text-gray-100 text-smanda-red mb-[12px]">Mutasi</h3>
                <p class="text-[0.98rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[20px]">
                    Jalur pendaftaran bagi calon siswa yang mengikuti perpindahan tugas penempatan kerja orang tua atau wali dari instansi resmi atau perusahaan swasta ke Kota Medan.
                </p>
                <div>
                    <a href="{{ url('/ppdb/mutasi') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-smanda-red hover:underline">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

    </section>

</div>

@endsection