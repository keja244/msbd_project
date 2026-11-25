@extends('layouts.app')

@section('content')
<div class="bg-[#f8f9fa] dark:bg-gray-900 min-h-screen text-[#2d3748] dark:text-gray-100 font-sans pt-[120px] sm:pt-[140px] pb-[80px] transition-colors duration-300">
  <main class="max-w-[1200px] mx-auto px-[16px] sm:px-[24px]">

    @php
<<<<<<< HEAD
      $role = session('survei.role');
      $menu = [['Ringkasan', 'survei.dashboard.index']];
      if (in_array($role, ['sarpras', 'admin'], true)) {
          $menu[] = ['Fasilitas Sarpras', 'survei.dashboard.sarpras.index'];
          $menu[] = ['Pertanyaan Sarpras', 'survei.dashboard.sarpras.pertanyaan'];
      }
      $menu[] = ['Hasil Survei', 'survei.dashboard.hasil'];
      if (in_array($role, ['admin', 'kepsek', 'humas'], true)) {
          $menu[] = ['Partisipasi', 'survei.dashboard.partisipasi'];
      }
=======
        $role = session('survei.role');

        $menu = [
            ['Ringkasan', 'survei.dashboard.index'],
            ['Hasil', 'survei.dashboard.hasil'],
        ];

        if (in_array($role, ['admin', 'kepsek', 'humas'], true)) {
            $menu[] = ['Partisipasi', 'survei.dashboard.partisipasi'];
        }

        if (in_array($role, ['admin', 'humas'], true)) {
            $menu[] = ['Periode', 'survei.dashboard.periode.index'];
            $menu[] = ['Pertanyaan', 'survei.dashboard.pertanyaan.index'];
        }
>>>>>>> main
    @endphp

    
  <!-- NAVIGASI DASHBOARD -->
  <div class="flex flex-wrap items-center justify-between gap-3 mb-8">

      <nav class="flex flex-wrap gap-1.5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-1.5 rounded-xl shadow-sm">
          @foreach($menu as [$label, $rute])
              @php
                  $isActive = request()->routeIs($rute) || 
                              ($rute === 'survei.dashboard.sarpras.index' && request()->routeIs('survei.dashboard.sarpras.*') && !request()->routeIs('survei.dashboard.sarpras.pertanyaan*')) ||
                              ($rute === 'survei.dashboard.sarpras.pertanyaan' && request()->routeIs('survei.dashboard.sarpras.pertanyaan*'));
              @endphp
              <a href="{{ route($rute) }}"
                class="px-4 py-2 rounded-lg text-sm font-bold transition-all {{ $isActive ? 'bg-smanda-green text-white' : 'text-gray-500 dark:text-gray-400 hover:text-smanda-green' }}">
                  {{ $label }}
              </a>
          @endforeach
      </nav>

      <div class="flex items-center gap-4">
          <span class="text-xs font-bold uppercase tracking-wider px-3 py-2 rounded-full bg-yellow-100 dark:bg-yellow-900/40 text-smanda-yellow">
              {{ $role }}
          </span>

          <form method="POST" action="{{ route('survei.keluar') }}">
              @csrf
              <button type="submit"
                  class="text-sm font-bold text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                  Keluar
              </button>
          </form>
      </div>

  </div>

  @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-xl mb-6 text-sm flex items-center justify-between shadow-sm">
      <div class="flex items-center gap-2">
        <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 px-4 py-3 rounded-xl mb-6 text-sm flex items-center justify-between shadow-sm">
      <div class="flex items-center gap-2">
        <svg class="w-5 h-5 flex-shrink-0 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span>{{ session('error') }}</span>
      </div>
    </div>
  @endif


    @yield('isi')

  </main>
</div>
@endsection