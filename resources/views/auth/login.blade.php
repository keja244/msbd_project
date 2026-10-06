@extends('layouts.auth')

@section('title', 'Login - SMA Negeri 2 Medan')

@section('content')

<!-- WRAPPER UTAMA -->
<div class="bg-[#f8f9fa] dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans py-[60px] min-h-screen flex flex-col justify-center transition-colors duration-300">

    <div class="max-w-[440px] w-full mx-auto px-[24px]">
        
        <!-- HEADER KECIL (Logo & Judul) -->
        <div class="text-center mb-[28px]">
            <a href="{{ url('/') }}" class="inline-block mb-[12px]">
                <img src="{{ asset('images/logo_smandu.png') }}" alt="Logo SMAN 2 Medan" class="w-[56px] h-[56px] object-contain mx-auto">
            </a>
            <h1 class="text-[1.6rem] font-extrabold text-[#2d3748] dark:text-white tracking-tight">Masuk ke Portal</h1>
            <p class="text-[0.9rem] text-[#718096] dark:text-gray-400 mt-[4px]">SMA Negeri 2 Medan</p>
        </div>

        <!-- FORM BOX SIMPEL & ELEGAN -->
        <div class="bg-white dark:bg-gray-800/90 p-[32px] sm:p-[36px] rounded-[20px] shadow-[0_4px_25px_rgba(0,0,0,0.05)] dark:shadow-[0_4px_25px_rgba(0,0,0,0.4)] border border-gray-100 dark:border-gray-700/80 transition-colors duration-300">
            
            <!-- Session Status / Error -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-[18px]">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300 mb-[6px]">
                        {{ __('Email / Akun') }}
                    </label>
                    <input id="email" class="w-full bg-[#f8f9fa] dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-100 rounded-[10px] px-[14px] py-[11px] text-[0.95rem] focus:outline-none focus:border-smanda-green dark:focus:border-smanda-green focus:ring-1 focus:ring-smanda-green transition-all" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@sman2medan.sch.id" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-[6px]">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#4a5568] dark:text-gray-300">
                            {{ __('Password') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-smanda-green hover:underline dark:text-smanda-yellow font-medium" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <input id="password" class="w-full bg-[#f8f9fa] dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-100 rounded-[10px] px-[14px] py-[11px] text-[0.95rem] focus:outline-none focus:border-smanda-green dark:focus:border-smanda-green focus:ring-1 focus:ring-smanda-green transition-all"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center pt-[2px]">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-smanda-green shadow-sm focus:ring-smanda-green dark:bg-gray-900 w-[16px] h-[16px]" name="remember">
                        <span class="ms-2 text-sm text-[#4a5568] dark:text-gray-300 font-light">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-[8px]">
                    <button type="submit" class="w-full bg-smanda-green hover:bg-smanda-green-dark text-white py-[12px] px-[20px] rounded-[10px] font-bold text-[0.95rem] transition-all duration-300 shadow-sm flex items-center justify-center gap-[8px]">
                        <span>Masuk ke Sistem</span>
                        <svg class="w-[16px] h-[16px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

        </div>

        <!-- Link Kembali ke Beranda -->
        <div class="text-center mt-[24px]">
            <a href="{{ url('/') }}" class="text-xs text-[#718096] dark:text-gray-400 hover:text-smanda-green dark:hover:text-smanda-yellow transition-colors inline-flex items-center gap-1 font-medium">
                &larr; Kembali ke Beranda Website Utama
            </a>
        </div>

    </div>

</div>

@endsection