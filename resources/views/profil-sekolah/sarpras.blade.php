@extends('layouts.app')

@section('title', 'Sarana & Prasarana - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] pb-[80px] transition-colors duration-300">

    <!-- HERO HEADER HALAMAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] pt-[20px] pb-[30px] text-center">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Fasilitas Sekolah</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2]">
            Sarana & Prasarana <br>
            <span class="text-smanda-green">SMA Negeri 2 Medan</span>
        </h1>
        <p class="max-w-[700px] mx-auto mt-[16px] text-[1.02rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7]">
            Menyediakan fasilitas belajar yang modern, nyaman, dan representatif guna menunjang kreativitas serta prestasi peserta didik di lingkungan sekolah.
        </p>
    </section>

    <!-- GRID DAFTAR RUANGAN / FASILITAS -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[30px]">

            <!-- Item 1: Mushola -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide1.jpeg') }}" alt="Mushola Sekolah" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-green uppercase tracking-wider block mb-[6px]">Kerohanian</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Mushola</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nulla nisl, ultrices congue magna dignissim, dictum consectetur dui. Pellentesque habitant morbi tristique senectus et netus.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 2: Laboratorium Komputer -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide2.jpeg') }}" alt="Laboratorium Komputer" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[6px]">Laboratorium</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Laboratorium Komputer</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Proin pulvinar neque diam, vel semper mi ornare quis. Cras id pretium neque, vel rutrum quam. Integer eget porttitor risus, et pharetra tortor interdum.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 3: Perpustakaan -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide3.jpeg') }}" alt="Perpustakaan Sekolah" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-yellow dark:text-smanda-yellow uppercase tracking-wider block mb-[6px]">Literasi</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Perpustakaan Sekolah</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Phasellus eu enim non sapien gravida varius sit amet rhoncus felis. Ut nec sapien at nisl lobortis pharetra. Mauris ultricies eu massa eget rhoncus.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 4: Laboratorium Fisika -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide4.jpeg') }}" alt="Laboratorium Fisika" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[6px]">Laboratorium</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Laboratorium Fisika</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Suspendisse potenti. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc gravida nibh vitae metus sollicitudin cursus.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 5: Laboratorium Kimia & Biologi -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide1.jpeg') }}" alt="Laboratorium Kimia & Biologi" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[6px]">Laboratorium</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Laboratorium Kimia & Biologi</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Maecenas justo ex, aliquam imperdiet nibh sit amet, suscipit semper tellus. Quisque et convallis massa, at sagittis risus. Ut nec sapien at nisl lobortis pharetra.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 6: Laboratorium Bahasa -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide2.jpeg') }}" alt="Laboratorium Bahasa" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[6px]">Laboratorium</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Laboratorium Bahasa</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Mauris blandit aliquet elit.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 7: Lapangan Futsal -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide3.jpeg') }}" alt="Lapangan Futsal" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-red uppercase tracking-wider block mb-[6px]">Olahraga</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Lapangan Futsal</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 8: Lapangan Voli -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide4.jpeg') }}" alt="Lapangan Voli" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-red uppercase tracking-wider block mb-[6px]">Olahraga</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Lapangan Voli</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Cras ultricies ligula sed magna dictum porta. Donec sollicitudin molestie malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 9: Lapangan Basket -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide1.jpeg') }}" alt="Lapangan Basket" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-red uppercase tracking-wider block mb-[6px]">Olahraga</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Lapangan Basket</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Nulla porttitor accumsan tincidunt. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Set interdum velit laoreet id donec sollicitudin molestie.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 10: Aula -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide2.jpeg') }}" alt="Aula Sekolah" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-yellow dark:text-smanda-yellow uppercase tracking-wider block mb-[6px]">Fasilitas Umum</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Aula Serbaguna</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget consectetur sed.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 11: Lobby -->
            <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img src="{{ asset('images/slide3.jpeg') }}" alt="Lobby Sekolah" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-[24px] flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-xs font-bold text-smanda-green uppercase tracking-wider block mb-[6px]">Area Utama</span>
                        <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Lobby & Resepsionis</h3>
                        <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                            Pellentesque in ipsum id orci porta dapibus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ante ipsum primis in faucibus.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection