
@extends('layouts.app')

@section('content')
<div class="bg-[#f8f9fa] dark:bg-gray-900 min-h-screen text-[#2d3748] dark:text-gray-100 font-sans pt-[120px] sm:pt-[140px] pb-[80px] transition-colors duration-300">

    <main class="max-w-[1200px] mx-auto px-[16px] sm:px-[24px]">

        @php
            $role = session('survei.role');

            $menu = [
                [
                    'label' => 'Ringkasan',
                    'route' => 'survei.dashboard.index',
                    'active' => 'survei.dashboard.index',
                ],
                [
                    'label' => 'Hasil',
                    'route' => 'survei.dashboard.hasil',
                    'active' => 'survei.dashboard.hasil*',
                ],
            ];

            // Menu Partisipasi
            if (in_array($role, ['admin', 'kepsek', 'humas'], true)) {
                $menu[] = [
                    'label' => 'Partisipasi',
                    'route' => 'survei.dashboard.partisipasi',
                    'active' => 'survei.dashboard.partisipasi',
                ];
            }

            // Menu khusus Super Admin
            if ($role === 'admin') {
                $menu[] = [
                    'label' => 'Periode',
                    'route' => 'survei.dashboard.periode.index',
                    'active' => 'survei.dashboard.periode.*',
                ];

                $menu[] = [
                    'label' => 'Aspek',
                    'route' => 'survei.dashboard.aspek.index',
                    'active' => 'survei.dashboard.aspek.*',
                
                ];

                $menu[] = [
                    'label' => 'Akun',
                    'route' => 'survei.dashboard.akun.index',
                    'active' => 'survei.dashboard.akun.*',
                ];
            }

            // Menu pertanyaan untuk pengelola divisi
            if (in_array($role, ['admin', 'humas', 'kurikulum', 'sarpras', 'kesiswaan'], true)) {
                $menu[] = [
                    'label' => 'Pertanyaan',
                    'route' => 'survei.dashboard.pertanyaan.index',
                    'active' => 'survei.dashboard.pertanyaan.*',
                ];
            }
        @endphp

        
        <div class="flex flex-wrap items-center justify-between gap-3 mb-8">

            <nav class="flex flex-wrap gap-1.5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-1.5 rounded-xl shadow-sm">
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-bold transition-all
                    {{ request()->routeIs($item['active']) ? 'bg-smanda-green text-white' : 'text-gray-500 dark:text-gray-400 hover:text-smanda-green' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                <span class="text-xs font-bold uppercase tracking-wider px-3 py-2 rounded-full bg-yellow-100 dark:bg-yellow-900/40 text-smanda-yellow">
                    {{ $role }}
                </span>

                <form method="POST" action="{{ route('survei.keluar') }}">
                    @csrf
                    <button type="submit"
                        class="shrink-0 px-4 py-2 rounded-lg text-sm font-bold text-white bg-red-600 hover:bg-red-700 transition-colors shadow-sm">
                        Keluar
                    </button>
                </form>
            </div>

        </div>


        @yield('isi')

    </main>
</div>
@endsection
