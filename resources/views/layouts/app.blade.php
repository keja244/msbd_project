<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMA Negeri 2 Medan')</title>
    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_smandu.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#fafdf7] text-[#222222] leading-[1.6] font-['Segoe_UI',Tahoma,Geneva,Verdana,sans-serif]">

    @include('includes.color_strip')
    @include('includes.navbar')

    <main>
        @yield('content')
    </main>

    @include('includes.footer')

    @stack('scripts')
</body>
</html>