@extends('layouts.app')

@section('title', 'OSIS & Ekstrakurikuler - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[90px] sm:pt-[100px] pb-[80px] transition-colors duration-300">

    <!-- ================= SECTION 1: OSIS (Pusat Organisasi) ================= -->
    <section id="osis" class="max-w-[1280px] mx-auto px-[16px] sm:px-[24px] pt-[20px] pb-[50px] scroll-mt-[100px]">
        
        <!-- Header Utama OSIS -->
        <div class="bg-white dark:bg-gray-800 rounded-[20px] p-[24px] sm:p-[48px] border border-gray-100 dark:border-gray-700 shadow-sm grid grid-cols-1 lg:grid-cols-12 gap-[30px] sm:gap-[40px] items-center mb-[40px]">
            
            <!-- Logo & Identitas OSIS -->
            <div class="lg:col-span-4 text-center flex flex-col items-center">
                <div class="w-[120px] h-[120px] sm:w-[160px] sm:h-[160px] bg-emerald-50 dark:bg-gray-900 rounded-full flex items-center justify-center p-4 mb-[16px] shadow-inner border border-emerald-100 dark:border-gray-700">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo OSIS SMAN 2 Medan" class="w-full h-full object-contain">
                </div>
                <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[4px]">Induk Organisasi</span>
                <h2 class="text-[1.5rem] sm:text-[1.8rem] font-extrabold text-[#4a5568] dark:text-gray-100">OSIS SMAN 2 Medan</h2>
            </div>

            <!-- Deskripsi & Peran OSIS Menaungi 25+ Ekskul -->
            <div class="lg:col-span-8 flex flex-col justify-center">
                <span class="inline-block bg-emerald-100 dark:bg-emerald-900/40 text-smanda-green dark:text-emerald-300 text-xs font-bold px-3 py-1 rounded-full w-max mb-[12px]">
                    Naungan 25+ Ekstrakurikuler Aktif
                </span>
                <h3 class="text-[1.3rem] sm:text-[1.8rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[16px] leading-tight">
                    Wadah Pengembangan Bakat, Kreativitas, dan Karakter Siswa
                </h3>
                <p class="text-[0.9rem] sm:text-[0.98rem] text-[#718096] dark:text-gray-300 font-light leading-[1.8] text-justify mb-[20px]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#ekskul" class="bg-smanda-green hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-full transition-all shadow-sm">
                        Jelajahi 25+ Ekstrakurikuler &rarr;
                    </a>
                </div>
            </div>

        </div>

        <!-- Visi & Misi OSIS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[24px] mb-[40px]">
            <div class="bg-white dark:bg-gray-800 rounded-[16px] p-[28px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <h4 class="text-[1.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[12px] border-b-2 border-smanda-green pb-2 inline-block">
                    Visi OSIS
                </h4>
                <p class="text-[0.9rem] sm:text-[0.95rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] italic">
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero."
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-[16px] p-[28px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <h4 class="text-[1.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[12px] border-b-2 border-smanda-green pb-2 inline-block">
                    Misi OSIS
                </h4>
                <ul class="space-y-[8px] text-[0.9rem] sm:text-[0.95rem] text-[#718096] dark:text-gray-300 font-light">
                    <li class="flex items-start gap-[8px]">
                        <span class="text-smanda-green font-bold">1.</span>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </li>
                    <li class="flex items-start gap-[8px]">
                        <span class="text-smanda-green font-bold">2.</span>
                        <span>Integer nec odio. Praesent libero sed cursus ante dapibus.</span>
                    </li>
                    <li class="flex items-start gap-[8px]">
                        <span class="text-smanda-green font-bold">3.</span>
                        <span>Sed nisi nulla quis sem at nibh elementum imperdiet.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Pengurus Inti OSIS -->
        <div class="mb-[40px]">
            <div class="text-center mb-[24px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">
                    Badan Pengurus Inti OSIS
                </h3>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-[16px] sm:gap-[24px]">
                @php
                    $pengurusInti = [
                        ['jabatan' => 'Ketua OSIS', 'nama' => 'Lorem Ipsum', 'kelas' => 'XI MIPA 1', 'foto' => 'images/slide1.jpeg'],
                        ['jabatan' => 'Wakil Ketua', 'nama' => 'Lorem Ipsum', 'kelas' => 'XI MIPA 2', 'foto' => 'images/slide2.jpeg'],
                        ['jabatan' => 'Sekretaris', 'nama' => 'Lorem Ipsum', 'kelas' => 'XI IPS 1', 'foto' => 'images/slide3.jpeg'],
                        ['jabatan' => 'Bendahara', 'nama' => 'Lorem Ipsum', 'kelas' => 'XI MIPA 3', 'foto' => 'images/slide4.jpeg'],
                    ];
                @endphp
                @foreach($pengurusInti as $p)
                <div class="bg-white dark:bg-gray-800 rounded-[14px] p-[16px] border border-gray-100 dark:border-gray-700 shadow-sm text-center transition-all duration-300 hover:bg-smanda-green hover:text-white group">
                    <div class="w-full aspect-[4/5] bg-gray-200 dark:bg-gray-900 rounded-[10px] overflow-hidden mb-[12px]">
                        <img src="{{ asset($p['foto']) }}" alt="{{ $p['nama'] }}" class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-bold text-[0.95rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white">{{ $p['nama'] }}</h4>
                    <p class="text-[0.75rem] sm:text-xs text-smanda-green group-hover:text-emerald-100 font-bold mt-[2px] uppercase tracking-wide">{{ $p['jabatan'] }}</p>
                    <p class="text-[0.7rem] sm:text-[0.75rem] text-[#718096] dark:text-gray-400 group-hover:text-emerald-200 mt-[2px]">{{ $p['kelas'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Divisi 1 - 6 OSIS -->
        <div>
            <div class="text-center mb-[24px]">
                <h3 class="text-[1.4rem] sm:text-[1.6rem] font-extrabold text-[#4a5568] dark:text-gray-100 inline-block border-b-2 border-smanda-green pb-1">
                    Divisi OSIS
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[24px]">
                
                @for ($d = 1; $d <= 6; $d++)
                <div class="bg-white dark:bg-gray-800 rounded-[16px] p-[24px] border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col justify-between">
                    <div>
                        <h4 class="text-[1.1rem] font-extrabold text-smanda-green mb-[10px] pb-2 border-b border-gray-100 dark:border-gray-700">
                            Divisi {{ $d }}
                        </h4>
                        <div class="mb-[14px]">
                            <span class="text-[0.75rem] font-bold text-gray-400 uppercase block mb-[2px]">Job Description:</span>
                            <p class="text-[0.88rem] text-[#718096] dark:text-gray-300 font-light leading-[1.6]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
                            </p>
                        </div>
                    </div>
                    <div class="bg-emerald-50/50 dark:bg-gray-900/50 rounded-[10px] p-[12px]">
                        <span class="text-[0.75rem] font-bold text-smanda-green uppercase block mb-[6px]">Program Kerja Utama:</span>
                        <ul class="space-y-[4px]">
                            <li class="text-[0.85rem] text-gray-700 dark:text-gray-300 flex items-center gap-[6px]">
                                <span class="w-1.5 h-1.5 bg-smanda-green rounded-full"></span>
                                <span>Progja 1: Lorem ipsum dolor</span>
                            </li>
                            <li class="text-[0.85rem] text-gray-700 dark:text-gray-300 flex items-center gap-[6px]">
                                <span class="w-1.5 h-1.5 bg-smanda-green rounded-full"></span>
                                <span>Progja 2: Sit amet consectetur</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @endfor

            </div>
        </div>

    </section>


    <!-- Divider Pemisah -->
    <div class="max-w-[1200px] mx-auto px-[16px] sm:px-[24px]">
        <hr class="border-gray-200 dark:border-gray-800">
    </div>


    <!-- ================= SECTION 2: DAFTAR EKSTRAKURIKULER ================= -->
    <section id="ekskul" class="max-w-[1280px] mx-auto px-[16px] sm:px-[24px] pt-[50px] pb-[20px] scroll-mt-[100px]">
        
        <!-- Header Section Ekskul -->
        <div class="text-center mb-[35px]">
            <h2 class="text-[1.8rem] sm:text-[2.8rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2]">
                Daftar Ekstrakurikuler <br>
                <span class="text-smanda-green">SMA Negeri 2 Medan</span>
            </h2>
            <p class="max-w-[650px] mx-auto mt-[10px] text-[0.9rem] sm:text-[1rem] text-[#718096] dark:text-gray-400 font-light leading-[1.6]">
                Pilih dan kembangkan potensimu melalui berbagai pilihan ekstrakurikuler resmi yang dibimbing oleh pembina profesional.
            </p>
        </div>

        <!-- Grid Kategori Ekskul (1-25) -->
        <div class="space-y-[40px]">

            <!-- 1. KETERAMPILAN (Ekskul 1 - 6) -->
            <div>
                <h3 class="text-[1.2rem] sm:text-[1.3rem] font-extrabold text-smanda-green uppercase tracking-wider mb-[16px] border-b-2 border-smanda-green pb-1 inline-block">
                    Keterampilan
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-[12px] sm:gap-[20px]">
                    @for ($i = 1; $i <= 6; $i++)
                    <a href="{{ url('/ekskul/ekskul-' . $i) }}" class="bg-white dark:bg-gray-800 rounded-[12px] sm:rounded-[14px] p-[14px] sm:p-[20px] border border-gray-100 dark:border-gray-700 shadow-sm text-center transition-all duration-300 hover:bg-smanda-green hover:text-white group cursor-pointer block">
                        <div class="w-[42px] h-[42px] sm:w-[50px] sm:h-[50px] bg-emerald-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-[10px] sm:mb-[12px] text-smanda-green group-hover:bg-white group-hover:text-smanda-green font-bold text-sm sm:text-base">
                            0{{ $i }}
                        </div>
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white">Ekskul {{ $i }}</h4>
                        <p class="text-[0.7rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-emerald-100 mt-[2px] sm:mt-[4px]">Bidang Keterampilan</p>
                    </a>
                    @endfor
                </div>
            </div>

            <!-- 2. OLAHRAGA (Ekskul 7 - 13) -->
            <div>
                <h3 class="text-[1.2rem] sm:text-[1.3rem] font-extrabold text-smanda-yellow uppercase tracking-wider mb-[16px] border-b-2 border-smanda-yellow pb-1 inline-block">
                    Olahraga
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-[12px] sm:gap-[20px]">
                    @for ($i = 7; $i <= 13; $i++)
                    <a href="{{ url('/ekskul/ekskul-' . $i) }}" class="bg-white dark:bg-gray-800 rounded-[12px] sm:rounded-[14px] p-[14px] sm:p-[20px] border border-gray-100 dark:border-gray-700 shadow-sm text-center transition-all duration-300 hover:bg-smanda-yellow hover:text-white group cursor-pointer block">
                        <div class="w-[42px] h-[42px] sm:w-[50px] sm:h-[50px] bg-yellow-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-[10px] sm:mb-[12px] text-smanda-yellow group-hover:bg-white group-hover:text-smanda-yellow font-bold text-sm sm:text-base">
                            {{ $i }}
                        </div>
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white">Ekskul {{ $i }}</h4>
                        <p class="text-[0.7rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-yellow-100 mt-[2px] sm:mt-[4px]">Bidang Olahraga</p>
                    </a>
                    @endfor
                </div>
            </div>

            <!-- 3. SENI & BUDAYA (Ekskul 14 - 19) -->
            <div>
                <h3 class="text-[1.2rem] sm:text-[1.3rem] font-extrabold text-smanda-red uppercase tracking-wider mb-[16px] border-b-2 border-smanda-red pb-1 inline-block">
                    Seni & Budaya
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-[12px] sm:gap-[20px]">
                    @for ($i = 14; $i <= 19; $i++)
                    <a href="{{ url('/ekskul/ekskul-' . $i) }}" class="bg-white dark:bg-gray-800 rounded-[12px] sm:rounded-[14px] p-[14px] sm:p-[20px] border border-gray-100 dark:border-gray-700 shadow-sm text-center transition-all duration-300 hover:bg-smanda-red hover:text-white group cursor-pointer block">
                        <div class="w-[42px] h-[42px] sm:w-[50px] sm:h-[50px] bg-red-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-[10px] sm:mb-[12px] text-smanda-red group-hover:bg-white group-hover:text-smanda-red font-bold text-sm sm:text-base">
                            {{ $i }}
                        </div>
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white">Ekskul {{ $i }}</h4>
                        <p class="text-[0.7rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-red-100 mt-[2px] sm:mt-[4px]">Seni & Budaya</p>
                    </a>
                    @endfor
                </div>
            </div>

            <!-- 4. AKADEMIK & AGAMA (Ekskul 20 - 25) -->
            <div>
                <h3 class="text-[1.2rem] sm:text-[1.3rem] font-extrabold text-smanda-blue uppercase tracking-wider mb-[16px] border-b-2 border-smanda-blue pb-1 inline-block">
                    Akademik & Agama
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-[12px] sm:gap-[20px]">
                    @for ($i = 20; $i <= 25; $i++)
                    <a href="{{ url('/ekskul/ekskul-' . $i) }}" class="bg-white dark:bg-gray-800 rounded-[12px] sm:rounded-[14px] p-[14px] sm:p-[20px] border border-gray-100 dark:border-gray-700 shadow-sm text-center transition-all duration-300 hover:bg-smanda-blue hover:text-white group cursor-pointer block">
                        <div class="w-[42px] h-[42px] sm:w-[50px] sm:h-[50px] bg-blue-50 dark:bg-gray-900 rounded-[10px] sm:rounded-[12px] flex items-center justify-center mx-auto mb-[10px] sm:mb-[12px] text-smanda-blue group-hover:bg-white group-hover:text-smanda-blue font-bold text-sm sm:text-base">
                            {{ $i }}
                        </div>
                        <h4 class="font-bold text-[0.9rem] sm:text-[1rem] text-gray-900 dark:text-white group-hover:text-white">Ekskul {{ $i }}</h4>
                        <p class="text-[0.7rem] sm:text-xs text-[#718096] dark:text-gray-400 group-hover:text-blue-100 mt-[2px] sm:mt-[4px]">Akademik & Agama</p>
                    </a>
                    @endfor
                </div>
            </div>

        </div>

    </section>

</div>

@endsection