@extends('layouts.app')

@section('title', 'Kalender Akademik - smanda Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 text-[#2d3748] dark:text-gray-100 font-sans pt-[100px] sm:pt-[110px] pb-[80px] transition-colors duration-300">

    <!-- HEADER -->
    <section class="max-w-[1280px] mx-auto px-[24px] py-[40px] border-b border-gray-200/60 dark:border-gray-800">
        <span class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[8px]">Akademik</span>
        <h1 class="text-[2.5rem] sm:text-[3.2rem] font-extrabold text-[#4a5568] dark:text-gray-100 leading-[1.2] mb-[16px]">
            Kalender Akademik
        </h1>
        <p class="text-[1.05rem] text-[#718096] dark:text-gray-400 font-light leading-[1.7] max-w-[800px]">
            Pantau jadwal kegiatan belajar, penilaian, hari libur, dan agenda penting smanda Medan sepanjang tahun ajaran.
        </p>
        <a href="{{ url('/akademik/kalender-tahunan') }}"
           class="inline-flex items-center gap-[8px] mt-[20px] px-[20px] py-[10px] rounded-full border border-smanda-green text-smanda-green hover:bg-smanda-green hover:text-white text-sm font-bold transition-colors">
            Lihat Kalender Tahunan &rarr;
        </a>
    </section>

    <section class="max-w-[1280px] mx-auto px-[24px] py-[50px]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-[28px]">

            <!-- ========== KALENDER ========== -->
            <div class="lg:col-span-8 bg-white dark:bg-gray-800 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm p-[16px] sm:p-[28px]">

                <!-- Toolbar: bulan, tahun, navigasi -->
                <div class="flex flex-wrap items-center justify-between gap-[12px] mb-[20px]">
                    <div class="flex items-center gap-[8px]">
                        <button type="button" id="btn-prev" aria-label="Bulan sebelumnya"
                                class="w-[38px] h-[38px] rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 text-lg leading-none transition-colors">&#8249;</button>
                        <button type="button" id="btn-next" aria-label="Bulan berikutnya"
                                class="w-[38px] h-[38px] rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 text-lg leading-none transition-colors">&#8250;</button>
                        <h2 id="judul-bulan" class="text-[1.4rem] sm:text-[1.7rem] font-extrabold text-[#4a5568] dark:text-gray-100 ml-[8px]"></h2>
                    </div>

                    <div class="flex items-center gap-[8px]">
                        <select id="pilih-bulan" aria-label="Pilih bulan"
                                class="px-[12px] py-[8px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green"></select>
                        <select id="pilih-tahun" aria-label="Pilih tahun"
                                class="px-[12px] py-[8px] rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-smanda-green"></select>
                        <button type="button" id="btn-hari-ini"
                                class="px-[16px] py-[8px] rounded-full bg-smanda-green hover:bg-smanda-green-dark text-white text-sm font-bold transition-colors">Hari Ini</button>
                    </div>
                </div>

                <!-- Nama hari -->
                <div id="nama-hari" class="grid grid-cols-7 gap-[6px] mb-[6px] text-center text-[0.72rem] sm:text-xs font-bold uppercase tracking-wider text-gray-400"></div>

                <!-- Tanggal -->
                <div id="kal-grid" class="grid grid-cols-7 gap-[6px]"></div>

                <!-- Legenda -->
                <div class="flex flex-wrap gap-x-[20px] gap-y-[8px] mt-[24px] pt-[18px] border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
                    <span class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-full bg-smanda-green"></span>Akademik</span>
                    <span class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-full bg-smanda-yellow"></span>Ujian / Penilaian</span>
                    <span class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-full bg-smanda-red"></span>Libur</span>
                    <span class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-full bg-smanda-blue"></span>Kegiatan</span>
                </div>
            </div>

            <!-- ========== AGENDA ========== -->
            <aside class="lg:col-span-4 bg-white dark:bg-gray-800 rounded-[16px] border border-gray-100 dark:border-gray-700 shadow-sm p-[20px] sm:p-[28px] self-start">
                <span id="agenda-label" class="text-xs font-bold tracking-[2px] text-smanda-green uppercase block mb-[6px]">Agenda Bulan Ini</span>
                <h3 id="agenda-judul" class="text-[1.3rem] font-extrabold text-[#4a5568] dark:text-gray-100 mb-[4px]"></h3>
                <button type="button" id="btn-reset-pilihan" class="hidden text-xs font-bold text-smanda-green hover:underline mb-[10px]">&larr; Lihat seluruh bulan</button>
                <ul id="agenda-list" class="mt-[14px] space-y-[12px]"></ul>
            </aside>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ---------- DATA & KONSTANTA ----------
        const EVENTS = @json($events);
        const BULAN = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const BULAN_PENDEK = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const HARI = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];   // minggu dimulai hari Senin
        const TAHUN_AWAL = 2020, TAHUN_AKHIR = 2035;

        const KATEGORI = {
            akademik: { label: 'Akademik', dot: 'bg-smanda-green',  badge: 'bg-smanda-green/15 text-smanda-green-dark' },
            ujian:    { label: 'Ujian',    dot: 'bg-smanda-yellow', badge: 'bg-smanda-yellow/25 text-yellow-700' },
            libur:    { label: 'Libur',    dot: 'bg-smanda-red',    badge: 'bg-smanda-red/10 text-smanda-red' },
            kegiatan: { label: 'Kegiatan', dot: 'bg-smanda-blue',   badge: 'bg-smanda-blue/10 text-smanda-blue' },
        };

        // ---------- ELEMEN ----------
        const elGrid = document.getElementById('kal-grid');
        const elJudul = document.getElementById('judul-bulan');
        const elBulan = document.getElementById('pilih-bulan');
        const elTahun = document.getElementById('pilih-tahun');
        const elAgendaLabel = document.getElementById('agenda-label');
        const elAgendaJudul = document.getElementById('agenda-judul');
        const elAgendaList = document.getElementById('agenda-list');
        const elReset = document.getElementById('btn-reset-pilihan');

        // ---------- STATE ----------
        const sekarang = new Date();
        let bulan = sekarang.getMonth();
        let tahun = sekarang.getFullYear();
        let dipilih = null;   // string 'YYYY-MM-DD' atau null

        // ---------- HELPER ----------
        const pad = n => String(n).padStart(2, '0');
        const iso = (y, m, d) => y + '-' + pad(m + 1) + '-' + pad(d);
        const hariIni = iso(sekarang.getFullYear(), sekarang.getMonth(), sekarang.getDate());
        const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

        function eventsPada(tgl) {
            return EVENTS.filter(e => tgl >= e.tanggal && tgl <= (e.sampai || e.tanggal));
        }
        function eventsBulan(y, m) {
            const awal = iso(y, m, 1);
            const akhir = iso(y, m, new Date(y, m + 1, 0).getDate());
            return EVENTS
                .filter(e => e.tanggal <= akhir && (e.sampai || e.tanggal) >= awal)
                .sort((a, b) => a.tanggal.localeCompare(b.tanggal));
        }
        function formatTgl(s) {
            const [y, m, d] = s.split('-').map(Number);
            return d + ' ' + BULAN_PENDEK[m - 1] + (y !== tahun ? ' ' + y : '');
        }
        function formatRentang(e) {
            return e.sampai && e.sampai !== e.tanggal ? formatTgl(e.tanggal) + ' – ' + formatTgl(e.sampai) : formatTgl(e.tanggal);
        }

        // ---------- ISI DROPDOWN & NAMA HARI (sekali saja) ----------
        BULAN.forEach((nama, i) => elBulan.add(new Option(nama, i)));
        for (let y = TAHUN_AWAL; y <= TAHUN_AKHIR; y++) elTahun.add(new Option(y, y));

        document.getElementById('nama-hari').innerHTML = HARI.map((h, i) =>
            '<div class="py-[6px] ' + (i === 6 ? 'text-smanda-red' : '') + '">' + h + '</div>'
        ).join('');

        // ---------- RENDER KALENDER ----------
        function renderKalender() {
            elJudul.textContent = BULAN[bulan] + ' ' + tahun;
            elBulan.value = bulan;
            elTahun.value = tahun;

            const offset = (new Date(tahun, bulan, 1).getDay() + 6) % 7;     // Senin = 0
            const jumlahHari = new Date(tahun, bulan + 1, 0).getDate();
            let html = '';

            for (let i = 0; i < offset; i++) html += '<div></div>';

            for (let d = 1; d <= jumlahHari; d++) {
                const tgl = iso(tahun, bulan, d);
                const kolom = (offset + d - 1) % 7;                          // 6 = Minggu
                const adaEvent = eventsPada(tgl);
                const isHariIni = tgl === hariIni;
                const isDipilih = tgl === dipilih;

                let warna = 'text-[#4a5568] dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700';
                if (kolom === 6) warna = 'text-smanda-red hover:bg-gray-100 dark:hover:bg-gray-700';
                if (isHariIni)   warna = 'bg-smanda-green text-white hover:bg-smanda-green-dark';

                const cincin = isDipilih ? ' ring-2 ring-smanda-blue' : '';

                // titik penanda maksimal 3 per tanggal
                const kategoriUnik = [...new Set(adaEvent.map(e => e.kategori))].slice(0, 3);
                const titik = kategoriUnik.map(k =>
                    '<span class="w-[6px] h-[6px] rounded-full ring-1 ring-white/80 ' + (KATEGORI[k] ? KATEGORI[k].dot : 'bg-gray-400') + '"></span>'
                ).join('');

                html += '<button type="button" data-tgl="' + tgl + '" aria-label="' + d + ' ' + BULAN[bulan] + ' ' + tahun + '"' +
                        ' class="kal-hari h-[54px] sm:h-[72px] rounded-[10px] flex flex-col items-center justify-start pt-[8px] text-sm font-semibold transition-colors ' + warna + cincin + '">' +
                        '<span>' + d + '</span>' +
                        '<span class="flex gap-[3px] mt-[6px]">' + titik + '</span>' +
                        '</button>';
            }
            elGrid.innerHTML = html;
        }

        // ---------- RENDER AGENDA ----------
        function renderAgenda() {
            let daftar, judul, label;
            if (dipilih) {
                const [y, m, d] = dipilih.split('-').map(Number);
                daftar = eventsPada(dipilih);
                label = 'Agenda Tanggal';
                judul = d + ' ' + BULAN[m - 1] + ' ' + y;
                elReset.classList.remove('hidden');
            } else {
                daftar = eventsBulan(tahun, bulan);
                label = 'Agenda Bulan Ini';
                judul = BULAN[bulan] + ' ' + tahun;
                elReset.classList.add('hidden');
            }
            elAgendaLabel.textContent = label;
            elAgendaJudul.textContent = judul;

            if (!daftar.length) {
                elAgendaList.innerHTML = '<li class="text-sm text-gray-500 dark:text-gray-400">Tidak ada agenda.</li>';
                return;
            }
            elAgendaList.innerHTML = daftar.map(e => {
                const k = KATEGORI[e.kategori] || { label: e.kategori, badge: 'bg-gray-100 text-gray-600' };
                return '<li class="p-[14px] rounded-[12px] bg-[#f8f9fa] dark:bg-gray-900 border border-gray-100 dark:border-gray-700">' +
                       '<span class="inline-block ' + k.badge + ' text-[0.68rem] font-bold uppercase tracking-wider px-[10px] py-[2px] rounded-full mb-[8px]">' + esc(k.label) + '</span>' +
                       '<p class="text-[0.95rem] font-bold text-[#4a5568] dark:text-gray-100 leading-[1.4]">' + esc(e.judul) + '</p>' +
                       '<p class="text-xs text-gray-400 mt-[4px]">' + esc(formatRentang(e)) + '</p>' +
                       '</li>';
            }).join('');
        }

        function render() { renderKalender(); renderAgenda(); }

        // ---------- NAVIGASI ----------
        function geser(n) {
            bulan += n;
            if (bulan < 0)  { bulan = 11; tahun--; }
            if (bulan > 11) { bulan = 0;  tahun++; }
            dipilih = null;
            render();
        }
        document.getElementById('btn-prev').addEventListener('click', () => geser(-1));
        document.getElementById('btn-next').addEventListener('click', () => geser(1));
        document.getElementById('btn-hari-ini').addEventListener('click', function () {
            bulan = sekarang.getMonth(); tahun = sekarang.getFullYear(); dipilih = null; render();
        });
        elBulan.addEventListener('change', function () { bulan = parseInt(elBulan.value, 10); dipilih = null; render(); });
        elTahun.addEventListener('change', function () { tahun = parseInt(elTahun.value, 10); dipilih = null; render(); });
        elReset.addEventListener('click', function () { dipilih = null; render(); });

        elGrid.addEventListener('click', function (e) {
            const btn = e.target.closest('.kal-hari');
            if (!btn) return;
            dipilih = (dipilih === btn.dataset.tgl) ? null : btn.dataset.tgl;   // klik lagi = batal pilih
            render();
        });

        render();
    });
</script>
@endpush