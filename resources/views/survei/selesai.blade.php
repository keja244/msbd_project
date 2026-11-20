@extends('layouts.app')

@section('title', 'Terima Kasih - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 min-h-screen text-[#2d3748] dark:text-gray-100 font-sans pt-[120px] sm:pt-[140px] pb-[80px] transition-colors duration-300">
  <main class="max-w-xl mx-auto px-[16px] sm:px-[24px] text-center">
    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-9 shadow-sm">
      <div class="w-14 h-14 rounded-full bg-smanda-green text-white flex items-center justify-center text-2xl font-extrabold mx-auto mb-5 shadow-sm">✓</div>
      <h1 class="text-2xl sm:text-3xl font-extrabold mb-3">Terima kasih!</h1>
      <p class="text-gray-500 dark:text-gray-400 leading-relaxed mb-7">
        Survei sudah terkirim. Penilaianmu membantu SMA Negeri 2 Medan menjadi lebih baik.
      </p>
      <form method="POST" action="{{ route('survei.keluar') }}" class="inline">
        @csrf
        <button type="submit" class="px-7 py-3.5 rounded-xl font-bold text-white bg-smanda-green hover:brightness-85 shadow-md transition-all">
          Selesai
        </button>
      </form>
    </div>
  </main>
</div>

@endsection