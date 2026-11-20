@extends('survei.dashboard.layout')

@section('title', 'Hasil Survei - SMAN 2 Medan')

@section('isi')
<section class="mb-8">
  <div class="text-smanda-red text-xs font-bold uppercase tracking-[0.15em] mb-2">Hasil Survei</div>
  <h1 class="text-[1.75rem] sm:text-[2.5rem] font-extrabold leading-[1.15] mb-2">Rata-rata <span class="text-smanda-yellow">per Aspek</span></h1>
  <p class="text-sm text-gray-500 dark:text-gray-400">
    {{ $semester }} · skala 1 sampai 5 · tren dibanding semester lalu
    @unless($rinci) · tampilan humas: hanya rata-rata per aspek @endunless
  </p>
</section>

<div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm overflow-x-auto">
  <table class="w-full text-sm">
    <thead>
      <tr class="text-left text-xs uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-700">
        <th class="px-5 py-4 font-bold">Aspek</th>
        <th class="px-5 py-4 font-bold">Rata-rata</th>
        <th class="px-5 py-4 font-bold">Tren</th>
        @if($rinci)
          @foreach($kategori as $nama)<th class="px-3 py-4 font-bold text-center">{{ $nama }}</th>@endforeach
          <th class="px-5 py-4"></th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($aspek as $a)
        <tr class="border-b border-gray-50 dark:border-gray-700/60 last:border-0">
          <td class="px-5 py-4 font-semibold">
            {{ $a['nama'] }}
            @if($a['bersama'])<span class="ml-1.5 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900/40 text-smanda-blue">Bersama</span>@endif
          </td>
          <td class="px-5 py-4">
            @if($a['rata'] !== null)
              <span class="inline-block min-w-[2.75rem] text-center px-2.5 py-1 rounded-lg font-bold {{ \App\Support\DataHasil::warna($a['rata']) }}">{{ number_format($a['rata'], 1) }}</span>
            @else <span class="text-gray-400">—</span> @endif
          </td>
          <td class="px-5 py-4 font-bold whitespace-nowrap">
            @if($a['delta'] === null) <span class="text-gray-400">—</span>
            @elseif($a['delta'] > 0) <span class="text-smanda-green">▲ +{{ number_format($a['delta'], 1) }}</span>
            @elseif($a['delta'] < 0) <span class="text-smanda-red">▼ {{ number_format($a['delta'], 1) }}</span>
            @else <span class="text-gray-400">–</span> @endif
          </td>
          @if($rinci)
            @foreach($kategori as $key => $nama)
              <td class="px-3 py-4 text-center">
                @if(! isset($a['kategori'][$key])) <span class="text-gray-300 dark:text-gray-600">–</span>
                @elseif(! $a['kategori'][$key]['tampil'])
                  <span class="text-[11px] text-gray-400" title="Responden kurang dari {{ \App\Support\DataHasil::MIN_KELOMPOK }}, disembunyikan">n&lt;{{ \App\Support\DataHasil::MIN_KELOMPOK }}</span>
                @else
                  <span class="inline-block min-w-[2.5rem] px-2 py-1 rounded-lg text-xs font-bold {{ \App\Support\DataHasil::warna($a['kategori'][$key]['skor']) }}">{{ number_format($a['kategori'][$key]['skor'], 1) }}</span>
                @endif
              </td>
            @endforeach
            <td class="px-5 py-4 text-right">
              <a href="{{ route('survei.dashboard.hasil.aspek', $a['slug']) }}" class="text-xs font-bold uppercase tracking-wider text-smanda-green whitespace-nowrap">Detail →</a>
            </td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<p class="text-xs text-gray-500 dark:text-gray-400 mt-4 leading-relaxed">
  Warna: hijau 4,0 ke atas, kuning 3,4 sampai 3,9, merah di bawah 3,4. Kelompok dengan kurang dari {{ \App\Support\DataHasil::MIN_KELOMPOK }} responden disembunyikan untuk menjaga anonimitas.
</p>
@endsection