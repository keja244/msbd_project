@extends('layouts.app')

@section('title', 'Tentang Sekolah - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] pb-[80px] transition-colors duration-300">

    <!-- HERO HEADER HALAMAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] pt-[20px] pb-[30px] text-center">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Profil Resmi</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2]">
            Semua Tentang <br>
            <span class="text-smanda-green">SMA Negeri 2 Medan</span>
        </h1>
    </section>

    <!-- HERO FOTO -->
    <section class="max-w-[1280px] mx-auto px-[24px] mb-[60px]">
        <div class="relative w-full rounded-[5px] overflow-hidden shadow-md">
            <img src="{{ asset('images/slide1.jpeg') }}" alt="Taman Belajar SMAN 2 Medan" class="w-full h-[400px] sm:h-[500px] object-cover">
        </div>
    </section>

    <!-- 1. KATA PENGANTAR / SAMBUTAN -->
    <section class="max-w-[1000px] mx-auto px-[24px] py-[60px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="text-center max-w-[800px] mx-auto mb-[40px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Kata Pengantar</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Esensi Pendidikan & Peran Sekolah</h2>
        </div>

        <div class="space-y-[18px] text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light text-justify">
            <p>
                Pendidikan menengah atas memegang peranan krusial sebagai jembatan transisi bagi peserta didik menuju jenjang pendidikan tinggi maupun dunia profesional yang kompetitif. Di tengah dinamika zaman yang terus berubah, institusi pendidikan dituntut untuk tidak sekadar mentransfer ilmu pengetahuan, melainkan membangun fondasi berpikir kritis dan adaptif.
            </p>
            <p>
                Sebagai institusi yang konsisten mengawal kualitas pendidikan di Sumatera Utara, SMAN 2 Medan memandang bahwa setiap siswa memiliki potensi unik yang harus diasah melalui ekosistem belajar yang suportif, disiplin, dan berwawasan global. Pembentukan karakter yang tangguh serta integritas moral menjadi pilar utama dalam setiap proses pembelajaran yang kami selenggarakan.
            </p>
            <p>
                Melalui komitmen kolektif civitas akademika, kami terus berinovasi menciptakan lingkungan sekolah yang kondusif bagi lahirnya generasi cerdas, inovatif, dan siap menghadapi tantangan masa depan demi kemajuan bangsa. <br> <em>Smandu Hebat, Indonesia Maju!</em>
            </p>
        </div>
    </section>

    <!-- 2. SEJARAH SEKOLAH -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="max-w-[800px] mb-[36px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Jejak Langkah</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Sejarah Singkat SMAN 2 Medan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-[40px] items-start">
            <div class="md:col-span-7 space-y-[18px] text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light text-justify">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac purus ut leo aliquet convallis a eu velit. Pellentesque at laoreet ligula. In elementum pretium viverra. 
                </p>
                <p>
                    Vivamus convallis justo nec tellus egestas faucibus sed ut tortor. Curabitur ut orci diam. Vestibulum sollicitudin faucibus mi, ac tempor tellus pulvinar id. Nulla vel magna fermentum, pellentesque ex id, consequat tellus.  
                </p>
                <p>
                    Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam et tortor maximus, vehicula felis eu, elementum magna. Pellentesque malesuada, tellus eu mollis feugiat, arcu massa facilisis mauris, sed suscipit nulla lorem blandit nulla. 
                </p>
            </div>

            <div class="md:col-span-5 bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-[16px] pb-[8px] border-b dark:border-gray-700">Fakta Singkat</h3>
                <ul class="space-y-[12px] text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex justify-between">
                        <span class="font-medium">Tahun Berdiri:</span>
                        <span class="font-bold text-gray-900 dark:text-white">--------</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium">Status Sekolah:</span>
                        <span class="font-bold text-smanda-green">--------</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium">Akreditasi:</span>
                        <span class="font-bold text-gray-900 dark:text-white">--------</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium">Lokasi:</span>
                        <span class="font-bold text-gray-900 dark:text-white">--------</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="max-w-[800px] mb-[36px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Landasan Utama</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Visi & Misi SMAN 2 Medan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-[40px]">
            <div class="md:col-span-5 bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <span class="text-xs font-bold text-smanda-red uppercase tracking-wider block mb-[10px]">Visi Sekolah</span>
                <p class="text-[1.15rem] font-normal text-[#2d3748] dark:text-gray-200 leading-[1.75] italic">
                    "Terwujudnya warga sekolah berakhlak mulia, disiplin, berdaya saing, dan mencintai lingkungan."
                </p>
            </div>

            <div class="md:col-span-7 bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[14px]">Misi Sekolah</span>
                <ol class="list-decimal list-inside space-y-[10px] text-[#4a5568] dark:text-gray-300 text-[0.98rem] leading-[1.7] font-light">
                    <li class="pl-1">Meningkatkan keimanan dan ketaqwaan dengan mengoptimalkan kegiatan keagamaan di sekolah.</li>
                    <li class="pl-1">Meningkatkan budaya disiplin dan tanggungjawab seluruh elemen sekolah.</li>
                    <li class="pl-1">Meningkatkan kualitas Sumber Daya Manusia (SDM) dalam kegiatan pembelajaran yang terintegrasi nilai kepramukaan.</li>
                    <li class="pl-1">Meningkatkan kualitas dan kuantitas sarana dan prasarana sekolah.</li>
                    <li class="pl-1">Meningkatkan kesadaran dalam pengelolaan dan pelestarian lingkungan sekolah yang hijau, bersih, nyaman, dan terawat.</li>
                    <li class="pl-1">Meningkatkan kemampuan akademik dan bakat yang sesuai dengan kebutuhan siswa pada konteks global.</li>
                    <li class="pl-1">Meningkatkan pelayanan bimbingan dan konseling kepada peserta didik secara intensif.</li>
                    <li class="pl-1">Meningkatkan jumlah lulusan yang melanjutkan ke perguruan tinggi negeri terbaik.</li>
                    <li class="pl-1">Meningkatkan hubungan baik dengan unsur stakeholder dalam pengembangan sekolah.</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- SECTION STATISTIK PRESTASI -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px]">
        <div class="max-w-[800px] mb-[36px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Pencapaian Kami</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Deretan Prestasi SMAN 2 Medan</h2>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[40px] shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-[30px] text-center">
                
                <div class="flex flex-col items-center justify-center p-[20px]">
                    <div class="w-[50px] h-[50px] mb-[16px] flex items-center justify-center">
                        <img src="{{ asset('images/medals.png') }}" alt="Ikon Piala Internasional" class="w-full h-full object-contain">
                    </div>
                    <span class="text-[2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-tight mb-[4px]">X</span>
                    <span class="text-[1rem] font-semibold text-smanda-yellow uppercase tracking-wide">Internasional</span>
                </div>

                <div class="flex flex-col items-center justify-center p-[20px] sm:border-x sm:border-gray-100 sm:dark:border-gray-700">
                    <div class="w-[50px] h-[50px] mb-[16px] flex items-center justify-center">
                        <img src="{{ asset('images/medals.png') }}" alt="Ikon Piala Nasional" class="w-full h-full object-contain">
                    </div>
                    <span class="text-[2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-tight mb-[4px]">X</span>
                    <span class="text-[1rem] font-semibold text-smanda-blue uppercase tracking-wide">Nasional</span>
                </div>

                <div class="flex flex-col items-center justify-center p-[20px]">
                    <div class="w-[50px] h-[50px] mb-[16px] flex items-center justify-center">
                        <img src="{{ asset('images/medals.png') }}" alt="Ikon Piala Regional" class="w-full h-full object-contain">
                    </div>
                    <span class="text-[2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-tight mb-[4px]">X</span>
                    <span class="text-[1rem] font-semibold text-smanda-red uppercase tracking-wide">Regional</span>
                </div>

            </div>
        </div>
    </section>

</div>

@endsection