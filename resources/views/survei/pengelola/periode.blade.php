
@extends('survei.layout.utama')

@section('title', 'Periode Survei - SMAN 2 Medan')

@section('isi')

<section class="mb-8">
    <div class="text-smanda-blue dark:text-blue-400 text-xs font-bold uppercase tracking-widest mb-2">
        Pengelolaan Survei
    </div>

    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
        Periode Survei
    </h1>

    <p class="text-gray-500 dark:text-gray-400 mt-2">
        Kelola periode pelaksanaan survei sekolah.
    </p>
</section>

@if(session('success'))
    <div class="mb-6 rounded-xl bg-green-100 text-green-800 p-4">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 rounded-xl bg-red-100 text-red-800 p-4">
        <p class="font-semibold mb-2">Periksa kembali data berikut:</p>
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($mode === 'index')

    <div class="flex justify-end mb-6">
        <a href="{{ route('survei.dashboard.periode.create') }}"
           class="px-5 py-3 rounded-xl bg-blue-700 text-white font-semibold hover:bg-blue-800">
            + Tambah Periode
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
        @if($periode->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                        <tr>
                            <th class="p-4">Judul Survei</th>
                            <th class="p-4">Tahun Ajaran</th>
                            <th class="p-4">Semester</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($periode as $p)
                            <tr class="text-gray-700 dark:text-gray-200">
                                <td class="p-4 font-medium">
                                    {{ $p->judul_survei }}
                                </td>
                                <td class="p-4">{{ $p->tahun_ajaran }}</td>
                                <td class="p-4">{{ $p->semester }}</td>
                                <td class="p-4">
                                    {{ $p->tanggal_mulai }} s.d. {{ $p->tanggal_selesai }}
                                </td>
                                <td class="p-4">{{ $p->status }}</td>
                                <td class="p-4">
                                    <div class="flex gap-3">
                                        <a href="{{ route('survei.dashboard.periode.edit', $p->survei_id) }}"
                                           class="text-blue-600 hover:underline">
                                            Edit
                                        </a>

                                        <form action="{{ route('survei.dashboard.periode.destroy', $p->survei_id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus periode survei ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-600 hover:underline">
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

            <div class="p-4">
                {{ $periode->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <h3 class="font-semibold text-gray-800 dark:text-white">
                    Belum Ada Periode Survei
                </h3>
                <p class="text-sm text-gray-500 mt-2">
                    Tambahkan periode survei untuk mulai mengelola pertanyaan.
                </p>
            </div>
        @endif
    </div>

@else

    @php
        $edit = $mode === 'edit';
        $action = $edit
            ? route('survei.dashboard.periode.update', $periodeData->survei_id)
            : route('survei.dashboard.periode.store');
    @endphp

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
            {{ $edit ? 'Edit Periode Survei' : 'Tambah Periode Survei' }}
        </h2>

        <form action="{{ $action }}" method="POST" class="space-y-5">
            @csrf

            @if($edit)
                @method('PUT')
            @endif

            <div>
                <label class="block text-sm font-medium mb-2">Judul Survei</label>
                <input type="text" name="judul_survei"
                    value="{{ old('judul_survei', $edit ? $periodeData->judul_survei : '') }}"
                    maxlength="150" required
                    class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">{{ old('deskripsi', $edit ? $periodeData->deskripsi : '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium mb-2">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran"
                        placeholder="Contoh: 2026/2027"
                        value="{{ old('tahun_ajaran', $edit ? $periodeData->tahun_ajaran : '') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Semester</label>
                    <select name="semester" required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                        <option value="">Pilih Semester</option>
                        <option value="1" @selected(old('semester', $edit ? $periodeData->semester : '') == 1)>Semester 1</option>
                        <option value="2" @selected(old('semester', $edit ? $periodeData->semester : '') == 2)>Semester 2</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai"
                        value="{{ old('tanggal_mulai', $edit ? $periodeData->tanggal_mulai : '') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai"
                        value="{{ old('tanggal_selesai', $edit ? $periodeData->tanggal_selesai : '') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Status</label>
                <select name="status" required
                    class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                    @foreach(['Aktif', 'Selesai', 'Arsip'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $edit ? $periodeData->status : 'Aktif') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Metode IKM</label>
                <select name="metode_ikm" required
                    class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                    @foreach(['INTERNAL', 'KONVERSI', 'BOTH'] as $metode)
                        <option value="{{ $metode }}"
                            @selected(old('metode_ikm', $edit ? $periodeData->metode_ikm : 'BOTH') === $metode)>
                            {{ $metode }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium mb-2">Skala Minimum</label>
                    <input type="number" name="skala_min" min="1" max="10"
                        value="{{ old('skala_min', $edit ? $periodeData->skala_min : 1) }}"
                        required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Skala Maksimum</label>
                    <input type="number" name="skala_max" min="2" max="10"
                        value="{{ old('skala_max', $edit ? $periodeData->skala_max : 4) }}"
                        required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Faktor Konversi</label>
                    <input type="number" name="faktor_konversi" min="0.01" step="0.01"
                        value="{{ old('faktor_konversi', $edit ? $periodeData->faktor_konversi : 25) }}"
                        required
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 p-3">
                </div>
            </div>


            {{-- Pengaturan Aspek dan Kategori --}}
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                    Aspek Survei
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">
                    Pilih aspek yang digunakan dalam periode ini dan tentukan kategori respondennya.
                </p>

                @php
                    $pilihanAspek = old(
                        'aspek_ids',
                        $edit ? ($aspekTerpilih ?? []) : []
                    );

                    $pilihanSemua = old(
                        'semua_kategori',
                        $edit ? ($semuaKategori ?? []) : []
                    );

                    $pilihanKategori = old(
                        'kategori_ids',
                        $edit ? ($kategoriTerpilih ?? []) : []
                    );
                @endphp

                <div class="space-y-5">
                    @forelse($aspek as $item)
                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                            <label class="flex items-center gap-3 font-semibold text-gray-800 dark:text-white">
                                <input
                                    type="checkbox"
                                    name="aspek_ids[]"
                                    value="{{ $item->aspek_id }}"
                                    @checked(in_array($item->aspek_id, $pilihanAspek))
                                    class="rounded border-gray-300 text-blue-700 focus:ring-blue-600"
                                >

                                {{ $item->nama_aspek }}
                            </label>

                            <div class="mt-4 ml-7 space-y-3">
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                    <input
                                        type="checkbox"
                                        name="semua_kategori[{{ $item->aspek_id }}]"
                                        value="1"
                                        @checked(
                                            in_array($item->aspek_id, $pilihanSemua) ||
                                            isset($pilihanSemua[$item->aspek_id])
                                        )
                                        class="rounded border-gray-300 text-blue-700"
                                    >
                                    Berlaku untuk semua kategori
                                </label>

                                <div class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Atau pilih kategori tertentu:
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    @foreach($kategori as $k)
                                        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                            <input
                                                type="checkbox"
                                                name="kategori_ids[{{ $item->aspek_id }}][]"
                                                value="{{ $k->kategori_id }}"
                                                @checked(in_array(
                                                    $k->kategori_id,
                                                    $pilihanKategori[$item->aspek_id] ?? []
                                                ))
                                                class="rounded border-gray-300 text-blue-700"
                                            >
                                            {{ $k->nama }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">
                            Belum ada aspek yang tersedia. Tambahkan aspek terlebih dahulu.
                        </p>
                    @endforelse
                </div>
            </div>


            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-700 text-white font-semibold hover:bg-blue-800">
                    {{ $edit ? 'Simpan Perubahan' : 'Simpan Periode' }}
                </button>

                <a href="{{ route('survei.dashboard.periode.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endif

@endsection
