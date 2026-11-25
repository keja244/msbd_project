@extends('survei.layout.utama')

@section('title', 'Hasil Survei - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
  <div class="text-smanda-red text-xs font-bold uppercase tracking-[0.15em] mb-2">
    @if(($role ?? session('survei.role')) === 'sarpras')
      Hasil Survei Khusus Role Sarpras
    @else
      Hasil Survei
    @endif
  </div>

  <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">
    @if(($role ?? session('survei.role')) === 'sarpras')
      Hasil Evaluasi <span class="text-smanda-yellow">Aspek Sarana & Prasarana</span>
    @else
      Rata-rata <span class="text-smanda-yellow">per Aspek</span>
    @endif
  </h1>

  <p class="text-sm text-gray-500 dark:text-gray-400">
<<<<<<< HEAD:resources/views/survei/dashboard/hasil.blade.php
    @if(($role ?? session('survei.role')) === 'sarpras')
      {{ $semester ?? 'Periode Aktif' }} · Skala 1 sampai 5 · Menampilkan evaluasi khusus aspek sarana dan prasarana dari database
    @else
      {{ $semester ?? 'Periode Aktif' }} · Skala 1 sampai 5 · Tren dibanding semester lalu
      @unless($rinci ?? false) · Tampilan ringkas rata-rata per aspek @endunless
    @endif
=======
    {{ $semester }} · skala 1 sampai 4 · tren dibanding semester lalu
    @unless($rinci) · tampilan humas: hanya rata-rata per aspek @endunless
>>>>>>> main:resources/views/survei/pengelola/hasil.blade.php
  </p>
</section>

<!-- TABEL UTAMA HASIL ASPEK -->
<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm overflow-x-auto mb-8">
  <table class="w-full text-sm">
    <thead>
      <tr class="text-left text-xs uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-700">
        <th class="px-5 py-4 font-bold">Aspek Penilaian</th>
        <th class="px-5 py-4 font-bold">Rata-rata Skor</th>
        <th class="px-5 py-4 font-bold">Total Respon</th>
        <th class="px-5 py-4 font-bold">Predikat Mutu</th>
        @if($rinci ?? false)
          @foreach($kategori ?? [] as $nama)<th class="px-3 py-4 font-bold text-center">{{ $nama }}</th>@endforeach
          <th class="px-5 py-4"></th>
        @endif
      </tr>
    </thead>
    <tbody>
      @forelse($aspek as $a)
        @php
          $nama = is_array($a) ? $a['nama'] : ($a->nama_aspek ?? '-');
          $rata = is_array($a) ? $a['rata'] : ($a->rata ?? null);
          $bersama = is_array($a) ? ($a['bersama'] ?? false) : ($a->bersama ?? false);
          $delta = is_array($a) ? ($a['delta'] ?? null) : null;
          $jumlah = is_array($a) ? ($a['jumlah'] ?? '-') : ($a->jumlah_jawaban ?? 0);

          $warnaBg = match(true) {
            $rata >= 4.0 => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300',
            $rata >= 3.4 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
            $rata !== null => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
            default => 'bg-gray-100 text-gray-500',
          };

          $predikat = match(true) {
            $rata >= 4.5 => 'Sangat Baik (A)',
            $rata >= 3.75 => 'Baik (B)',
            $rata >= 3.0 => 'Cukup (C)',
            $rata !== null => 'Kurang / Perlu Peningkatan',
            default => 'Belum Ada Penilaian',
          };
        @endphp
        <tr class="border-b border-gray-50 dark:border-gray-700/60 last:border-0 hover:bg-gray-50/50 dark:hover:bg-gray-750 transition-colors">
          <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-100">
            {{ $nama }}
            @if($bersama)<span class="ml-1.5 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900/40 text-smanda-blue">Bersama</span>@endif
          </td>
          <td class="px-5 py-4">
            @if($rata !== null)
              <span class="inline-block min-w-[2.75rem] text-center px-2.5 py-1 rounded-lg font-bold {{ $warnaBg }}">
                {{ number_format($rata, 2) }}
              </span>
            @else
              <span class="text-gray-400 font-semibold">—</span>
            @endif
          </td>
          <td class="px-5 py-4 font-bold text-gray-600 dark:text-gray-300">
            {{ $jumlah }} Respon
          </td>
          <td class="px-5 py-4">
            <span class="inline-block text-xs font-semibold px-2.5 py-0.5 rounded-full {{ $warnaBg }}">
              {{ $predikat }}
            </span>
          </td>
          @if($rinci ?? false)
            @foreach($kategori ?? [] as $key => $namaKat)
              <td class="px-3 py-4 text-center">
                @if(! isset($a['kategori'][$key])) <span class="text-gray-300 dark:text-gray-600">–</span>
                @elseif(! $a['kategori'][$key]['tampil'])
                  <span class="text-[11px] text-gray-400">n&lt;5</span>
                @else
                  <span class="inline-block min-w-[2.5rem] px-2 py-1 rounded-lg text-xs font-bold {{ \App\Support\DataHasil::warna($a['kategori'][$key]['skor']) }}">
                    {{ number_format($a['kategori'][$key]['skor'], 1) }}
                  </span>
                @endif
              </td>
            @endforeach
            <td class="px-5 py-4 text-right">
              <a href="{{ route('survei.dashboard.hasil.aspek', $a['slug'] ?? 'sarpras') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green whitespace-nowrap">Detail →</a>
            </td>
          @endif
        </tr>
      @empty
        <tr>
          <td colspan="4" class="px-5 py-8 text-center text-gray-400">
            Belum ada data hasil survei yang tercatat di database.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- KHUSUS ROLE SARPRAS: TAMPILKAN RINCIAN BUTIR PERTANYAAN SARPRAS -->
@if(($role ?? session('survei.role')) === 'sarpras')
  <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm p-6 sm:p-7 mb-8">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700">
      <div>
        <h2 class="text-lg font-extrabold text-gray-800 dark:text-gray-100">
          Rincian Skor per Butir Pertanyaan Sarpras
        </h2>
        <p class="text-xs text-gray-400 mt-0.5">
          Data diambil langsung dari tabel jawaban responden untuk pertanyaan aspek sarana dan prasarana.
        </p>
      </div>
      <a href="{{ route('survei.dashboard.sarpras.pertanyaan') }}" class="text-xs font-bold text-smanda-blue hover:underline">
        Kelola Pertanyaan Sarpras &rarr;
      </a>
    </div>

    @if(isset($pertanyaanSarpras) && $pertanyaanSarpras->isNotEmpty())
      <div class="space-y-6">
        @foreach($pertanyaanSarpras as $p)
          @php
            $persen = $p->rata ? min(100, round(($p->rata / 5) * 100)) : 0;
            $barColor = match(true) {
              $p->rata >= 4.0 => 'bg-emerald-500',
              $p->rata >= 3.4 => 'bg-yellow-500',
              $p->rata > 0 => 'bg-red-500',
              default => 'bg-gray-300',
            };
          @endphp
          <div class="p-4 rounded-xl border border-gray-100 dark:border-gray-700/70 bg-gray-50/50 dark:bg-gray-900/30">
            <div class="flex items-start justify-between gap-4 mb-2">
              <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/40 text-smanda-blue font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                  {{ $p->urutan }}
                </span>
                <div>
                  <h3 class="text-sm font-bold text-gray-800 dark:text-gray-100 leading-snug">
                    {{ $p->teks_pertanyaan }}
                  </h3>
                  <span class="text-[11px] text-gray-400 mt-0.5 block">
                    {{ $p->total_respon }} Respon Masuk
                  </span>
                </div>
              </div>
              <div class="text-right flex-shrink-0">
                <span class="text-lg font-extrabold text-gray-800 dark:text-gray-100">
                  {{ $p->rata > 0 ? number_format($p->rata, 2) : '—' }}
                </span>
                <span class="text-xs text-gray-400 block">/ 5.00</span>
              </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3 overflow-hidden">
              <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-xs text-gray-400 text-center py-6">
        Belum ada butir pertanyaan atau respon survei sarpras yang tercatat.
      </p>
    @endif
  </div>

  @if(isset($saranSarpras) && $saranSarpras->isNotEmpty())
    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm p-6 sm:p-7">
      <h2 class="text-lg font-extrabold text-gray-800 dark:text-gray-100 mb-2">
        Kritik & Saran Responden Terkait Sarpras
      </h2>
      <p class="text-xs text-gray-400 mb-5">Masukan langsung dari siswa, guru, atau masyarakat mengenai sarana dan prasarana.</p>

      <div class="space-y-3">
        @foreach($saranSarpras as $s)
          <div class="p-3.5 rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/30">
            <div class="flex items-center justify-between text-xs text-gray-400 mb-1">
              <span class="font-bold text-smanda-blue">{{ $s->kategori_responden }}</span>
            </div>
            <p class="text-sm text-gray-700 dark:text-gray-200 italic">
              "{{ $s->saran }}"
            </p>
          </div>
        @endforeach
      </div>
    </div>
  @endif
@endif

<p class="text-xs text-gray-500 dark:text-gray-400 mt-6 leading-relaxed">
  Keterangan Nilai: Hijau (4,0 - 5,0 Sangat Baik), Kuning (3,4 - 3,9 Baik/Cukup), Merah (&lt; 3,4 Perlu Peningkatan). Seluruh data tersinkronisasi otomatis dengan basis data survei sekolah.
</p>
@endsection
