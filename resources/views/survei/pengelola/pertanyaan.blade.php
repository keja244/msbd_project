@extends('survei.layout.utama')

@section('title', 'Pertanyaan Survei - SMAN 2 Medan')

@section('isi')

@if($mode === 'index')

<section class="mb-8">
    <div class="text-smanda-green text-xs font-bold uppercase tracking-[0.15em] mb-2">
        Pengelolaan Survei
    </div>

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">
                Pertanyaan <span class="text-smanda-yellow">Survei</span>
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola pertanyaan untuk setiap periode survei.
            </p>
        </div>

        <a href="{{ route('survei.dashboard.pertanyaan.create') }}"
           class="px-5 py-3 rounded-xl bg-smanda-green text-white text-sm font-bold text-center hover:opacity-90">
            + Tambah Pertanyaan
        </a>
    </div>
</section>

@if(session('success'))
    <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-semibold">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
        <h2 class="font-bold text-gray-800 dark:text-white">Daftar Pertanyaan</h2>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ $pertanyaan->total() }} pertanyaan terdaftar
        </p>
    </div>

    @if($pertanyaan->isEmpty())
        <div class="text-center py-14 px-6">
            <div class="text-4xl text-gray-300 dark:text-gray-600 mb-4">?</div>
            <h3 class="font-bold text-gray-700 dark:text-gray-200 mb-1">
                Belum Ada Pertanyaan
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">
                Tambahkan pertanyaan untuk mulai menyusun survei.
            </p>
            <a href="{{ route('survei.dashboard.pertanyaan.create') }}"
               class="inline-block px-5 py-2.5 rounded-xl bg-smanda-green text-white text-sm font-bold">
                Tambah Pertanyaan
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">No.</th>
                        <th class="px-6 py-4">Pertanyaan</th>
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4">Aspek</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4">Urutan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($pertanyaan as $index => $p)
                    <tr class="text-gray-700 dark:text-gray-200">
                        <td class="px-6 py-4">
                            {{ $pertanyaan->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 min-w-[240px]">
                            <div class="font-semibold">{{ $p->teks_pertanyaan }}</div>
                            @if($p->inti)
                                <span class="inline-block mt-1 text-[10px] font-bold uppercase text-smanda-green">
                                    Pertanyaan Inti
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 min-w-[160px]">{{ $p->judul_survei }}</td>
                        <td class="px-6 py-4">{{ $p->nama_aspek }}</td>
                        <td class="px-6 py-4">{{ $p->jenis }}</td>
                        <td class="px-6 py-4">{{ $p->urutan }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $p->aktif ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ $p->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('survei.dashboard.pertanyaan.edit', $p->pertanyaan_id) }}"
                                   class="text-smanda-blue font-bold hover:underline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('survei.dashboard.pertanyaan.destroy', $p->pertanyaan_id) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 font-bold hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t border-gray-100 dark:border-gray-700">
            {{ $pertanyaan->links() }}
        </div>
    @endif
</div>

@else

<section class="mb-8">
    <div class="text-smanda-green text-xs font-bold uppercase tracking-[0.15em] mb-2">
        Pengelolaan Survei
    </div>

    <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">
        {{ $mode === 'create' ? 'Tambah' : 'Edit' }}
        <span class="text-smanda-yellow">Pertanyaan</span>
    </h1>

    <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $mode === 'create' ? 'Tambahkan pertanyaan ke periode survei.' : 'Perbarui informasi pertanyaan survei.' }}
    </p>
</section>

<form method="POST"
      action="{{ $mode === 'create' ? route('survei.dashboard.pertanyaan.store') : route('survei.dashboard.pertanyaan.update', $pertanyaanData->pertanyaan_id) }}"
      class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-6 sm:p-8 shadow-sm">

    @csrf
    @if($mode === 'edit')
        @method('PUT')
    @endif

    <div class="space-y-6">

        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">
                Periode Survei
            </label>
            <select name="survei_id" required
                    class="w-full rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-3">
                <option value="">Pilih periode survei</option>
                @foreach($survei as $s)
                    <option value="{{ $s->survei_id }}"
                        @selected(old('survei_id', $mode === 'edit' ? $pertanyaanData->survei_id : '') == $s->survei_id)>
                        {{ $s->judul_survei }}
                    </option>
                @endforeach
            </select>
            @error('survei_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">
                Aspek Pertanyaan
            </label>
            <select name="aspek_id" required
                    class="w-full rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-3">
                <option value="">Pilih aspek</option>
                @foreach($aspek as $a)
                    <option value="{{ $a->aspek_id }}"
                        @selected(old('aspek_id', $mode === 'edit' ? $pertanyaanData->aspek_id : '') == $a->aspek_id)>
                        {{ $a->nama_aspek }}
                    </option>
                @endforeach
            </select>
            @error('aspek_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">
                Teks Pertanyaan
            </label>
            <textarea name="teks_pertanyaan" rows="4" required
                      class="w-full rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-3"
                      placeholder="Masukkan teks pertanyaan">{{ old('teks_pertanyaan', $mode === 'edit' ? $pertanyaanData->teks_pertanyaan : '') }}</textarea>
            @error('teks_pertanyaan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">
                    Jenis Pertanyaan
                </label>
                <select name="jenis" required
                        class="w-full rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-3">
                    @foreach(['Skala', 'Pilihan', 'Esai'] as $jenis)
                        <option value="{{ $jenis }}"
                            @selected(old('jenis', $mode === 'edit' ? $pertanyaanData->jenis : 'Skala') === $jenis)>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
                @error('jenis')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-2">
                    Urutan Pertanyaan
                </label>
                <input type="number" name="urutan" min="1" required
                       value="{{ old('urutan', $mode === 'edit' ? $pertanyaanData->urutan : 1) }}"
                       class="w-full rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-3">
                @error('urutan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="inti" value="1"
                    @checked(old('inti', $mode === 'edit' ? $pertanyaanData->inti : false))
                    class="rounded border-gray-300 text-smanda-green">
                Pertanyaan inti
            </label>

            <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="aktif" value="1"
                    @checked(old('aktif', $mode === 'edit' ? $pertanyaanData->aktif : true))
                    class="rounded border-gray-300 text-smanda-green">
                Pertanyaan aktif
            </label>
        </div>

    </div>

    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
        <a href="{{ route('survei.dashboard.pertanyaan.index') }}"
           class="px-5 py-3 rounded-xl border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-sm font-bold text-center">
            Batal
        </a>

        <button type="submit"
                class="px-5 py-3 rounded-xl bg-smanda-green text-white text-sm font-bold hover:opacity-90">
            {{ $mode === 'create' ? 'Simpan Pertanyaan' : 'Simpan Perubahan' }}
        </button>
    </div>
</form>

@endif
@endsection