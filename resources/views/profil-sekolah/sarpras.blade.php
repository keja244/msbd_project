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
        @if(isset($fasilitas) && $fasilitas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[30px]">
                @foreach($fasilitas as $item)
                    @php
                        $colorClass = match(strtolower($item->kategori)) {
                            'laboratorium' => 'text-smanda-blue',
                            'kerohanian' => 'text-smanda-green',
                            'literasi', 'perpustakaan' => 'text-smanda-yellow dark:text-smanda-yellow',
                            'olahraga' => 'text-smanda-red',
                            default => 'text-smanda-green',
                        };

                        $kondisiClass = match($item->kondisi) {
                            'Baik' => 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
                            'Rusak Ringan' => 'bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                            default => 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border-red-200 dark:border-red-800',
                        };

                        $fotoUrl = $item->foto ? asset($item->foto) : asset('images/slide1.jpeg');
                    @endphp

                    <div class="bg-white dark:bg-gray-800 rounded-[16px] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col transition-all duration-300 hover:shadow-md">
                        <div class="relative w-full aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                            <img src="{{ $fotoUrl }}" alt="{{ $item->nama_fasilitas }}"
                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                 onerror="this.src='{{ asset('images/slide1.jpeg') }}'">
                            
                            @if($item->kondisi)
                                <div class="absolute top-3 right-3">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold border backdrop-blur-md bg-white/90 dark:bg-gray-800/90 shadow-sm {{ $kondisiClass }}">
                                        {{ $item->kondisi }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-[24px] flex flex-col flex-grow justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-[6px]">
                                    <span class="text-xs font-bold {{ $colorClass }} uppercase tracking-wider block">
                                        {{ $item->kategori }}
                                    </span>
                                    @if($item->jumlah)
                                        <span class="text-xs text-gray-400 font-semibold">
                                            {{ $item->jumlah }} Unit
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-[1.25rem] font-bold text-[#4a5568] dark:text-gray-100 mb-[10px]">
                                    {{ $item->nama_fasilitas }}
                                </h3>
                                <p class="text-[0.92rem] text-[#718096] dark:text-gray-300 font-light leading-[1.7] text-justify">
                                    {{ $item->deskripsi ?? $item->keterangan }}
                                </p>
                            </div>

                            @if($item->keterangan && $item->deskripsi && $item->keterangan !== $item->deskripsi)
                                <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 text-xs text-gray-500 dark:text-gray-400 italic">
                                    {{ $item->keterangan }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                <p class="text-gray-500 dark:text-gray-400">Belum ada fasilitas sarana prasarana yang ditambahkan.</p>
            </div>
        @endif
    </section>

</div>

@endsection
