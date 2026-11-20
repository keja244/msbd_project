@extends('layouts.app')

@section('content')
<div class="bg-[#f8f9fa] dark:bg-gray-900 min-h-screen text-[#2d3748] dark:text-gray-100 font-sans pt-[120px] sm:pt-[140px] pb-[80px] transition-colors duration-300">
  <main class="max-w-[1200px] mx-auto px-[16px] sm:px-[24px]">

    @php
      $role = session('survei.role');
      $menu = [['Ringkasan', 'survei.dashboard.index'], ['Hasil', 'survei.dashboard.hasil']];
      if (in_array($role, ['admin', 'kepsek', 'humas'], true)) {
          $menu[] = ['Partisipasi', 'survei.dashboard.partisipasi'];
      }
    @endphp

    <!-- NAVIGASI DASHBOARD -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-8">
      <nav class="flex gap-1.5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-1.5 rounded-xl shadow-sm">
        @foreach($menu as [$label, $rute])
          <a href="{{ route($rute) }}"
             class="px-4 py-2 rounded-lg text-sm font-bold transition-all {{ request()->routeIs($rute.'*') ? 'bg-smanda-green text-white' : 'text-gray-500 dark:text-gray-400 hover:text-smanda-green' }}">
            {{ $label }}
          </a>
        @endforeach
      </nav>
      <div class="flex items-center gap-3">
        <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/40 text-smanda-yellow">{{ $role }}</span>
        <form method="POST" action="{{ route('survei.keluar') }}">
          @csrf
          <button type="submit" class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-smanda-red transition-colors">Keluar</button>
        </form>
      </div>
    </div>

    @yield('isi')

  </main>
</div>
@endsection