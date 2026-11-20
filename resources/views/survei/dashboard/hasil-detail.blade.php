@extends('survei.dashboard.layout')

@section('title', $a['nama'].' - Hasil Survei')

@section('isi')
<a href="{{ route('survei.dashboard.hasil') }}" class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-smanda-green transition-colors">← Semua aspek</a>

<section class="mt-4 mb-8 flex flex-wrap items-end justify-between gap-4">
  <div>
    <div class="text-smanda-red text-xs font-bold uppercase tracking-[0.15em] mb-2">Detail Aspek</div>
    <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">{{ $a['nama'] }}</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $semester }} · data contoh</p>
  </div>
  @if($a['rata'] !== null)
    <div class="flex items-center gap-3">
      <span class="text-4xl font-extrabold px-5 py-2 rounded-2xl {{ \App\Support\DataHasil::warna($a['rata']) }}">{{ number_format($a['rata'], 1) }}</span>
      @if($a['delta'] !== null && $a['delta'] != 0)
        <span class="font-bold {{ $a['delta'] > 0 ? 'text-smanda-green' : 'text-smanda-red' }}">{{ $a['delta'] > 0 ? '▲ +' : '▼ ' }}{{ number_format($a['delta'], 1) }}</span>
      @endif
    </div>
  @endif
</section>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
  <!-- PERBANDINGAN ANTAR KATEGORI -->
  <section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
    <h2 class="text-lg font-extrabold mb-1">Per Kategori Responden</h2>
    <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">{{ $a['bersama'] ? 'Aspek bersama: bisa dibandingkan antar kategori.' : 'Aspek khusus kategori ini.' }}</p>
    @foreach($a['kategori'] as $key => $k)
      <div class="mb-4 last:mb-0">
        <div class="flex justify-between text-sm font-semibold mb-1.5">
          <span>{{ $kategori[$key] }} <span class="text-xs font-normal text-gray-400">(n={{ $k['n'] }})</span></span>
          <span>{{ $k['tampil'] ? number_format($k['skor'], 1) : 'disembunyikan' }}</span>
        </div>
        <div class="h-2.5 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
          @if($k['tampil'])<div class="h-full rounded-full {{ explode(' ', \App\Support\DataHasil::warna($k['skor']))[0] }}" style="width: {{ $k['skor'] / 5 * 100 }}%"></div>@endif
        </div>
      </div>
    @endforeach
  </section>

  <!-- DISTRIBUSI SKOR -->
  <section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
    <h2 class="text-lg font-extrabold mb-5">Sebaran Skor</h2>
    @if($distribusi)
      @foreach(array_reverse($distribusi, true) as $skor => $persen)
        <div class="flex items-center gap-3 mb-3 last:mb-0">
          <span class="w-4 text-sm font-bold">{{ $skor }}</span>
          <div class="flex-1 h-2.5 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden"><div class="h-full rounded-full bg-smanda-blue" style="width: {{ $persen }}%"></div></div>
          <span class="w-10 text-right text-xs font-semibold text-gray-500 dark:text-gray-400">{{ $persen }}%</span>
        </div>
      @endforeach
    @else
      <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data yang cukup untuk ditampilkan.</p>
    @endif
  </section>
</div>

<!-- ISIAN TEKS -->
<section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
  <h2 class="text-lg font-extrabold mb-4">Saran dan Masukan</h2>
  @if($teks)
    @foreach($teks as $t)
      <p class="text-sm leading-relaxed py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">{{ $t }}</p>
    @endforeach
  @else
    <p class="text-sm text-gray-500 dark:text-gray-400">Isian teks untuk aspek ini hanya dapat dilihat oleh admin dan kepala sekolah.</p>
  @endif
</section>
@endsection