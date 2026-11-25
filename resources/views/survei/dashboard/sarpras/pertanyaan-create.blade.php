@extends('survei.dashboard.layout')

@section('title', 'Buat Pertanyaan Survei Sarpras - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('survei.dashboard.sarpras.pertanyaan') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline">
            ← Kembali ke Daftar Pertanyaan
        </a>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2d3748] dark:text-gray-100">
        Buat Pertanyaan Survei Sarpras
    </h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
        Tambahkan butir pertanyaan untuk mengukur kepuasan warga sekolah terhadap sarana & prasarana.
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

    <form method="POST" action="{{ route('survei.dashboard.sarpras.pertanyaan.store') }}" class="space-y-6">
        @csrf

        <!-- Aspek Penilaian (Locked to Sarana dan Prasarana) -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Aspek Survei Terkait
            </label>
            <div class="px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 text-sm font-bold text-gray-700 dark:text-gray-200 flex items-center justify-between">
                <span>{{ $aspekSarpras->nama_aspek ?? 'Sarana dan Prasarana' }} (Aspek ID: 4)</span>
                <span class="text-xs font-medium px-2 py-0.5 rounded bg-blue-100 dark:bg-blue-900/40 text-smanda-blue">Khusus Role Sarpras</span>
            </div>
            <p class="text-xs text-gray-400 mt-1">Role Sarpras secara otomatis terikat pada aspek Sarana dan Prasarana dalam basis data.</p>
        </div>

        <!-- Teks Pertanyaan -->
        <div>
            <label for="teks_pertanyaan" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Teks Pertanyaan Survei <span class="text-red-500">*</span>
            </label>
            <textarea id="teks_pertanyaan" name="teks_pertanyaan" rows="4" required
                      placeholder="Contoh: Bagaimana pendapat Anda mengenai kelengkapan fasilitas dan perangkat komputer di laboratorium sekolah?"
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white leading-relaxed">{{ old('teks_pertanyaan') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Gunakan bahasa yang jelas, mudah dipahami, dan netral bagi responden.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Jenis Jawaban -->
            <div>
                <label for="jenis" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Jenis Jawaban <span class="text-red-500">*</span>
                </label>
                <select id="jenis" name="jenis" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
                    <option value="Skala" {{ old('jenis', 'Skala') === 'Skala' ? 'selected' : '' }}>Skala Nilai 1 s/d 5 (Sangat Tidak Puas - Sangat Puas)</option>
                    <option value="Esai" {{ old('jenis') === 'Esai' ? 'selected' : '' }}>Esai / Isian Terbuka (Saran & Kritik)</option>
                </select>
            </div>

            <!-- Urutan Tampil -->
            <div>
                <label for="urutan" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Nomor Urut Tampil
                </label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $urutanBerikutnya) }}" min="1"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
            </div>
        </div>

        <!-- Opsi Tambahan -->
        <div class="pt-2">
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="inti" value="1" {{ old('inti') ? 'checked' : '' }}
                       class="rounded border-gray-300 text-smanda-green shadow-sm focus:ring-smanda-green dark:bg-gray-900">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tandai sebagai pertanyaan indikator inti (inti = 1)</span>
            </label>
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
                <span>Simpan Pertanyaan Survei</span>
            </button>
        </div>
    </form>
</div>
@endsection
