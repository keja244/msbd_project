<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Favicon Utama -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_smandu.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo_smandu.png') }}">

        <!-- SCRIPT CEK LOCALSTORAGE AGAR DARK MODE TIDAK RESET -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">
        
        <div class="min-h-screen flex flex-col bg-[#f8f9fa] dark:bg-gray-900">
            
            <!-- Navbar Global -->
            @include('includes.navbar')

            <!-- Page Heading (Jika ada dari Breeze) -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow mt-[80px]">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                @hasSection('content')
                    @yield('content')
                @endif

                @isset($slot)
                    {{ $slot }}
                @endisset
            </main>

            <!-- Footer Global -->
            @include('includes.footer')

        </div>

        <!-- GLOBAL SCRIPT UNTUK NAVBAR, DARK MODE, & MOBILE DRAWER -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // --- 1. LOGIKA SWITCH DARK / LIGHT MODE ---
                const modeBtn = document.getElementById('mode-switch-btn');
                const iconSun = document.getElementById('icon-sun');
                const iconMoon = document.getElementById('icon-moon');

                // Sinkronisasi ikon dengan status tema saat halaman dimuat
                if (document.documentElement.classList.contains('dark')) {
                    if (iconSun) iconSun.classList.add('hidden');
                    if (iconMoon) iconMoon.classList.remove('hidden');
                } else {
                    if (iconSun) iconSun.classList.remove('hidden');
                    if (iconMoon) iconMoon.classList.add('hidden');
                }

                if (modeBtn) {
                    modeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (iconSun) iconSun.classList.toggle('hidden');
                        if (iconMoon) iconMoon.classList.toggle('hidden');

                        document.documentElement.classList.toggle('dark');

                        if (document.documentElement.classList.contains('dark')) {
                            localStorage.setItem('color-theme', 'dark');
                        } else {
                            localStorage.setItem('color-theme', 'light');
                        }
                    });
                }

                // --- 2. ANIMASI SCROLL NAVBAR & SHRINK ---
                const header = document.getElementById('main-header');
                const navbar = document.getElementById('main-navbar');
                const navLogo = document.getElementById('nav-logo');
                const navTitle = document.getElementById('nav-title');
                const navSubtitle = document.getElementById('nav-subtitle');

                window.addEventListener('scroll', function () {
                    if (window.scrollY > 30) {
                        if (header) {
                            header.classList.remove('pt-3', 'sm:pt-4');
                            header.classList.add('pt-1', 'sm:pt-2');
                        }
                        if (navbar) {
                            navbar.classList.remove('h-[72px]', 'rounded-[16px]');
                            navbar.classList.add('h-[58px]', 'rounded-[12px]', 'shadow-[0_4px_25px_rgba(0,0,0,0.12)]');
                        }
                        if (navLogo) {
                            navLogo.classList.remove('w-[38px]', 'h-[38px]', 'sm:w-[42px]', 'sm:h-[42px]');
                            navLogo.classList.add('w-[32px]', 'h-[32px]', 'sm:w-[34px]', 'sm:h-[34px]');
                        }
                        if (navTitle) {
                            navTitle.classList.remove('text-[0.95rem]', 'sm:text-[1.05rem]');
                            navTitle.classList.add('text-[0.85rem]', 'sm:text-[0.95rem]');
                        }
                        if (navSubtitle) {
                            navSubtitle.classList.add('hidden');
                        }
                    } else {
                        if (header) {
                            header.classList.remove('pt-1', 'sm:pt-2');
                            header.classList.add('pt-3', 'sm:pt-4');
                        }
                        if (navbar) {
                            navbar.classList.remove('h-[58px]', 'rounded-[12px]', 'shadow-[0_4px_25px_rgba(0,0,0,0.12)]');
                            navbar.classList.add('h-[72px]', 'rounded-[16px]');
                        }
                        if (navLogo) {
                            navLogo.classList.remove('w-[32px]', 'h-[32px]', 'sm:w-[34px]', 'sm:h-[34px]');
                            navLogo.classList.add('w-[38px]', 'h-[38px]', 'sm:w-[42px]', 'sm:h-[42px]');
                        }
                        if (navTitle) {
                            navTitle.classList.remove('text-[0.85rem]', 'sm:text-[0.95rem]');
                            navTitle.classList.add('text-[0.95rem]', 'sm:text-[1.05rem]');
                        }
                        if (navSubtitle) {
                            navSubtitle.classList.remove('hidden');
                        }
                    }
                });

                // --- 3. DRAWER MOBILE SLIDE ---
                const openBtn = document.getElementById('mobile-menu-btn');
                const closeBtn = document.getElementById('close-drawer-btn');
                const drawer = document.getElementById('mobile-drawer');
                const overlay = document.getElementById('drawer-overlay');

                function toggleDrawer(show) {
                    if (show && drawer && overlay) {
                        drawer.classList.remove('-translate-x-full');
                        overlay.classList.remove('opacity-0', 'pointer-events-none');
                    } else if (drawer && overlay) {
                        drawer.classList.add('-translate-x-full');
                        overlay.classList.add('opacity-0', 'pointer-events-none');
                    }
                }

                if (openBtn) openBtn.addEventListener('click', () => toggleDrawer(true));
                if (closeBtn) closeBtn.addEventListener('click', () => toggleDrawer(false));
                if (overlay) overlay.addEventListener('click', () => toggleDrawer(false));
            });

            // Fungsi Global untuk Submenu Mobile
            function openSubmenu(id) {
                const elem = document.getElementById(id);
                if (elem) elem.classList.remove('translate-x-full');
            }

            function closeSubmenu(id) {
                const elem = document.getElementById(id);
                if (elem) elem.classList.add('translate-x-full');
            }
        </script>

        @stack('scripts')
    </body>
</html>