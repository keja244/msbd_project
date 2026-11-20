@extends('survei.dashboard.layout')

@section('title', 'Dashboard Survei - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
  <div class="text-smanda-blue dark:text-blue-400 text-xs font-bold uppercase tracking-[0.15em] mb-2">Dashboard Survei</div>
  <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">Ringkasan <span class="text-smanda-yellow">Hasil</span></h1>
  <p class="text-sm text-gray-500 dark:text-gray-400">{{ $semester }} · data contoh, belum terhubung database</p>
</section>

<!-- KARTU RINGKAS -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
  <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
    <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Rata-rata keseluruhan</div>
    <div class="text-4xl font-extrabold">{{ number_format($rataAll, 1) }} <span class="text-base font-semibold text-gray-400">/ 5</span></div>
  </div>
  <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
    <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Aspek dipantau</div>
    <div class="text-4xl font-extrabold">{{ $jumlahAspek }}</div>
  </div>
  <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
    @if($lihatPartisipasi)
      <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Partisipasi</div>
      <div class="text-4xl font-extrabold">{{ $total['persen'] }}<span class="text-base font-semibold text-gray-400">%</span></div>
      <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($total['terisi']) }} dari {{ number_format($total['total']) }}</div>
    @else
      <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Akses</div>
      <div class="text-lg font-extrabold capitalize">{{ $role }}</div>
      <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hanya aspek bidangmu</div>
    @endif
  </div>
</div>

<!-- TERTINGGI & TERENDAH -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
  @foreach([['Skor Tertinggi', $tertinggi], ['Perlu Perhatian', $terendah]] as [$judul, $daftar])
    <section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
      <h2 class="text-lg font-extrabold mb-5">{{ $judul }}</h2>
      @foreach($daftar as $a)
        <a href="{{ \App\Support\DataHasil::bolehRinci($role) ? route('survei.dashboard.hasil.aspek', $a['slug']) : '#' }}" class="block mb-4 last:mb-0">
          <div class="flex justify-between text-sm font-semibold mb-1.5"><span>{{ $a['nama'] }}</span><span>{{ number_format($a['rata'], 1) }}</span></div>
          <div class="h-2.5 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
            <div class="h-full rounded-full {{ explode(' ', \App\Support\DataHasil::warna($a['rata']))[0] }}" style="width: {{ $a['rata'] / 5 * 100 }}%"></div>
          </div>
        </a>
      @endforeach
    </section>
  @endforeach
</div>

@if($lihatPartisipasi)
  <section class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
    <div class="flex items-center justify-between mb-5">
      <h2 class="text-lg font-extrabold">Partisipasi per Kategori</h2>
      <a href="{{ route('survei.dashboard.partisipasi') }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green">Detail →</a>
    </div>
    @foreach($partisipasi as $p)
      <div class="mb-4 last:mb-0">
        <div class="flex justify-between text-sm font-semibold mb-1.5"><span>{{ $p['nama'] }}</span><span>{{ $p['persen'] }}%</span></div>
        <div class="h-2.5 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden"><div class="h-full rounded-full bg-smanda-blue" style="width: {{ $p['persen'] }}%"></div></div>
      </div>
    @endforeach
  </section>
@endif
@endsection