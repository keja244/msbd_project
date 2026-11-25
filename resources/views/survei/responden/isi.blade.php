
@extends('layouts.app')

@section('title', 'Isi Survei - SMAN 2 Medan')

@section('content')

@php
    $warna = [
        'bg-smanda-green text-white',
        'bg-smanda-yellow text-gray-900',
        'bg-smanda-red text-white',
        'bg-smanda-blue text-white'
    ];

    $label = [
        1 => 'Sangat Tidak Puas',
        2 => 'Tidak Puas',
        3 => 'Cukup',
        4 => 'Puas'
    ];

    $no = 0;
@endphp

<div class="bg-[#f8f9fa] dark:bg-gray-900 min-h-screen text-[#2d3748] dark:text-gray-100 font-sans pt-[120px] sm:pt-[140px] pb-[80px] transition-colors duration-300">
    <main class="max-w-3xl mx-auto px-[16px] sm:px-[24px]">

        <!-- HEADER -->
        <section class="mb-8">
            <div class="flex items-center justify-between gap-4 mb-3">
                <div>
                    <div class="text-smanda-blue dark:text-blue-400 text-xs font-bold uppercase tracking-[0.15em] mb-2">
                        Survei Kepuasan
                    </div>

                    <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15]">
                        Penilaian dari <span class="text-smanda-yellow">{{ $namaKategori }}</span>
                    </h1>
                </div>

                <form method="POST" action="{{ route('survei.keluar') }}">
                    @csrf
                    <button type="submit"
                        class="shrink-0 px-4 py-2 rounded-lg text-sm font-bold text-white bg-red-600 hover:bg-red-700 transition-colors shadow-sm">
                        Keluar
                    </button>
                </form>
            </div>

            <p class="text-gray-500 dark:text-gray-400 text-sm sm:text-base leading-relaxed">
                Beri skor 1 (sangat tidak puas) sampai 4 (puas). Penilaian ditujukan ke aspek layanan, bukan ke individu.
            </p>
        </section>

        @if($errors->any())
            <div class="bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 rounded-xl px-4 py-3 text-sm mb-6">
                Masih ada pertanyaan yang belum dijawab atau terjadi kesalahan. Periksa kembali jawaban Anda.
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('survei.isi.simpan') }}">
            @csrf

            @foreach($aspek as $i => $a)
                <section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 sm:p-7 shadow-sm mb-6">

                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-full {{ $warna[$i % 4] }} flex items-center justify-center font-extrabold shadow-sm">
                            {{ $i + 1 }}
                        </div>

                        <h2 class="text-lg sm:text-xl font-extrabold">
                            {{ $a['aspek'] }}
                        </h2>
                    </div>

                    @foreach($a['pertanyaan'] as $q)
                        @php
                            $no++;
                            $nilai = old('jawaban.'.$q['id']);
                        @endphp

                        <div class="mb-6 last:mb-0">
                            <p class="text-sm sm:text-base font-semibold mb-3 {{ $errors->has('jawaban.'.$q['id']) ? 'text-red-600 dark:text-red-400' : '' }}">
                                {{ $no }}. {{ $q['teks'] }}
                            </p>

                            <div class="flex gap-2 sm:gap-3">
                                @foreach($label as $skor => $teks)
                                    <label class="flex-1 cursor-pointer text-center">
                                        <input
                                            type="radio"
                                            name="jawaban[{{ $q['id'] }}]"
                                            value="{{ $skor }}"
                                            class="peer sr-only"
                                            @checked((string) $nilai === (string) $skor)
                                        >

                                        <span class="block py-3 rounded-xl border border-gray-200 dark:border-gray-700 font-bold transition-all hover:border-smanda-green peer-checked:bg-smanda-green peer-checked:text-white peer-checked:border-transparent peer-focus-visible:ring-2 peer-focus-visible:ring-smanda-green">
                                            {{ $skor }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="flex justify-between text-[11px] text-gray-400 dark:text-gray-500 mt-1.5">
                                <span>{{ $label[1] }}</span>
                                <span>{{ $label[4] }}</span>
                            </div>
                        </div>
                    @endforeach

                </section>
            @endforeach

            <!-- SARAN -->
            <section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 sm:p-7 shadow-sm mb-8">
                <label for="isian" class="block text-lg font-extrabold mb-1">
                    Saran atau masukan
                    <span class="text-sm font-semibold text-gray-400">(opsional)</span>
                </label>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                    Tulis singkat dan jangan menyebut nama orang tertentu.
                </p>

                <textarea
                    id="isian"
                    name="isian"
                    rows="4"
                    maxlength="1000"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-smanda-green"
                >{{ old('isian') }}</textarea>
            </section>

            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-white bg-smanda-green hover:brightness-85 shadow-md transition-all">
                Kirim Survei →
            </button>

            <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">
                Survei hanya bisa dikirim satu kali per semester.
            </p>
        </form>

    </main>
</div>

@endsection
