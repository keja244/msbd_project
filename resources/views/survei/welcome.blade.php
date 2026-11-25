@extends('layouts.app')

@section('title', 'Survei Kepuasan - SMAN 2 Medan')

@section('content')

<div class="bg-[#f8f9fa] dark:bg-gray-900 min-h-screen text-[#2d3748] dark:text-gray-100 font-sans pt-[120px] sm:pt-[140px] pb-[80px] transition-colors duration-300">
  <main class="max-w-[1200px] mx-auto px-[16px] sm:px-[24px]">
    
    <!-- HERO SECTION: info survei (kiri) + kartu masuk (kanan) -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-start max-w-5xl mx-auto">

      <!-- KIRI: Info Survei -->
      <div class="text-center lg:text-left flex flex-col items-center lg:items-start pt-6 lg:pt-8">

        @if(isset($periode) && $periode)
          <span class="inline-block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full px-4 py-1.5 text-xs font-semibold mb-6 shadow-sm">
            Survei dibuka: Semester {{ $periode->semester }} · {{ $periode->tahun_ajaran }}
            (s.d. {{ \Carbon\Carbon::parse($periode->selesai)->translatedFormat('d F Y') }})
          </span>
        @else
          <span class="inline-block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full px-4 py-1.5 text-xs font-semibold mb-6 shadow-sm">
            Belum ada survei yang dibuka saat ini
          </span>
        @endif

        <!-- Aksen Biru (10%) untuk Label Atas -->
        <div class="text-smanda-blue dark:text-blue-400 text-xs font-bold uppercase tracking-[0.15em] mb-2">Suara Warga Sekolah</div>

        <h1 class="text-[2rem] sm:text-[3rem] font-extrabold leading-[1.15] mb-4">
          Survei Kepuasan<br><span class="text-smanda-yellow">SMA Negeri 2 Medan</span>
        </h1>

        <p class="text-gray-500 dark:text-gray-400 text-base sm:text-lg leading-relaxed max-w-xl mb-6">
          Penilaianmu membantu sekolah memperbaiki sarana, layanan, dan kebijakan secara berkelanjutan. Survei dilakukan setiap semester dan jawabanmu dijamin bersifat anonim.
        </p>

        <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-2 mb-6 text-left">
          <li class="flex items-center gap-2"><span class="text-smanda-green font-extrabold">✓</span> Jawaban anonim, tidak dikaitkan dengan identitasmu</li>
          <li class="flex items-center gap-2"><span class="text-smanda-green font-extrabold">✓</span> Penilaian ditujukan ke layanan, bukan individu</li>
          <li class="flex items-center gap-2"><span class="text-smanda-green font-extrabold">✓</span> Cukup satu kali per semester</li>
        </ul>

        <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-smanda-green transition-colors">
          ← Kembali ke Beranda
        </a>
      </div>

      <!-- KANAN: Kartu Masuk (Diturunkan sedikit posisinya menggunakan lg:mt-6) -->
      <div class="w-full max-w-md mx-auto lg:max-w-none lg:mt-6">

          <!-- KARTU MASUK (Login & Tamu) -->
          <div id="masuk"
              class="w-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-8 sm:p-10 shadow-sm text-left">
          
          @if($errors->any())
            <div class="bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 rounded-xl px-4 py-2.5 text-sm mb-4">
              {{ $errors->first() }}
            </div>
          @endif

          <!-- Tab -->
          <div class="flex gap-1.5 bg-gray-100 dark:bg-gray-900 p-1.5 rounded-xl mb-6">
            <button type="button" data-pane="akun"
              class="sv-tab flex-1 py-2.5 rounded-lg text-sm font-bold transition-all {{ old('mode') === 'tamu' ? 'text-gray-500 dark:text-gray-400' : 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm' }}">
              Masuk
            </button>
            <button type="button" data-pane="tamu"
              class="sv-tab flex-1 py-2.5 rounded-lg text-sm font-bold transition-all {{ old('mode') === 'tamu' ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400' }}">
              Masuk sebagai Tamu
            </button>
          </div>

          <!-- Wrapper Form -->
          <div class="relative">
            <!-- Form Masuk -->
            <form id="pane-akun" method="POST" action="{{ route('survei.masuk.proses') }}"
              class="sv-pane {{ old('mode') === 'tamu' ? 'hidden' : '' }}">
              @csrf
              <div class="mb-4">
                <label for="username" class="block text-xs font-bold mb-1.5">
                      NIS / NIP / Username
                </label>
                <input id="username" name="username"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-smanda-green">
              </div>

              <div id="pilihan-jabatan" class="mb-5 {{ old('username') === 'guru_tendik' ? '' : 'hidden' }}">
                <label class="block text-xs font-bold mb-2">
                    Pilih Jabatan
                </label>

                  <div class="grid grid-cols-2 gap-3">
                      <label class="flex items-center gap-2 p-3 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer">
                          <input type="radio" name="jabatan" value="guru"
                              {{ old('jabatan') === 'guru' ? 'checked' : '' }}>
                          <span class="text-sm font-medium">Guru</span>
                      </label>

                      <label class="flex items-center gap-2 p-3 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer">
                          <input type="radio" name="jabatan" value="tendik"
                              {{ old('jabatan') === 'tendik' ? 'checked' : '' }}>
                          <span class="text-sm font-medium">Tendik</span>
                      </label>
                  </div>
              </div>
              <div class="mb-5">
                <label for="password" class="block text-xs font-bold mb-1.5">Kata Sandi</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-smanda-green">
              </div>
              <button type="submit" class="w-full px-7 py-3.5 rounded-xl font-bold text-white bg-smanda-green hover:brightness-90 shadow-md transition-all">
                Masuk →
              </button>
              <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed mt-3">
                Untuk siswa, guru, tendik, dan pengelola survei. Akun dibuat otomatis dari data sekolah.
              </p>
            </form>

            <!-- Form Tamu -->
            <form id="pane-tamu" method="POST" action="{{ route('survei.tamu.proses') }}"
              class="sv-pane {{ old('mode') === 'tamu' ? '' : 'hidden' }}">
              @csrf
              <input type="hidden" name="mode" value="tamu">
              <div class="mb-4">
                <label for="kategori" class="block text-xs font-bold mb-1.5">Saya adalah</label>
              <select id="kategori" name="kategori" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-smanda-green">

                  <option value="3" @selected(old('kategori') == '3')>
                      Masyarakat / Orang Tua
                  </option>
              </select>
              </div>
              <div class="mb-4">
                <label for="nama" class="block text-xs font-bold mb-1.5">Nama</label>
                <input id="nama" name="nama" value="{{ old('nama') }}" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-smanda-green">
              </div>
              <div class="mb-5">
                <label for="kontak" class="block text-xs font-bold mb-1.5">No. HP</label>
                <input id="kontak" name="kontak" value="{{ old('kontak') }}" inputmode="tel" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-smanda-green">
              </div>
              <button type="submit" class="w-full px-7 py-3.5 rounded-xl font-bold text-white bg-smanda-green hover:brightness-90 shadow-md transition-all">
                Mulai sebagai Tamu →
              </button>
              <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed mt-3">
                Tanpa akun. Identitas hanya untuk mencegah pengisian ganda dan tidak dikaitkan dengan jawabanmu.
              </p>
            </form>
          </div>

        </div>
      </div>
    </section>

    <!-- SECTION KATEGORI RESPONDEN -->
    <section class="mt-20">
      <div class="text-center sm:text-left mb-6">
        <div class="text-smanda-red font-semibold text-xs uppercase tracking-[0.15em] mb-1">Siapa yang mengisi</div>
        <h2 class="text-2xl sm:text-3xl font-extrabold">Kategori Responden</h2>
      </div>
      
      <!-- Diubah menjadi grid-cols-2 untuk mobile, dan lg:grid-cols-3 untuk desktop -->
      <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @if(isset($kategori))
          @foreach($kategori as $index => $k)
            @php
              $borderColors = ['hover:border-smanda-green', 'hover:border-smanda-yellow', 'hover:border-smanda-red', 'hover:border-smanda-blue'];
              $activeBorder = $borderColors[$index % count($borderColors)];
            @endphp
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-4 sm:p-7 shadow-sm {{ $activeBorder }} transition-all flex flex-col justify-between">
              <div>
                <span class="inline-block text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full {{ $k->wajib ? 'bg-emerald-100 dark:bg-emerald-900/40 text-smanda-green' : 'bg-yellow-100 dark:bg-yellow-900/40 text-smanda-yellow' }}">
                  {{ $k->wajib ? 'Wajib' : 'Opsional' }}
                </span>
                <h3 class="text-base sm:text-lg font-bold mt-2.5 mb-1.5">{{ $k->nama }}</h3>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                  {{ $k->wajib ? 'Masuk dengan NIS/NIP dan isi survei sesuai kategorimu.' : 'Masuk sebagai tamu, cukup isi identitas singkat.' }}
                </p>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </section>

    <!-- SECTION ALUR / CARA MENGISI -->
    <section class="mt-20">
      <div class="text-center sm:text-left mb-6">
        <div class="text-smanda-yellow font-semibold text-xs uppercase tracking-[0.15em] mb-1">Alur</div>
        <h2 class="text-2xl sm:text-3xl font-extrabold">Cara Mengisi</h2>
      </div>
      
      <!-- Bagian alur juga bisa dibuat grid-cols-1 di HP (karena teksnya agak panjang) atau 2 kolom jika ingin lebih ringkas -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
          <div class="w-10 h-10 rounded-full bg-smanda-green text-white flex items-center justify-center font-extrabold mb-4 shadow-sm">1</div>
          <h3 class="text-lg font-bold mb-2">Masuk</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Gunakan akun yang sudah dibuat dari data sekolah, atau masuk sebagai tamu untuk orang tua dan masyarakat.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
          <div class="w-10 h-10 rounded-full bg-smanda-yellow text-gray-900 flex items-center justify-center font-extrabold mb-4 shadow-sm">2</div>
          <h3 class="text-lg font-bold mb-2">Isi Penilaian</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Beri skor 1 sampai 5 untuk tiap pertanyaan, dan tambahkan isian singkat bila diperlukan.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-7 shadow-sm">
          <div class="w-10 h-10 rounded-full bg-smanda-red text-white flex items-center justify-center font-extrabold mb-4 shadow-sm">3</div>
          <h3 class="text-lg font-bold mb-2">Kirim</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Satu kali per semester. Pihak sekolah hanya melihat hasil gabungan, bukan jawaban perorangan.</p>
        </div>
      </div>
    </section>

  </main>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const pilihanJabatan = document.getElementById('pilihan-jabatan');

    if (!usernameInput || !pilihanJabatan) return;

    function cekUsername() {
        const username = usernameInput.value.trim().toLowerCase();
        const isGuruTendik = username === 'guru_tendik';

        pilihanJabatan.classList.toggle('hidden', !isGuruTendik);

        pilihanJabatan.querySelectorAll('input').forEach(function (input) {
            input.required = isGuruTendik;

            if (!isGuruTendik) {
                input.checked = false;
            }
        });
    }

    usernameInput.addEventListener('input', cekUsername);
    cekUsername();
});
</script>

@endsection