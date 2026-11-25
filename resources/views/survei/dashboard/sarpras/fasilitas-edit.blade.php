@extends('survei.dashboard.layout')

@section('title', 'Edit Fasilitas Sarpras - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('survei.dashboard.sarpras.index') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green hover:underline">
            ← Kembali ke Daftar Fasilitas
        </a>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2d3748] dark:text-gray-100">
        Edit Fasilitas Sarpras
    </h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
        Perbarui data penjelasan atau ganti gambar fasilitas sarpras.
    </p>
</section>

<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 sm:p-8 shadow-sm max-w-3xl">

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

    <form method="POST" action="{{ route('survei.dashboard.sarpras.update', $fasilitas->sarpras_id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama Fasilitas -->
        <div>
            <label for="nama_fasilitas" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Nama Fasilitas / Ruangan <span class="text-red-500">*</span>
            </label>
            <input type="text" id="nama_fasilitas" name="nama_fasilitas" value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" required
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <!-- Kategori -->
            <div>
                <label for="kategori" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $fasilitas->kategori) }}" required
                       list="kategori-list"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
                <datalist id="kategori-list">
                    <option value="Laboratorium">
                    <option value="Ruang Kelas">
                    <option value="Kerohanian">
                    <option value="Literasi">
                    <option value="Olahraga">
                    <option value="Sanitasi">
                    <option value="Kantin">
                    <option value="Tata Usaha">
                    <option value="UKS">
                </datalist>
            </div>

            <!-- Kondisi -->
            <div>
                <label for="kondisi" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Kondisi Fasilitas <span class="text-red-500">*</span>
                </label>
                <select id="kondisi" name="kondisi" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
                    <option value="Baik" {{ old('kondisi', $fasilitas->kondisi) === 'Baik' ? 'selected' : '' }}>Baik (Layak Pakai)</option>
                    <option value="Rusak Ringan" {{ old('kondisi', $fasilitas->kondisi) === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="Rusak Berat" {{ old('kondisi', $fasilitas->kondisi) === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <!-- Jumlah -->
            <div>
                <label for="jumlah" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                    Jumlah Unit <span class="text-red-500">*</span>
                </label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $fasilitas->jumlah) }}" min="1" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
            </div>
        </div>

        <!-- Foto Saat Ini & Upload Baru -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Foto Fasilitas
            </label>
            @if($fasilitas->foto)
                <div class="mb-3 flex items-center gap-4">
                    <img src="{{ asset($fasilitas->foto) }}" alt="{{ $fasilitas->nama_fasilitas }}"
                         class="w-24 h-16 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shadow-sm"
                         onerror="this.src='{{ asset('images/slide1.jpeg') }}'">
                    <span class="text-xs text-gray-500">Foto saat ini tersimpan di database. Pilih file di bawah jika ingin mengganti.</span>
                </div>
            @endif
            <div class="border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl p-6 text-center hover:border-smanda-green transition-colors">
                <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-smanda-green/10 file:text-smanda-green hover:file:bg-smanda-green/20 cursor-pointer">
                <p class="text-xs text-gray-400 mt-2">Format: JPG, JPEG, PNG, WEBP (Maksimal 3MB). Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>
        </div>

        <!-- Keterangan Singkat -->
        <div>
            <label for="keterangan" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Keterangan Singkat (Opsional)
            </label>
            <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $fasilitas->keterangan) }}"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white">
        </div>

        <!-- Penjelasan / Deskripsi Lengkap -->
        <div>
            <label for="deskripsi" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">
                Penjelasan / Deskripsi Fasilitas <span class="text-red-500">*</span>
            </label>
            <textarea id="deskripsi" name="deskripsi" rows="5" required
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green dark:text-white leading-relaxed">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('survei.dashboard.sarpras.index') }}"
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
