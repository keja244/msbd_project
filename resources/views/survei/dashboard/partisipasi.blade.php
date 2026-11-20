@extends('survei.dashboard.layout')

@section('title', 'Partisipasi Survei - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
  <div class="text-smanda-green text-xs font-bold uppercase tracking-[0.15em] mb-2">Partisipasi</div>
  <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">Siapa yang <span class="text-smanda-yellow">Sudah Mengisi</span></h1>
  <p class="text-sm text-gray-500 dark:text-gray-400">{{ $semester }} · hanya jumlah, tanpa nama dan tanpa jawaban</p>
</section>

<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm mb-6">
  <div class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Total partisipasi</div>
  <div class="text-4xl font-extrabold">{{ $total['persen'] }}<span class="text-base font-semibold text-gray-400">%</span>
    <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">· {{ number_format($total['terisi']) }} dari {{ number_format($total['total']) }}</span></div>
</div>

<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
  @foreach($partisipasi as $p)
    <div class="mb-6 last:mb-0">
      <div class="flex items-center justify-between mb-1.5">
        <div class="font-bold">{{ $p['nama'] }}
          <span class="ml-1.5 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full {{ $p['wajib'] ? 'bg-emerald-100 dark:bg-emerald-900/40 text-smanda-green' : 'bg-yellow-100 dark:bg-yellow-900/40 text-smanda-yellow' }}">{{ $p['wajib'] ? 'Wajib' : 'Opsional' }}</span>
        </div>
        <div class="text-sm font-semibold">{{ number_format($p['terisi']) }} / {{ number_format($p['total']) }} · {{ $p['persen'] }}%</div>
      </div>
      <div class="h-3 rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden"><div class="h-full rounded-full bg-smanda-blue" style="width: {{ $p['persen'] }}%"></div></div>
    </div>
  @endforeach
</div>
@endsection