
@extends('survei.layout.utama')

@section('title', 'Pengelolaan Aspek Survei')

@section('isi')

<section class="mb-8">
    <div class="text-smanda-green text-xs font-bold uppercase tracking-widest mb-2">
        Pengaturan Survei
    </div>
    <h1 class="text-2xl sm:text-3xl font-bold mb-2">
        Pengelolaan Aspek
    </h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">
        Kelola aspek yang digunakan dalam penyusunan pertanyaan survei.
    </p>
</section>

@if (session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 text-sm">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700 text-sm">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($mode === 'index')

    <div class="flex justify-end mb-5">
        <a href="{{ route('survei.dashboard.aspek.create') }}"
           class="px-5 py-3 rounded-xl bg-smanda-green text-white text-sm font-bold hover:opacity-90">
            + Tambah Aspek
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        @if ($aspek->isEmpty())
            <div class="p-8 text-center text-gray-500">
                Belum ada aspek survei.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                        <tr>
                            <th class="p-4">No.</th>
                            <th class="p-4">Nama Aspek</th>
                            <th class="p-4">Bobot</th>
                            <th class="p-4">Jenis</th>
                            <th class="p-4">Deskripsi</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aspek as $item)
                            <tr class="border-t border-gray-100 dark:border-gray-700">
                                <td class="p-4">{{ $loop->iteration }}</td>
                                <td class="p-4 font-semibold">{{ $item->nama_aspek }}</td>
                                <td class="p-4">{{ $item->bobot }}</td>
                                <td class="p-4">
                                    {{ $item->bersama ? 'Bersama' : 'Khusus' }}
                                </td>
                                <td class="p-4">{{ $item->deskripsi ?: '-' }}</td>
                                <td class="p-4">
                                    <div class="flex gap-3">
                                        <a href="{{ route('survei.dashboard.aspek.edit', $item->aspek_id) }}"
                                           class="text-blue-600 font-semibold">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('survei.dashboard.aspek.destroy', $item->aspek_id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus aspek ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 font-semibold">
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
        @endif
    </div>

@elseif (in_array($mode, ['create', 'edit']))

    @php
        $isEdit = $mode === 'edit';
        $formAction = $isEdit
            ? route('survei.dashboard.aspek.update', $aspekData->aspek_id)
            : route('survei.dashboard.aspek.store');
    @endphp

    <div class="max-w-2xl bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-8">

        <h2 class="text-xl font-bold mb-6">
            {{ $isEdit ? 'Edit Aspek' : 'Tambah Aspek' }}
        </h2>

        <form method="POST" action="{{ $formAction }}" class="space-y-5">
            @csrf

            @if ($isEdit)
                @method('PUT')
            @endif

            <div>
                <label class="block text-sm font-semibold mb-2">Nama Aspek</label>
                <input type="text"
                       name="nama_aspek"
                       value="{{ old('nama_aspek', $aspekData->nama_aspek ?? '') }}"
                       required
                       maxlength="100"
                       class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Bobot</label>
                <input type="number"
                       name="bobot"
                       value="{{ old('bobot', $aspekData->bobot ?? '1.00') }}"
                       min="0"
                       max="999.99"
                       step="0.01"
                       class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi"
                          rows="4"
                          class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('deskripsi', $aspekData->deskripsi ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Jenis Aspek</label>
                <select name="bersama" required
                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="1" {{ (string) old('bersama', $aspekData->bersama ?? 1) === '1' ? 'selected' : '' }}>
                        Bersama
                    </option>
                    <option value="0" {{ (string) old('bersama', $aspekData->bersama ?? 1) === '0' ? 'selected' : '' }}>
                        Khusus
                    </option>
                </select>
            </div>


            <div>
                <label class="block text-sm font-semibold mb-2">
                    Divisi Pengelola
                </label>

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                    Pilih divisi yang berhak membuat dan mengelola pertanyaan pada aspek ini.
                </p>

                <div class="space-y-3">
                    @foreach ($roles as $role)
                        <label class="flex items-center gap-3 text-sm">
                            <input
                                type="checkbox"
                                name="role_ids[]"
                                value="{{ $role->role_id }}"
                                {{ in_array(
                                    (int) $role->role_id,
                                    old('role_ids', $selectedRoleIds ?? []),
                                    true
                                ) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-smanda-green focus:ring-smanda-green"
                            >
                            {{ $role->nama_role }}
                        </label>
                    @endforeach
                </div>
            </div>


            <div class="flex gap-3 pt-3">
                <button type="submit"
                        class="px-5 py-3 rounded-xl bg-smanda-green text-white text-sm font-bold">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Aspek' }}
                </button>

                <a href="{{ route('survei.dashboard.aspek.index') }}"
                   class="px-5 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-bold">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endif

@endsection
