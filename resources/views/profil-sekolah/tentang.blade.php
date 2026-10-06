@extends('layouts.app')

@section('title', 'Tentang Sekolah - SMAN 2 Medan')

@section('content')

<!-- BACKGROUND WRAPPER DENGAN SUPPORT DARK MODE -->
<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <!-- HERO HEADER HALAMAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="max-w-[800px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Profil Resmi</span>
            <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">
                Tentang SMAN 2 Medan
            </h1>
            <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7]">
                Mengenal lebih dekat sejarah panjang, landasan visi-misi, kepemimpinan, serta deretan prestasi gemilang yang telah diukir oleh civitas akademika SMAN 2 Medan.
            </p>
        </div>
    </section>

    <!-- 1. KATA PENGANTAR / SAMBUTAN -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[40px] items-center">
            <div class="lg:col-span-4">
                <div class="relative w-full rounded-[16px] overflow-hidden shadow-sm bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <img src="https://asset-2.tstatic.net/medan/foto/bank/images/Peringatan-Hari-Pendidikan-Nasional-di-SMA-Negeri-2-Medan.jpg" alt="Kepala Sekolah" class="w-full h-[380px] object-cover">
                    <div class="p-4 bg-white dark:bg-gray-800 text-center">
                        <h4 class="font-bold text-[1rem] text-gray-900 dark:text-white">Drs. Marsito, M.Si</h4>
                        <span class="text-xs text-smanda-green font-semibold uppercase tracking-wider">Kepala SMAN 2 Medan</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 flex flex-col justify-center">
                <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Kata Pengantar</span>
                <h2 class="text-[2rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[20px]">Sambutan Pimpinan Sekolah</h2>
                <div class="space-y-[16px] text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light">
                    <p>
                        Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa atas limpahan rahmat dan karunia-Nya sehingga website resmi SMA Negeri 2 Medan ini dapat terus berkembang sebagai sarana informasi dan komunikasi yang transparan bagi masyarakat luas.
                    </p>
                    <p>
                        Di tengah era digital dan tantangan global yang semakin kompetitif, SMAN 2 Medan berkomitmen untuk terus berinovasi dalam penyelenggaraan pendidikan berkualitas tinggi. Kami tidak hanya fokus pada pencapaian akademik semata, tetapi juga pada pembentukan karakter siswa yang berintegritas, berjiwa nasionalis, serta memiliki daya saing global.
                    </p>
                    <p>
                        Melalui halaman ini, kami mengajak seluruh orang tua, alumni, dan pemerhati pendidikan untuk bersama-sama mengawal langkah maju anak-anak didik kita menuju masa depan yang gemilang. <em>Smandu Hebat, Indonesia Maju!</em>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. SEJARAH SEKOLAH -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px] border-b border-gray-200/60 dark:border-gray-800">
        <div class="max-w-[800px] mb-[36px]">
            <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Jejak Langkah</span>
            <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Sejarah Singkat SMAN 2 Medan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-[40px] items-start">
            <div class="md:col-span-7 space-y-[18px] text-[#4a5568] dark:text-gray-300 text-[1.02rem] leading-[1.8] font-light">
                <p>
                    SMA Negeri 2 Medan merupakan salah satu lembaga pendidikan menengah atas negeri tertua dan paling bersejarah di Kota Medan, Sumatera Utara. Berdiri sejak dekade awal kemerdekaan, sekolah ini telah melalui berbagai fase transformasi sistem pendidikan nasional.
                </p>
                <p>
                    Sejak berdirinya, SMAN 2 Medan konsisten menjadi magnet bagi calon peserta didik berprestasi dari berbagai penjuru wilayah. Ribuan alumni telah lulus dan berkiprah di berbagai sektor strategis tingkat nasional maupun internasional, baik di bidang pemerintahan, dunia usaha, akademisi, hingga seni dan teknologi.
                </p>
                <p>
                    Dengan memadukan nilai-nilai kedisiplinan tradisional dan fasilitas pembelajaran berbasis teknologi modern saat ini, SMAN 2 Medan terus bertransformasi menjadi sekolah unggulan yang ramah anak, asri, serta berwawasan lingkungan.
                </p>
            </div>

            <div class="md:col-span-5 bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-[16px] pb-[8px] border-b dark:border-gray-700">Fakta Singkat</h3>
                <ul class="space-y-[12px] text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex justify-between">
                        <span class="font-medium">Tahun Berdiri:</span>
                        <span class="font-bold text-gray-900 dark:text-white">Era 1950-an</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium">Status Sekolah:</span>
                        <span class="font-bold text-smanda-green">Negeri (Standar Nasional)</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium">Akreditasi:</span>
                        <span class="font-bold text-gray-900 dark:text-white">A (Unggul)</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium">Lokasi:</span>
                        <span class="font-bold text-gray-900 dark:text-white">Kota Medan, Sumatera Utara</span>
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
                    "Terwujudnya Lulusan Terdidik, Kompeten, Berjiwa Besar, dan Berdaya Saing Global Berlandaskan Iman dan Taqwa."
                </p>
            </div>

            <div class="md:col-span-7 bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <span class="text-xs font-bold text-smanda-blue uppercase tracking-wider block mb-[14px]">Misi Sekolah</span>
                <ol class="list-decimal list-inside space-y-[10px] text-[#4a5568] dark:text-gray-300 text-[0.98rem] leading-[1.7] font-light">
                    <li class="pl-1">Menyelenggarakan proses pembelajaran aktif, kreatif, efektif, dan menyenangkan berbasis teknologi.</li>
                    <li class="pl-1">Mengembangkan potensi akademik dan non-akademik siswa melalui pembinaan ekstrakurikuler yang terarah.</li>
                    <li class="pl-1">Membentuk karakter peserta didik yang menjunjung tinggi nilai moral, etika, dan kebhinekaan.</li>
                    <li class="pl-1">Meningkatkan kerjasama sinergis antara sekolah, orang tua, alumni, dan instansi mitra strategis.</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- 4. CAPAIAN PRESTASI (REGIONAL, NASIONAL, INTERNASIONAL) -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[60px]">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-[36px]">
            <div>
                <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Rekam Jejak Gemilang</span>
                <h2 class="text-[2.2rem] font-extrabold text-[#4a5568] dark:text-gray-100">Capaian Prestasi Sekolah</h2>
            </div>
            <a href="{{ url('/akademik/prestasi') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline mt-[10px] sm:mt-0">
                Lihat Direktori Prestasi Lengkap &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-[30px]">
            <!-- Kategori Regional -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="inline-block bg-smanda-red/10 text-smanda-red text-[0.75rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full mb-[14px]">
                        Tingkat Regional / Provinsi
                    </span>
                    <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Juara Umum Olahraga & Seni Sumut</h3>
                    <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light leading-[1.6]">
                        Secara konsisten meraih medali emas dalam ajang Pekan Olahraga Pelajar dan Festival Lomba Seni Siswa Nasional (FLS2N) tingkat Provinsi Sumatera Utara.
                    </p>
                </div>
                <div class="mt-[20px] pt-[12px] border-t border-gray-100 dark:border-gray-700 text-xs text-gray-400 font-medium">
                    Puluhan Piala Bergilir & Penghargaan Daerah
                </div>
            </div>

            <!-- Kategori Nasional -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="inline-block bg-smanda-yellow/20 text-smanda-yellow-dark dark:text-smanda-yellow text-[0.75rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full mb-[14px]">
                        Tingkat Nasional
                    </span>
                    <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Medali Emas Olimpiade Sains Nasional (OSN)</h3>
                    <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light leading-[1.6]">
                        Siswa-siswi perwakilan SMAN 2 Medan rutin melaju ke tingkat nasional dan mempersembahkan medali emas serta perak pada bidang Matematika, Fisika, dan Biologi.
                    </p>
                </div>
                <div class="mt-[20px] pt-[12px] border-t border-gray-100 dark:border-gray-700 text-xs text-gray-400 font-medium">
                    Kompetisi Sains & Debat Tingkat Kementerian
                </div>
            </div>

            <!-- Kategori Internasional -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="inline-block bg-smanda-blue/10 text-smanda-blue text-[0.75rem] font-bold tracking-wider uppercase px-[12px] py-[4px] rounded-full mb-[14px]">
                        Tingkat Internasional
                    </span>
                    <h3 class="text-[1.2rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">Ajang Riset & Kompetisi Global</h3>
                    <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 font-light leading-[1.6]">
                        Delegasi siswa turut serta dalam kompetisi Karya Ilmiah Remaja dan konferensi pemuda internasional di Asia dan Eropa, mengharumkan nama bangsa di kancah dunia.
                    </p>
                </div>
                <div class="mt-[20px] pt-[12px] border-t border-gray-100 dark:border-gray-700 text-xs text-gray-400 font-medium">
                    Penghargaan Riset Internasional & Pertukaran Pelajar
                </div>
            </div>
        </div>
    </section>

</div>

@endsection