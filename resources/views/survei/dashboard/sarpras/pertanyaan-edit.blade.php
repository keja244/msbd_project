@extends('survei.dashboard.layout')

@section('title', 'Edit Pertanyaan Survei Sarpras - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('survei.dashboard.sarpras.pertanyaan') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline">
            ← Kembali ke Daftar Pertanyaan
        </a>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2d3748] dark:text-gray-100">
        Edit Pertanyaan Survei Sarpras
    </h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
        Perbarui teks atau pengaturan butir pertanyaan survei aspek sarpras.
    </p>
</section>

<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 sm:p-8 shadow-sm max-w-2xl">

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm">
            <p class="font-bold mb-1">Harap perbaiki kesalahan berikut:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('survei.dashboard.sarpras.pertanyaan.update', $pertanyaan->pertanyaan_id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Aspek Penilaian -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Aspek Survei Terkait
            </label>
            <div class="px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 text-sm font-bold text-gray-700 dark:text-gray-200">
                Sarana dan Prasarana (Aspek ID: 4)
            </div>
        </div>

        <!-- Teks Pertanyaan -->
        <div>
            <label for="teks_pertanyaan" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Teks Pertanyaan Survei <span class="text-red-500">*</span>
            </label>
            <textarea id="teks_pertanyaan" name="teks_pertanyaan" rows="4" required
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white leading-relaxed">{{ old('teks_pertanyaan', $pertanyaan->teks_pertanyaan) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Jenis Jawaban -->
            <div>
                <label for="jenis" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Jenis Jawaban <span class="text-red-500">*</span>
                </label>
                <select id="jenis" name="jenis" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
                    <option value="Skala" {{ old('jenis', $pertanyaan->jenis) === 'Skala' ? 'selected' : '' }}>Skala Nilai 1 s/d 5</option>
                    <option value="Esai" {{ old('jenis', $pertanyaan->jenis) === 'Esai' ? 'selected' : '' }}>Esai / Isian Terbuka</option>
                </select>
            </div>

            <!-- Urutan Tampil -->
            <div>
                <label for="urutan" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Nomor Urut Tampil <span class="text-red-500">*</span>
                </label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $pertanyaan->urutan) }}" min="1" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
            </div>
        </div>

        <!-- Status & Indikator Inti -->
        <div class="space-y-3 pt-2">
            <div>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $pertanyaan->aktif) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-smanda-green shadow-sm focus:ring-smanda-green dark:bg-gray-900">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Pertanyaan Aktif (ditampilkan kepada responden)</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="inti" value="1" {{ old('inti', $pertanyaan->inti) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-smanda-green shadow-sm focus:ring-smanda-green dark:bg-gray-900">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tandai sebagai pertanyaan indikator inti</span>
                </label>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('survei.dashboard.sarpras.pertanyaan') }}"
               class="px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-sm font-bold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-smanda-green hover:bg-emerald-700 text-white text-sm font-bold shadow-sm transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection
