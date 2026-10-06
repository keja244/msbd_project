<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Login - SMAN 2 Medan')</title>

        <!-- SCRIPT PENGUNCI DARK MODE (Agar sinkron dengan Landing Page) -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_smandu.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo_smandu.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f8f9fa] dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">
        
        <!-- HANYA ISI KONTENT TANPA NAVBAR & FOOTER -->
        <main class="min-h-screen flex flex-col justify-center">
            @yield('content')
        </main>

    </body>
</html>