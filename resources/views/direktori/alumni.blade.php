@extends('layouts.app')

@section('title', 'Alumni - smanda')

@php
    // $perTahun dikirim dari AlumniController: [tahun => [['nama','tahun','kelas'], ...]] (3 tahun terakhir, terbaru dulu)
    $tahuns = array_keys($perTahun);
    $totalAlumni = array_sum(array_map('count', $perTahun));
    $semuaKelas = collect($perTahun)->flatten(1)->pluck('kelas')->unique()->sort()->values()->all();
@endphp

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <!-- HEADER -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Direktori</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">Alumni smanda</h1>
        <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] max-w-[800px]">
            Data lulusan smanda dalam {{ count($tahuns) }} tahun terakhir. Pilih tahun kelulusan, lalu cari nama atau saring berdasarkan kelas.
        </p>

        <!-- STATISTIK -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-[16px] mt-[32px] max-w-[900px]">
            <div class="bg-white dark:bg-gray-800 rounded-[16px] p-[18px] border border-gray-100 dark:border-gray-700 shadow-sm">
                <p class="text-[1.8rem] font-extrabold text-smanda-green-dark dark:text-smanda-green leading-none">{{ $totalAlumni }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-[6px] font-medium">Total alumni</p>
            </div>
            @foreach ($perTahun as $th => $rows)
                <div class="bg-white dark:bg-gray-800 rounded-[16px] p-[18px] border border-gray-100 dark:border-gray-700 shadow-sm">
                    <p class="text-[1.8rem] font-extrabold leading-none {{ $loop->index === 0 ? 'text-smanda-blue' : ($loop->index === 1 ? 'text-smanda-yellow-hover' : 'text-smanda-red') }}">{{ count($rows) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-[6px] font-medium">Lulusan {{ $th }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- TABEL ALUMNI -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px]">

        <!-- TAB TAHUN -->
        <div class="flex flex-wrap gap-[10px] mb-[20px]" role="tablist" aria-label="Tahun kelulusan">
            @foreach ($perTahun as $th => $rows)
                <button type="button" role="tab" data-tahun="{{ $th }}"
                        class="tab-tahun px-[20px] py-[9px] rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors">
                    Angkatan {{ $th }}
                    <span class="ml-[6px] text-[0.7rem] font-bold opacity-70">{{ count($rows) }}</span>
                </button>
            @endforeach
        </div>

        <!-- ALAT: cari, kelas, unduh -->
        <div class="flex flex-col lg:flex-row lg:items-center gap-[12px] mb-[16px]">
            <input type="search" id="cari-alumni" placeholder="Cari nama alumni..."
                   class="w-full lg:w-[320px] px-[16px] py-[10px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green">

            <select id="filter-kelas" aria-label="Filter kelas"
                    class="w-full lg:w-[200px] px-[16px] py-[10px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green">
                <option value="semua">Semua kelas</option>
                @foreach ($semuaKelas as $k)
                    <option value="{{ strtolower($k) }}">{{ $k }}</option>
                @endforeach
            </select>

            <p id="info-hasil" class="text-sm text-gray-500 dark:text-gray-400 lg:ml-[8px]"></p>

            <button type="button" id="btn-unduh"
                    class="lg:ml-auto inline-flex items-center justify-center gap-[8px] px-[20px] py-[9px] rounded-full border border-smanda-green text-smanda-green hover:bg-smanda-green hover:text-white text-sm font-bold transition-colors">
                Unduh CSV (Excel)
            </button>
        </div>

        <!-- PANEL PER TAHUN -->
        @foreach ($perTahun as $th => $rows)
            <div class="panel-tahun hidden" data-tahun="{{ $th }}">
                <div class="bg-white dark:bg-gray-800 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="overflow-auto max-h-[70vh]">
                        <table class="w-full min-w-[560px] text-sm border-collapse">
                            <thead>
                                <tr class="text-left text-[0.72rem] uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                    <th class="sticky top-0 z-10 w-[64px] px-[16px] py-[12px] bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">No</th>
                                    <th data-urut="nama" class="sticky top-0 z-10 px-[16px] py-[12px] bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 cursor-pointer select-none hover:text-smanda-green">Nama Alumni <span class="panah opacity-40">&#8645;</span></th>
                                    <th class="sticky top-0 z-10 w-[140px] px-[16px] py-[12px] bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">Tahun Lulus</th>
                                    <th data-urut="kelas" class="sticky top-0 z-10 w-[200px] px-[16px] py-[12px] bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 cursor-pointer select-none hover:text-smanda-green">Kelas <span class="panah opacity-40">&#8645;</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $a)
                                    <tr class="baris odd:bg-white even:bg-gray-50/70 dark:odd:bg-gray-800 dark:even:bg-gray-800/60 hover:bg-smanda-green-light dark:hover:bg-gray-700 transition-colors"
                                        data-nama="{{ strtolower($a['nama']) }}" data-kelas="{{ strtolower($a['kelas']) }}">
                                        <td class="no px-[16px] py-[10px] text-gray-400 border-b border-gray-100 dark:border-gray-700">{{ $loop->iteration }}</td>
                                        <td class="px-[16px] py-[10px] font-semibold text-gray-800 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700">{{ $a['nama'] }}</td>
                                        <td class="px-[16px] py-[10px] text-gray-600 dark:text-gray-300 border-b border-gray-100 dark:border-gray-700">{{ $a['tahun'] }}</td>
                                        <td class="px-[16px] py-[10px] border-b border-gray-100 dark:border-gray-700">
                                            <span class="text-[0.72rem] font-bold px-[10px] py-[3px] rounded-full {{ str_contains($a['kelas'], 'IPS') ? 'bg-smanda-yellow/25 text-yellow-700 dark:text-smanda-yellow' : 'bg-smanda-green-light text-smanda-green-dark' }}">{{ $a['kelas'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="kosong hidden p-[28px] text-center text-gray-500 dark:text-gray-400">Tidak ada alumni yang cocok dengan pencarianmu.</p>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- AJAKAN -->
    <section class="max-w-[1280px] mx-auto px-[24px]">
        <div class="rounded-[20px] bg-smanda-green-light dark:bg-gray-800 border border-smanda-green/30 dark:border-gray-700 p-[32px] sm:p-[44px] flex flex-col md:flex-row md:items-center md:justify-between gap-[20px]">
            <div>
                <h2 class="text-[1.6rem] font-extrabold text-smanda-green-dark dark:text-smanda-green mb-[8px]">Namamu belum ada atau datanya keliru?</h2>
                <p class="text-[0.98rem] text-[#4a5568] dark:text-gray-300 font-light leading-[1.7] max-w-[620px]">
                    Hubungi sekolah untuk memperbarui data alumni agar tetap lengkap dan benar.
                </p>
            </div>
            <a href="{{ url('/kontak') }}"
               class="inline-flex items-center justify-center gap-[8px] px-[28px] py-[12px] rounded-full bg-smanda-green hover:bg-smanda-green-dark text-white text-sm font-bold uppercase tracking-wider transition-colors whitespace-nowrap">
                Hubungi Sekolah &rarr;
            </a>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = Array.from(document.querySelectorAll('.tab-tahun'));
        const panels = Array.from(document.querySelectorAll('.panel-tahun'));
        const input = document.getElementById('cari-alumni');
        const selKelas = document.getElementById('filter-kelas');
        const info = document.getElementById('info-hasil');
        const aktifCls = ['bg-smanda-green', 'text-white', 'border-smanda-green'];
        const nonAktifCls = ['bg-white', 'dark:bg-gray-800', 'text-gray-600', 'dark:text-gray-300'];
        const urutan = {};   // arah urut per panel + kolom
        let tahun = null;

        const panelAktif = () => panels.find(p => p.dataset.tahun === tahun);

        function terapkan() {
            const panel = panelAktif();
            if (!panel) return;
            const q = input.value.trim().toLowerCase();
            const kls = selKelas.value;
            const rows = Array.from(panel.querySelectorAll('tr.baris'));
            let n = 0;

            rows.forEach(r => {
                const cocok = (kls === 'semua' || r.dataset.kelas === kls)
                           && (q === '' || r.dataset.nama.includes(q));
                r.classList.toggle('hidden', !cocok);
                if (cocok) r.querySelector('.no').textContent = ++n;
            });

            info.textContent = n + ' dari ' + rows.length + ' alumni';
            panel.querySelector('.kosong').classList.toggle('hidden', n !== 0);
        }

        function setTab(th) {
            tahun = th;
            panels.forEach(p => p.classList.toggle('hidden', p.dataset.tahun !== th));
            tabs.forEach(b => {
                const on = b.dataset.tahun === th;
                b.setAttribute('aria-selected', on);
                aktifCls.forEach(c => b.classList.toggle(c, on));
                nonAktifCls.forEach(c => b.classList.toggle(c, !on));
            });
            history.replaceState(null, '', '#' + th);
            terapkan();
        }

        // Urutkan kolom nama / kelas dengan klik judul kolom
        document.querySelectorAll('th[data-urut]').forEach(th => {
            th.addEventListener('click', () => {
                const panel = th.closest('.panel-tahun');
                const kunci = th.dataset.urut;
                const id = panel.dataset.tahun + kunci;
                urutan[id] = urutan[id] === 'asc' ? 'desc' : 'asc';
                const arah = urutan[id] === 'asc' ? 1 : -1;
                const tbody = panel.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr.baris'));

                rows.sort((a, b) => arah * a.dataset[kunci].localeCompare(b.dataset[kunci], 'id', { numeric: true })
                                  || a.dataset.nama.localeCompare(b.dataset.nama, 'id'));
                rows.forEach(r => tbody.appendChild(r));

                panel.querySelectorAll('.panah').forEach(p => p.innerHTML = '&#8645;');
                th.querySelector('.panah').innerHTML = arah === 1 ? '&#9650;' : '&#9660;';
                terapkan();
            });
        });

        // Unduh data yang sedang tampil sebagai CSV (bisa dibuka di Excel / Google Sheets)
        document.getElementById('btn-unduh').addEventListener('click', () => {
            const panel = panelAktif();
            if (!panel) return;
            const esc = s => '"' + String(s).replace(/"/g, '""') + '"';
            const baris = [['No', 'Nama Alumni', 'Tahun Lulus', 'Kelas'].map(esc).join(',')];

            panel.querySelectorAll('tr.baris:not(.hidden)').forEach(r => {
                const sel = r.querySelectorAll('td');
                baris.push([sel[0].textContent, sel[1].textContent, sel[2].textContent, sel[3].textContent.trim()].map(esc).join(','));
            });

            const blob = new Blob(['\ufeff' + baris.join('\r\n')], { type: 'text/csv;charset=utf-8;' });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'alumni-' + tahun + '.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(a.href);
        });

        tabs.forEach(b => b.addEventListener('click', () => setTab(b.dataset.tahun)));
        input.addEventListener('input', terapkan);
        selKelas.addEventListener('change', terapkan);

        const awal = location.hash.replace('#', '');
        setTab(tabs.some(b => b.dataset.tahun === awal) ? awal : tabs[0].dataset.tahun);
    });
</script>
@endpush